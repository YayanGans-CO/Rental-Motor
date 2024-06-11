<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <title>Rental</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            }
        }
    </script>
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

    <!-- ME -->


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
                            class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0"
                            aria-current="page">Rental</a>
                    </li>
                    <li>
                        <a href="rental_berjalan.php"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Rental
                            berjalan</a>
                    </li>
                    <li>
                        <a href="riwayat.php"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Riwayat</a>
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





    <!-- <div class="navbar">
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
    </div> -->


    <div class="p-4 bg-white">
        <h1 class="text-2xl font-bold mb-4">Scan QR Code</h1>
        <video id="preview" class="w-fit h-64 bg-gray-200 mb-4 rounded-lg"></video>
        <form action="logout.php" method="post" class="flex">
            <input type="submit" value="Logout"
                class="px-4 py-2 bg-blue-700 font-semibold text-white rounded hover:bg-blue-800 cursor-pointer">
        </form>
    </div>

    <script src="js/handling_camera.js"></script>
    <!-- Bootstrap JS, jQuery, Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>