<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental</title>
</head>
<?php
session_start();
include 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// if (!cekPesananAktif($_SESSION['user_id'])) {
//     echo "<script>
//             alert('Tidak ada pesanan aktif.');
//             window.location.href = 'index.php';
//           </script>";
//     exit();
// }
?>
<body>
<div class="navbar">
    <div class="brand">Sewa Motor</div>
    <div class="nav-links">
        <a href="index.php">Rental</a>
        <a href="rental_berjalan.php">Rental berjalan</a>
        <a href="riwayat.php">Riwayat</a>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="#"><?php echo $_SESSION['username']; ?></a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </div>
</div>
<!-- Rental Data -->
<div class="container">
    <div id="rentalData"></div>
</div>

<script src="js/handling_rental_berjalan.js"></script>
</body>

</html>
