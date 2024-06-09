<?php

require_once 'Database.php';

class Location {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllLocations() {
        $conn = $this->db->getConnection();
        $query = "SELECT * FROM Locations";
        $result = mysqli_query($conn, $query);
        $locations = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $locations[] = $row;
        }
        $this->db->closeConnection();
        return $locations;
    }

    public function addLocation($nama_lokasi, $alamat_lokasi) {
        $conn = $this->db->getConnection();
        $nama_lokasi = mysqli_real_escape_string($conn, $nama_lokasi);
        $alamat_lokasi = mysqli_real_escape_string($conn, $alamat_lokasi);

        $query = "INSERT INTO Locations (nama_lokasi, alamat_lokasi) VALUES ('$nama_lokasi', '$alamat_lokasi')";
        $result = mysqli_query($conn, $query);

        $this->db->closeConnection();
        return $result;
    }

    public function updateLocation($location_id, $nama_lokasi, $alamat_lokasi) {
        $conn = $this->db->getConnection();
        $nama_lokasi = mysqli_real_escape_string($conn, $nama_lokasi);
        $alamat_lokasi = mysqli_real_escape_string($conn, $alamat_lokasi);

        $query = "UPDATE Locations SET nama_lokasi = '$nama_lokasi', alamat_lokasi = '$alamat_lokasi' WHERE location_id = '$location_id'";
        $result = mysqli_query($conn, $query);

        $this->db->closeConnection();
        return $result;
    }

    public function deleteLocation($location_id) {
        $conn = $this->db->getConnection();
        $query = "DELETE FROM Locations WHERE location_id = '$location_id'";
        $result = mysqli_query($conn, $query);

        $this->db->closeConnection();
        return $result;
    }

    public function getLocationById($location_id) {
        $conn = $this->db->getConnection();
        $query = "SELECT * FROM Locations WHERE location_id = '$location_id'";
        $result = mysqli_query($conn, $query);
        $location = mysqli_fetch_assoc($result);

        $this->db->closeConnection();
        return $location;
    }
}

?>
