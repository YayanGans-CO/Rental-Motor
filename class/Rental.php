<?php

require_once 'Database.php';

class Rental {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function rentMotor($user_id, $motor_id) {
        $conn = $this->db->getConnection();

        // Set waktu sewa (saat ini)
        date_default_timezone_set('Asia/Makassar');
        $waktu_sewa = date('Y-m-d H:i:s');

        // Periksa status motor
        $status_query = "SELECT status FROM Electric_Motorcycles WHERE motor_id = '$motor_id'";
        $status_result = mysqli_query($conn, $status_query);

        if ($status_result) {
            $row = mysqli_fetch_assoc($status_result);
            if ($row['status'] == 'tidak tersedia') {
                header('Location: index.php');
                exit();
            } else {
                // Query untuk memasukkan data sewa ke dalam tabel Rentals
                $insert_query = "INSERT INTO Rentals (user_id, motor_id, waktu_sewa,status_pembayaran) VALUES ('$user_id', '$motor_id', '$waktu_sewa', 'belum bayar')";

                if (mysqli_query($conn, $insert_query)) {
                    // Mendapatkan rental_id yang baru saja dimasukkan
                    $rental_id = mysqli_insert_id($conn);
                
                    // Update status motor menjadi tidak tersedia
                    $update_query = "UPDATE Electric_Motorcycles SET status = 'tidak tersedia' WHERE motor_id = '$motor_id'";
                    mysqli_query($conn, $update_query);
                
                    // Simpan rental_id ke dalam sesi
                    session_start();
                    $_SESSION['rental_id'] = $rental_id;
                
                    // Arahkan pengguna ke halaman rental_berjalan.php
                    header('Location: rental_berjalan.php');
                    exit();
                } else {
                    echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
                }
            }
        } else {
            return "Error: " . $status_query . "<br>" . mysqli_error($conn);
        }

        $this->db->closeConnection();
    }

    public function getActiveRentals($user_id) {
        $conn = $this->db->getConnection();
        $sql = "SELECT rental_id, motor_id, waktu_sewa FROM Rentals WHERE user_id = $user_id AND status_pembayaran = 'belum bayar'";
        $result = mysqli_query($conn, $sql);

        $data = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }

        $this->db->closeConnection();
        return $data;
    }

    public function processReturn($rental_id) {
        $conn = $this->db->getConnection();

        // Set waktu kembali (saat ini)
        date_default_timezone_set('Asia/Makassar');
        $waktu_kembali = date('Y-m-d H:i:s');

        // Query untuk mendapatkan data rental
        $query = "SELECT * FROM Rentals WHERE rental_id = '$rental_id'";
        $result = mysqli_query($conn, $query);
        $rental = mysqli_fetch_assoc($result);

        if ($rental) {
            $waktu_sewa = strtotime($rental['waktu_sewa']);
            $waktu_kembali_timestamp = strtotime($waktu_kembali);

            if ($waktu_kembali_timestamp >= $waktu_sewa) {
                $durasi_sewa = ($waktu_kembali_timestamp - $waktu_sewa) / 3600; // Durasi dalam jam

                // Dapatkan harga sewa per jam dari tabel Electric_Motorcycles
                $motor_id = $rental['motor_id'];
                $query = "SELECT harga_sewa_per_jam FROM Electric_Motorcycles WHERE motor_id = '$motor_id'";
                $result = mysqli_query($conn, $query);
                $motor = mysqli_fetch_assoc($result);
                $harga_sewa_per_jam = $motor['harga_sewa_per_jam'];

                $total_biaya = $durasi_sewa * $harga_sewa_per_jam;

                // Update data rental dengan waktu kembali dan total biaya
                $update_query = "UPDATE Rentals SET waktu_kembali = '$waktu_kembali', total_biaya = '$total_biaya', status_pembayaran = 'pending' WHERE rental_id = '$rental_id'";
                if (mysqli_query($conn, $update_query)) {
                    // Update status motor menjadi tersedia
                    // $update_motor_query = "UPDATE Electric_Motorcycles SET status = 'tersedia' WHERE motor_id = '$motor_id'";
                    // mysqli_query($conn, $update_motor_query);

                    mysqli_close($conn);
                    return true;
                } else {
                    mysqli_close($conn);
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkActiveRental($user_id) {
        $conn = $this->db->getConnection();
        $query = "SELECT * FROM Rentals WHERE user_id = '$user_id' AND status_pembayaran = 'belum bayar'";
        $result = mysqli_query($conn, $query);
        $has_active_order = mysqli_num_rows($result) > 0;
        mysqli_close($conn);
        return $has_active_order;
    }
    public function konfirmasiPembayaran($rental_id, $motor_id) {
        $conn = $this->db->getConnection();

        // Update status pembayaran menjadi berhasil
        $query = "UPDATE Rentals SET status_pembayaran = 'berhasil' WHERE rental_id = '$rental_id'";
        $result = mysqli_query($conn, $query);

        // Update status motor menjadi tersedia
        $query_motor = "UPDATE Electric_Motorcycles SET status = 'tersedia' WHERE motor_id = '$motor_id'";
        $result_motor = mysqli_query($conn, $query_motor);

        $this->db->closeConnection();

        // Kembalikan true jika kedua query berhasil
        return $result && $result_motor;
    }
}

?>
