
// include 'functions.php';

// // Ambil data dari formulir login
// $username = $_POST['username'];
// $password = $_POST['password'];

// // Panggil fungsi loginUser() dengan data yang diberikan dari formulir
// loginUser($username, $password);

<?php

require_once 'class/User.php';

$username = $_POST['username'];
$password = $_POST['password'];

$user = new User();

$user->loginUser($username, $password);

?>
