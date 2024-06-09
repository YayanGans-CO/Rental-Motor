<?php
session_start();
require_once 'class/Rental.php';

// Terima input dari form
$rental_id = $_GET['rentalID'];

// Buat objek Rental
$rental = new Rental();

// Panggil metode prosesPengembalianMotor() dari objek Rental
if ($rental->processReturn($rental_id)) {
    header('Location: index.php');
    exit();
} else {
    echo "<script>alert('Pengembalian motor gagal. Silakan coba lagi.'); window.location.href = 'rental_berjalan.php';</script>";
}
?>

