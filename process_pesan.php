<?php
require_once 'class/Rental.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$rental = new Rental();

$user_id = $_SESSION['user_id'];
$motor_id = $_POST['barcode'];

$rental->rentMotor($user_id, $motor_id);
?>
