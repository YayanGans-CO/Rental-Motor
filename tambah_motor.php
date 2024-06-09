<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motor</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Yasatara <sup>1</sup></div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item ">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item active">
                <a class="nav-link" href="tambah_motor.php">
                    <i class="fas fa-fw fa-motorcycle"></i>
                    <span>Motor</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tambah_lokasi.php">
                    <i class="fas fa-fw fa-map-marker-alt"></i>
                    <span>Lokasi</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Topbar content -->
                </nav>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Tambah Motor</h1>
                    <div class="row">
                        <div class="col-lg-3">
                            
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Motor</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Form Tambah Motor -->
                                    <form action="process_tambah_motor.php" method="POST">
                                        <div class="form-group">
                                            <label for="merk">Merk:</label>
                                            <input type="text" id="merk" name="merk" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="model">Model:</label>
                                            <input type="text" id="model" name="model" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun">Tahun:</label>
                                            <input type="number" id="tahun" name="tahun" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_sewa_per_jam">Harga Sewa:</label>
                                            <input type="number" id="harga_sewa_per_jam" name="harga_sewa_per_jam" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi">Lokasi:</label>
                                            <select id="lokasi" name="lokasi" class="form-control" required>
                                                <option value="">Pilih Lokasi</option>
                                                <?php
                                                include 'class/Lokasi.php';
                                                $location = new Location();
                                                $locations = $location->getAllLocations();
                                                if (!empty($locations)) {
                                                    foreach ($locations as $lokasi) { ?>
                                                    <option value="<?= $lokasi['location_id']; ?>"><?=$lokasi['nama_lokasi']; ?></option>
                                                    <?php }
                                                } 
                                                ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Tambah Motor</button>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-9">

                            <!-- Daftar Motor -->
                            <div class="card shadow mb-5">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Motor</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID Motor</th>
                                                <th>Merk</th>
                                                <th>Model</th>
                                                <th>Tahun</th>
                                                <th>Harga Sewa per Jam</th>
                                                <th>Status</th>
                                                <th>Lokasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once 'class/Motor.php';
                                            $motorcycle = New Motor();
                                            $motorcycles = $motorcycle->getAllMotor();
                                            if (!empty($motorcycles)) {
                                                foreach ($motorcycles as $motor) { ?>
                                                    <tr>
                                                        <td><?= $motor['motor_id'] ?></td>
                                                        <td><?= $motor['merk'] ?></td>
                                                        <td><?= $motor['model'] ?></td>
                                                        <td><?= $motor['tahun'] ?></td>
                                                        <td><?= $motor['harga_sewa_per_jam'] ?></td>
                                                        <td><?= $motor['status'] ?></td>
                                                        <td><?= $motor['location_id'] ?></td>
                                                        <td>
                                                            <a href='edit_motor.php?motor_id=<?= $motor['motor_id'] ?>' class='btn btn-warning btn-sm'>Edit</a>
                                                            <a href='process_hapus_motor.php?motor_id=<?= $motor['motor_id'] ?>' class='btn btn-danger btn-sm' onclick='return confirm("Apakah Anda yakin ingin menghapus motor ini?")'>Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td colspan='8'>Tidak ada motor.</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>