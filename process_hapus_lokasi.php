<?php
session_start();
require_once 'class/Lokasi.php';

$location_id = $_GET['location_id'];

// Buat objek Location
$location = new Location();

// Panggil metode deleteLocation() dari objek Location
if ($location->deleteLocation($location_id)) {
    echo "Lokasi berhasil dihapus.";
} else {
    echo "Error: Gagal menghapus lokasi.";
}

header("Location: tambah_lokasi.php");
exit();
?>

