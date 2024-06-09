<?php
require_once 'class/Rental.php';
session_start();

$rental = new Rental();

$user_id = $_SESSION['user_id'];
$data = $rental->getActiveRentals($user_id);

header('Content-Type: application/json');
echo json_encode($data);
?>
