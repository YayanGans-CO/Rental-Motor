<?php
session_start();
require_once 'class/lokasi.php';

$nama_lokasi = $_POST['nama_lokasi'];
$alamat_lokasi = $_POST['alamat_lokasi'];

$location = new Location();

if ($location->addLocation($nama_lokasi, $alamat_lokasi)) {
    echo "Lokasi berhasil ditambahkan.";
} else {
    echo "Error: " . mysqli_error(koneksi_db());
}

header("Location: tambah_lokasi.php");
exit();
?>
