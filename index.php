<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
  <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <title>Rental</title>
</head>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}
if (isset($_GET['pesan'])) {
    $pesan = htmlspecialchars($_GET['pesan']);
    echo "<script>alert('$pesan');</script>";
}
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
<h1>Scan QR Code</h1>
<video id="preview"></video>
<form action="logout.php" method="post">
    <input type="submit" value="Logout">
</form>
<script src="js/handling_camera.js"></script>
    <!-- Bootstrap JS, jQuery, Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
