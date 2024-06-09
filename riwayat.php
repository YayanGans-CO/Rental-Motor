<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Sewa</title>
</head>
<body>
<h1>Riwayat Sewa</h1>
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
<?php
session_start();
require_once 'class/User.php';

$user_id = $_SESSION['user_id'];

$riwayat = new User();

$userHistory = $riwayat->getUserHistory($user_id);

// Tampilkan hasil
if (!empty($userHistory)) {
?>
<ul>
<?php foreach ($userHistory as $rental): ?>
    <li>
        Rental ID: <?=$rental['rental_id'] ?><br>
        Motor ID: <?=$rental['motor_id'] ?><br>
        Waktu Sewa: <?=$rental['waktu_sewa'] ?><br>
        Waktu Kembali: <?=$rental['waktu_kembali'] ?><br>
        Total Biaya: <?=$rental['total_biaya'] ?><br>
        Status Pembayaran: <?=$rental['status_pembayaran'] ?><br>
    </li><br>
<?php endforeach; ?>
</ul>
<?php
} else {
    echo 'Tidak ada riwayat sewa.';
}
?>

</body>
</html>
