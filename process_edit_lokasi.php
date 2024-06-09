<?php
session_start();
require_once 'class/lokasi.php';

$location_id = $_POST['location_id'];
$nama_lokasi = $_POST['nama_lokasi'];
$alamat_lokasi = $_POST['alamat_lokasi'];

// Buat objek Location
$location = new Location();

// Panggil metode updateLocation() dari objek Location
if ($location->updateLocation($location_id, $nama_lokasi, $alamat_lokasi)) {
    header("Location: tambah_lokasi.php");
    exit();
} else {
    echo "Error: Gagal memperbarui lokasi.";
}
?>

