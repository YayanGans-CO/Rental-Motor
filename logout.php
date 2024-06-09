<?php
session_start();

// Hancurkan semua data sesi
session_destroy();

// Redirect kembali ke halaman login
header('Location: login.php');
exit();
?>
