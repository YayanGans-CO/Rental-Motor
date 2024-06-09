<?php

require_once 'class/Rental.php';

$rental_id = $_POST['rental_id'];
$motor_id = $_POST['motor_id'];

$rental = new Rental();

$result = $rental->konfirmasiPembayaran($rental_id, $motor_id);

if ($result) {
    echo "Pembayaran dikonfirmasi dan status motor diperbarui.";
} else {
    echo "Terjadi kesalahan dalam mengonfirmasi pembayaran atau memperbarui status motor.";
}

header("Location: admin.php");
exit();

?>
