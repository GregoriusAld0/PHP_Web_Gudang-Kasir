<?php 
    require 'function.php';
    require 'cek.php';
    
    $email = $_SESSION['email'];

    //Ambil Data total produk
    $getproduk = mysqli_query($conn,"SELECT * FROM produk");
    $countproduk = mysqli_num_rows($getproduk);

    //Ambil data produk masuk
    $getproduk_masuk = mysqli_query($conn,"SELECT * FROM tbl_masuk");
    $countproduk_masuk = mysqli_num_rows($getproduk_masuk);

    //Ambil data produk keluar
    $getproduk_keluar = mysqli_query($conn,"SELECT * FROM tbl_keluar");
    $countproduk_keluar = mysqli_num_rows($getproduk_keluar);

   
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Home</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            a {
                text-decoration: none;
                color:black;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark-navbar">
            <a class="navbar-brand" href="index.php">Central Electronic's</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
           
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></form>

            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item" style="color: white;"></li>
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
                        <h1 class="mt-2">Stok Produk</h1>
                        <!-- Tampilan Data Total -->
                        <div class="row">
                            <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-4" style="background-color: #41658A;">
                                    <div class="card-body"><i class="fas fa-boxes mr-2"></i><strong>Total Produk</strong></div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div class="text-white stretched-link"><h2><?=$countproduk ?></h2></div>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-4" style="background-color: #41658A;">
                                    <div class="card-body"><i class="fas fa-arrow-circle-right mr-2"></i><strong>Total Produk Masuk</strong></div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div class="text-white stretched-link"><h2><?=$countproduk_masuk ?></h2></div>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-4" style="background-color: #41658A;">
                                    <div class="card-body"><i class="fas fa-arrow-circle-left mr-2"></i><strong>Total Produk Keluar</strong></div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div class="text-white stretched-link"><h2><?=$countproduk_keluar ?></h2></div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary mr-2 mb-1" style="width: 210px;" data-toggle="modal" data-target="#Modalbaru"><i class="fas fa-plus"></i>
                                    Tambah Produk Baru
                                    </button>
                                    <!--TAMBAH PRODUK Modal -->
                                    <div class="modal fade" id="Modalbaru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <!-- Modal head -->
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                            <!-- Modal body -->
                                        <form method="post">       
                                        <div class="modal-body">
                                            <h5 class="font-weight-normal">Kode Produk</h5>
                                                <input type="text" name="kodeproduk" placeholder="Input kode produk" class="form-control mb-2" required>
                                            <h5 class="font-weight-normal">Nama Produk</h5>
                                                <input type="text" name="namaproduk" placeholder="Input nama produk" class="form-control mb-2" required>
                                            <h5 class="font-weight-normal">Dekripsi Produk</h5>
                                                <input type="text" name="deskripsi" placeholder="Input deskripsi produk" class="form-control mb-2" required>
                                            <h5 class="font-weight-normal">Stok</h5>
                                                <input type="number" min="0" name="stok" placeholder="Input stok " class="form-control mb-2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" oninput="this.setCustomValidity('')" required>
                                            <h5 class="font-weight-normal">Harga</h5>
                                                <input type="text" name="harga" placeholder="Input harga " class="form-control mb-3" required>
                                          
                                            <button type="submit" class="btn btn-success float-right" name="addnewproduk">Submit</button>
                                            <button type="button" class="btn btn-secondary float-right mr-3 mb-3" data-dismiss="modal">Close</button>
                                        </div>
                                        </form>
                                       
                                        </div>
                                    </div>
                                    </div>
                                     <!-- Button trigger modal -->
                                     <button type="button" class="btn btn-primary mb-1" style="width: 210px;" data-toggle="modal" data-target="#Modalmasuk"><i class="fas fa-plus    "></i>
                                    Tambah Stok Produk
                                    </button> 
                                    <!--Tambah Produk Masuk Modal -->
                                    <div class="modal fade" id="Modalmasuk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <!-- Modal head -->
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Produk Masuk</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                            <!-- Modal body -->
                                        <form method="post">
                                        <div class="modal-body">
                                        <h5 class="font-weight-normal">Produk Tersedia</h5>
                                        <select name="produknya" class="form-control mb-2">
                                            <?php 
                                                $ambilsemuadata = mysqli_query($conn, "SELECT * FROM produk ORDER BY nama_produk ASC"); 
                                                while($fetch_array = mysqli_fetch_array($ambilsemuadata))
                                                {
                                                    $nama_produknya = $fetch_array['nama_produk'];
                                                    $id_produknya = $fetch_array['id_produk'];
                                                ?>
                                
                                                <option value="<?=$id_produknya;?>"><?=$nama_produknya;?></option>

                                                <?php

                                                }
                                            
                                            ?>

                                        </select>
                                            <h5 class="font-weight-normal">Stok</h5>
                                            <input type="number" min="0" name="kuantitas" placeholder="Input kuantitas " class="form-control mb-2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" oninput="this.setCustomValidity('')" required>
                                            <h5 class="font-weight-normal mt-2">Keterangan</h5>
                                            <input type="text" name="keterangan" placeholder="Keterangan... " class="form-control mb-3" required>
                                          
                                            <button type="submit" class="btn btn-success float-right" name="produkmasuk">Submit</button>
                                            <button type="button" class="btn btn-secondary float-right mr-3 mb-3" data-dismiss="modal">Close</button>
                                        </div>
                                        </form>
                                       
                                        </div>
                                    </div>
                                    </div>
                                    <!-- Tombol export !-->
                                    <a href="export.php" target="_blank" class="btn btn-primary float-right mb-1"><i class="fas fa-file-export mr-1"></i>Export Data</a>
                        
                            </div>
                            <div class="card-body">
                            <!-- Alert stok produk habis !-->
                            <?php 
                                $datastok = mysqli_query($conn, "SELECT * FROM produk WHERE stok < 1");

                                while($fetch = mysqli_fetch_array($datastok))
                                {
                                    $nama_produk = $fetch['nama_produk'];
                                

                            ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Warning!</strong> Stok produk <strong><?=$nama_produk?></strong> telah habis, harap segera dilakukan restock
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                            <?php 
                                }
                            ?>

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>No.</th>
                                                <th>Kode Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Stok</th>
                                                <th>Harga</th>
                                                <th>Deskripsi</th>
                                                <th style="width: 8%;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php 
                                                $ambildata_stok = mysqli_query($conn, "SELECT * FROM produk");
                                                while($data = mysqli_fetch_array($ambildata_stok))
                                                {
                                                    $kodeproduk = $data['kode_produk'];
                                                    $namaproduk = $data['nama_produk'];
                                                    $deskripsi = $data['deskripsi'];
                                                    $stok = $data['stok'];
                                                    $harga = $data['harga'];
                                                    $idproduk = $data['id_produk'];
                                                 
                                            ?>

                                            <tr class="text-nowrap">
                                                <td><?= $no++; ?></td>
                                                <td><?= $kodeproduk; ?></td>
                                                <td><a href="produk_detail.php?id=<?=$idproduk;?>"><?=$namaproduk;?></a></td>
                                                <td><?= $stok; ?></td>
                                                <td>Rp. <?= number_format($harga); ?></td>
                                                <td><?= $deskripsi; ?></td>
                                                <td>
                                                <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#edit<?=$idproduk;?>"><i class="fas fa-edit"></i>
                                                    <!--edit-->
                                                </button>
                                                &nbsp;
                                                <button type="button" class="btn btn-danger mb-1" data-toggle="modal" data-target="#delete<?= $idproduk;?>"><i class="fas fa-trash"></i>
                                                    <!--Delete-->
                                                </button>

                                                </td>
                                            </tr>
                                                <!--Edit Modal -->
                                                <div class="modal fade" id="edit<?=$idproduk;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <!-- Modal head -->
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                        <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                        <h5 class="font-weight-normal">Nama Produk</h5>
                                                        <input type="text" name="namaproduk" value="<?= $namaproduk;?>" class="form-control mb-2" required>
                                                        <h5 class="font-weight-normal">Stok</h5>
                                                        <input type="text" name="stok" value="<?= $stok;?>" class="form-control mb-2" required>
                                                        <h5 class="font-weight-normal">Harga</h5>
                                                        <input type="text" name="harga" value="<?= $harga;?>" class="form-control mb-2" required>
                                                        <h5 class="font-weight-normal">Dekripsi Produk</h5>
                                                        <input type="text" name="deskripsi" value="<?= $deskripsi;?>" class="form-control mb-2" required>

                                                        <input type="hidden" name="idproduk" value="<?= $idproduk; ?>">
                                                        <button type="submit" class="btn btn-success float-right mt-2" name="updateproduk">Submit</button>
                                                        <button type="button" class="btn btn-secondary float-right mt-2 mr-3 mb-2" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </form>
                                                
                                                    </div>
                                                </div>
                                                </div>

                                                 <!--Delete Modal -->
                                                 <div class="modal fade" id="delete<?=$idproduk?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <!-- Modal head -->
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Produk</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                        <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus <strong><?=$namaproduk;?></strong>?
                                                        <input type="hidden" name="idproduk" value="<?= $idproduk; ?>">
                                                        <br>
                                                        <button type="submit" class="btn btn-danger float-right mt-3" name="deleteproduk">Hapus</button>
                                                        <button type="button" class="btn btn-secondary float-right mr-3 mt-3" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </form>
                                                
                                                    </div>
                                                </div>
                                                </div>

                                                    

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
