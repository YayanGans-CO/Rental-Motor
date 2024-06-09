<?php

require_once 'Database.php';

class Motor {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addMotor($merk, $model, $tahun, $harga_sewa_per_jam, $lokasi) {
        $conn = $this->db->getConnection();
        $merk = mysqli_real_escape_string($conn, $merk);
        $model = mysqli_real_escape_string($conn, $model);
        $tahun = mysqli_real_escape_string($conn, $tahun);
        $harga_sewa_per_jam = mysqli_real_escape_string($conn, $harga_sewa_per_jam);
        $lokasi = mysqli_real_escape_string($conn, $lokasi);

        $query = "INSERT INTO Electric_Motorcycles (merk, model, tahun, harga_sewa_per_jam, location_id, status) VALUES ('$merk', '$model', '$tahun', '$harga_sewa_per_jam', '$lokasi', 'tersedia')";
        $result = mysqli_query($conn, $query);

        $this->db->closeConnection();
        return $result;
    }

    public function deleteMotor($motor_id) {
        $conn = $this->db->getConnection();
        $query = "DELETE FROM Electric_Motorcycles WHERE motor_id = '$motor_id'";
        $result = mysqli_query($conn, $query);

        $this->db->closeConnection();
        return $result;
    }
    public function getAllMotor() {
        $conn = $this->db->getConnection();
        $query = "SELECT * FROM Electric_Motorcycles";
        $result = mysqli_query($conn, $query);
        $motor = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $motor[] = $row;
        }
        $this->db->closeConnection();
        return $motor;
    }
}

?>
