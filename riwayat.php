<?php
session_start();
require_once 'class/User.php';

$user_id = $_SESSION['user_id'];

$riwayat = new User();

$userHistory = $riwayat->getUserHistory($user_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Sewa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <nav class="bg-white border-b-2 border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap">Sewamotor</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <a href="index.php"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
                            aria-current="page">Rental</a>
                    </li>
                    <li>
                        <a href="rental_berjalan.php"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Rental
                            berjalan</a>
                    </li>
                    <li>
                        <a href="riwayat.php"
                            class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0">Riwayat</a>
                    </li>
                    <?php if (isset($_SESSION['username'])): ?>
                        <li>
                            <a href="#"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"><?php echo $_SESSION['username']; ?></a>
                        </li>
                        <li>
                            <a href="logout.php"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Logout</a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="#"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Contact</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>


    <div class="max-w-screen-xl mx-auto p-4 overflow-y-auto">
        <h1 class="text-2xl font-bold mb-4">Riwayat Sewa</h1>
        <?php
        // Tampilkan hasil
        if (!empty($userHistory)) {
            ?>
            <ul class="space-y-4">
                <?php foreach ($userHistory as $rental): ?>
                    <li class="bg-white p-4 shadow-md rounded-lg">
                        <p><b>Rental ID:</b> <?= $rental['rental_id'] ?></p>
                        <p><b>Motor ID:</b> <?= $rental['motor_id'] ?></p>
                        <p><b>Waktu Sewa:</b> <?= $rental['waktu_sewa'] ?></p>
                        <p><b>Waktu Kembali:</b> <?= $rental['waktu_kembali'] ?></p>
                        <p><b>Total Biaya:</b> <?= $rental['total_biaya'] ?></p>
                        <p><b>Status Pembayaran:</b> <?= $rental['status_pembayaran'] ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php
        } else {
            echo '<p class="text-gray-700">Tidak ada riwayat sewa.</p>';
        }
        ?>
    </div>

</body>

</html>