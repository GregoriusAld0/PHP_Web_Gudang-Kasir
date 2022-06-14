<?php 
    require 'function.php';
    require 'cek.php';

    $email = $_SESSION['email'];

//Get ID produk dari halaman sebelumnya
$idproduk = $_GET['id'];

//Get informasi produk dr database
$get = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$idproduk'");
$fetch = mysqli_fetch_assoc($get);

$kodeproduk = $fetch['kode_produk'];
$namaproduk = $fetch['nama_produk'];
$deskripsi = $fetch['deskripsi'];
$stok = $fetch['stok'];
$harga = $fetch['harga'];


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Detail Barang</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark-navbar">
            <a class="navbar-brand" href="index.php">Central Electronic's</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
           
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></form>

            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$email?></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-baru" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu Produk</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                                Stok Produk
                            </a>
                            <a class="nav-link" href="produk_masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-arrow-circle-right"></i></div>
                                Produk Masuk
                            </a>
                            <a class="nav-link" href="produk_keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-arrow-circle-left"></i></div>
                                Produk Keluar
                            </a>
                            <div class="sb-sidenav-menu-heading">Menu Admin</div>
                            <a class="nav-link" href="kelola_admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Kelola Admin
                            </a>
                        </div>
                    </div>
                   
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Detail Produk</h1>

                        <div class="card mb-4 mt-3">
                            <div class="card-header">
                              <h3><?=$namaproduk;?></h3>
                            </div>
                                  
                            <div class="card-body">
                            <div class="row">
                                <div class="col-2">Kode Produk</div>
                                <div class="col-2">:</div>
                                <div class="col-8"><strong><?=$kodeproduk; ?></strong></div>
                            </div>
                            <div class="row">
                                <div class="col-2">Deskripsi</div>
                                <div class="col-2">:</div>
                                <div class="col-8"><strong><?=$deskripsi?></strong></div>
                            </div>
                            <div class="row">
                                <div class="col-2">Stok</div>
                                <div class="col-2">:</div>
                                <div class="col-8 mb-3"><strong><?=$stok?></strong></div>
                            </div>
                                <h4 class="mt-3">Produk Masuk</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="produkmasuk" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Tanggal</th>
                                                <th>Kuantitas</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php 
                                              $datamasuk = mysqli_query($conn, "SELECT * FROM tbl_masuk WHERE id_produk='$idproduk'");

                                              while($fetch = mysqli_fetch_array($datamasuk))
                                              {
                                                  $tanggal = $fetch['tanggal'];
                                                  $keterangan = $fetch['keterangan'];
                                                  $kuantitas = $fetch['kuantitas'];
                                                 
                                            ?>

                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $tanggal;?></td>
                                                <td><?= $kuantitas;?></td>
                                                <td><?= $keterangan; ?></td>
                                               
                                            </tr>
                                                    
                                            <?php
                                                };

                                            ?>
                     
                                    </table>
                                </div>

                                <br>

                                <h4 class="mt-3">Produk Keluar</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="produkkeluar" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Tanggal</th>
                                                <th>Kuantitas</th>
                                                <th>Penerima</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php 
                                              $datakeluar = mysqli_query($conn, "SELECT * FROM tbl_keluar WHERE id_produk='$idproduk'");

                                              while($fetch = mysqli_fetch_array($datakeluar))
                                              {
                                                  $tanggal = $fetch['tanggal'];
                                                  $penerima = $fetch['penerima'];
                                                  $kuantitas = $fetch['kuantitas'];
                                            ?>

                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $tanggal;?></td>
                                                <td><?= $kuantitas;?></td>
                                                <td><?= $penerima; ?></td>
                                               
                                            </tr>
                                                    
                                            <?php
                                                };

                                            ?>
                     
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; centralelectronic's.com</div>

                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    </body>
</html>
