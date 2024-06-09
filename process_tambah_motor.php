<?php
session_start();
require_once 'class/Motor.php';

$merk = $_POST['merk'];
$model = $_POST['model'];
$tahun = $_POST['tahun'];
$harga_sewa_per_jam = $_POST['harga_sewa_per_jam'];
$lokasi = $_POST['lokasi'];

$motor = new Motor();

if ($motor->addMotor($merk, $model,$tahun,$harga_sewa_per_jam,$lokasi)) {
    echo "Motor berhasil ditambahkan.";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
header("Location: tambah_motor.php");
exit();
?>