<?php
function koneksi_db() {
    $conn = mysqli_connect("localhost", "root", "", "uts_sewamotor");
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
    return $conn;
}

function ambil_data($table) {
    $conn = koneksi_db();
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);
    $locations = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $locations[] = $row;
    }
    mysqli_close($conn);
    return $locations;
}

function tambah_lokasi($nama_lokasi, $alamat_lokasi) {
    $conn = koneksi_db();
    $query = "INSERT INTO Locations (nama_lokasi, alamat_lokasi) VALUES ('$nama_lokasi', '$alamat_lokasi')";
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);
    return $result;
}

function hapus_lokasi($location_id) {
    $conn = koneksi_db();
    $query = "DELETE FROM Locations WHERE location_id = '$location_id'";
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);
    return $result;
}
function perbarui_lokasi($location_id, $nama_lokasi, $alamat_lokasi) {
    $conn = koneksi_db();
    $query = "UPDATE Locations SET nama_lokasi = '$nama_lokasi', alamat_lokasi = '$alamat_lokasi' WHERE location_id = '$location_id'";
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);
    return $result;
}

function ambil_lokasi_by_id($location_id) {
    $conn = koneksi_db();
    $query = "SELECT * FROM Locations WHERE location_id = '$location_id'";
    $result = mysqli_query($conn, $query);
    $lokasi = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $lokasi;
}
function getTotalPendapatanBulanan() {
    $conn = koneksi_db();
    $query = "
        SELECT SUM(total_biaya) AS total_pendapatan
        FROM Rentals
        WHERE MONTH(waktu_kembali) = MONTH(CURDATE())
        AND YEAR(waktu_kembali) = YEAR(CURDATE())
        AND status_pembayaran = 'berhasil'
    ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $total_pendapatan = $row['total_pendapatan'] ? $row['total_pendapatan'] : 0;
    mysqli_close($conn);
    return $total_pendapatan;
}
function getTotalPendapatanTahunan() {
    $conn = koneksi_db();
    $query = "
        SELECT SUM(total_biaya) AS total_pendapatan
        FROM Rentals
        WHERE YEAR(waktu_kembali) = YEAR(CURDATE())
        AND status_pembayaran = 'berhasil'
    ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $total_pendapatan = $row['total_pendapatan'] ? $row['total_pendapatan'] : 0;
    mysqli_close($conn);
    return $total_pendapatan;
}
function getPersentasePembayaranSukses() {
    $conn = koneksi_db();
    
    // Total pembayaran
    $query_total = "SELECT COUNT(*) AS total FROM Rentals";
    $result_total = mysqli_query($conn, $query_total);
    $row_total = mysqli_fetch_assoc($result_total);
    $total = $row_total['total'] ? $row_total['total'] : 0;

    // Pembayaran sukses
    $query_sukses = "SELECT COUNT(*) AS sukses FROM Rentals WHERE status_pembayaran = 'berhasil'";
    $result_sukses = mysqli_query($conn, $query_sukses);
    $row_sukses = mysqli_fetch_assoc($result_sukses);
    $sukses = $row_sukses['sukses'] ? $row_sukses['sukses'] : 0;

    mysqli_close($conn);

    // Hitung persentase
    $persentase = $total > 0 ? ($sukses / $total) * 100 : 0;
    return $persentase;
}
// Halaman Motor
function tambahMotor($merk, $model, $tahun, $harga_sewa_per_jam, $lokasi) {
    $conn = koneksi_db();
    $query = "INSERT INTO Electric_Motorcycles (merk, model, tahun, harga_sewa_per_jam, location_id,status) VALUES ('$merk', '$model', '$tahun', '$harga_sewa_per_jam', '$lokasi','tersedia')";
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);
    return $result;
}
function hapusMotor($motor_id) {
    $conn = koneksi_db();
    $query = "DELETE FROM electric_motorcycles WHERE motor_id = '$motor_id'";
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);
    return $result;
}
// Halaman Signup
function signUp($username, $email, $password, $nama_lengkap, $alamat, $nomor_telepon,$role){
    $conn = koneksi_db();
    $query = "INSERT INTO users (username, email, password, nama_lengkap, alamat, nomor_telepon,role) VALUES ('$username', '$email', '$password', '$nama_lengkap', '$alamat', '$nomor_telepon','$role')";
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);
    return $result;
}
// Halaman Login
function loginUser($username, $password) {
    // Sambungkan ke database
    $conn = koneksi_db();

    // Lakukan query untuk memeriksa kecocokan username dan password
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    // Periksa apakah ada hasil yang sesuai
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Simpan user ID, username, dan role dalam sesi
        session_start();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        header('Location: index.php');
        exit(); // Penting untuk keluar setelah mengarahkan
    } else {
        echo "<script>alert('Login failed. Invalid username or password.'); window.location.href = 'login.php';</script>";
    }

    // Tutup koneksi ke database
    mysqli_close($conn);
}
function pesanMotor($user_id, $motor_id) {
    // Sambungkan ke database
    $conn = koneksi_db();

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

    // Tutup koneksi ke database
    mysqli_close($conn);
}
function getActiveRentals($user_id) {
    $conn = koneksi_db();
    $sql = "SELECT rental_id, motor_id, waktu_sewa FROM Rentals WHERE user_id = $user_id AND status_pembayaran = 'belum bayar'";
    $result = mysqli_query($conn, $sql);

    $data = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    mysqli_close($conn);
    return $data;
}
function prosesPengembalianMotor($rental_id) {
    $conn = koneksi_db();

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
                $update_motor_query = "UPDATE Electric_Motorcycles SET status = 'tersedia' WHERE motor_id = '$motor_id'";
                mysqli_query($conn, $update_motor_query);

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

function cekPesananAktif($user_id) {
    $conn = koneksi_db();
    $query = "SELECT * FROM Rentals WHERE user_id = '$user_id' AND status_pembayaran = 'belum bayar'";
    $result = mysqli_query($conn, $query);
    $has_active_order = mysqli_num_rows($result) > 0;
    mysqli_close($conn);
    return $has_active_order;
}
?>
