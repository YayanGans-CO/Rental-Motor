<?php
require_once 'class/User.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$nama_lengkap = $_POST['nama_lengkap'];
$alamat = $_POST['alamat'];
$nomor_telepon = $_POST['nomor_telepon'];
$role = $_POST['role'];

$user = new User();

if ($user->signUp($username, $email, $password, $nama_lengkap, $alamat, $nomor_telepon, $role)) {
    echo "Pendaftaran berhasil";
} else {
    echo "Error: " . $user->getConnection()->error;
}

header("Location: login.php");
exit();

?>

