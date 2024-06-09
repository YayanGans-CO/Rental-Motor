<?php
session_start();
require_once 'class/Motor.php';

$motor_id = $_GET['motor_id'];

// Buat objek Motor
$motor = new Motor();

// Panggil metode deleteMotor() dari objek Motor
if ($motor->deleteMotor($motor_id)) {
    echo "Motor berhasil dihapus.";
} else {
    echo "Error: Gagal menghapus motor.";
}

header("Location: tambah_motor.php");
exit();
?>

