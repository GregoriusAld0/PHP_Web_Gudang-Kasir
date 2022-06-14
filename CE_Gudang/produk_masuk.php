<?php 
    require 'function.php';
    require 'cek.php';
    
    $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Produk Masuk</title>
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
                        <h1 class="mt-4">Produk Masuk</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                               
                                    <br>
                                    <!-- Filter Berdasarkan Tanggal -->
                                    <div class="row">
                                        <div class="col">
                                            <form method="post" class="form-inline mt-3">
                                                <input type="date" name="tgl_mulai" class="form-control">
                                                &nbsp; 
                                                <h3>-</h3> 
                                                &nbsp;
                                                <input type="date" name="tgl_selesai" class="form-control">
                                                <button type="submit" name="filter_tgl" class="btn btn-primary ml-2 "><i class="fas fa-filter mr-1"></i>Filter</button>
                                            </form>
                                        </div>
                                       
                                    </div>
                                   
                                    <!--Tambah Produk Masuk Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>Tanggal</th>
                                                <th>Kode Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Jumlah</th>
                                                <th>Keterangan</th>
                                                <th style="width: 5%;"></th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        <?php 

                                        if(isset($_POST['filter_tgl']))
                                        {   
                                            $tgl_mulai = $_POST['tgl_mulai'];
                                            $tgl_selesai = $_POST['tgl_selesai'];

                                            if($tgl_mulai != null || $tgl_selesai != null)
                                            {
                                                $ambildata_stok = mysqli_query($conn, "SELECT * FROM tbl_masuk m, produk s WHERE s.id_produk = m.id_produk AND tanggal BETWEEN '$tgl_mulai' AND DATE_ADD('$tgl_selesai', INTERVAL 1 DAY)");
                                            } else {
                                                $ambildata_stok = mysqli_query($conn, "SELECT * FROM tbl_masuk m, produk s WHERE s.id_produk = m.id_produk");
                                            }

                                        } else {
                                            $ambildata_stok = mysqli_query($conn, "SELECT * FROM tbl_masuk m, produk s WHERE s.id_produk = m.id_produk");
                                        }
                                        
                                                while($data = mysqli_fetch_array($ambildata_stok))
                                                {
                                                    $idproduk = $data['id_produk'];
                                                    $idmasuk = $data['id_masuk'];
                                                    $tanggal = $data['tanggal'];
                                                    $kodeproduk = $data['kode_produk'];
                                                    $namaproduk = $data['nama_produk'];
                                                    $kuantitas = $data['kuantitas'];
                                                    $keterangan = $data['keterangan'];
                                                 
                                            ?>

                                            <tr class="text-nowrap">
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $kodeproduk; ?></td>
                                                <td><?= $namaproduk; ?></td>
                                                <td><?= $kuantitas; ?></td>
                                                <td><?= $keterangan; ?></td>
                                                <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idmasuk;?>"><i class="fas fa-trash"></i>
                                                   
                                                </button>

                                                </td>
                                            </tr>

                                            <!--Edit Modal -->
                                            <div class="modal fade" id="edit<?=$idmasuk;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <h5 class="font-weight-normal">Keterangan Produk</h5>
                                                        <input type="text" name="keterangan" value="<?= $keterangan;?>" class="form-control mb-2" required>
                                                        <h5 class="font-weight-normal">Jumlah </h5>
                                                        <input type="number" name="kuantitas" value="<?= $kuantitas;?>" class="form-control mb-2" required>

                                                        <input type="hidden" name="idproduk" value="<?= $idproduk; ?>">
                                                        <input type="hidden" name="idmasuk" value="<?= $idmasuk; ?>">
                                                        <button type="submit" class="btn btn-success float-right mt-2" name="updateprodukmasuk">Submit</button>
                                                        <button type="button" class="btn btn-secondary float-right mt-2 mr-3 mb-2" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </form>
                                                
                                                    </div>
                                                </div>
                                                </div>

                                                 <!--Delete Modal -->
                                                <div class="modal fade" id="delete<?=$idmasuk?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <!-- Modal head -->
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Produk Masuk</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                        <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus <strong><?=$namaproduk;?></strong>?
                                                        <input type="hidden" name="idproduk" value="<?= $idproduk; ?>">
                                                        <input type="hidden" name="qty" value="<?= $kuantitas; ?>">
                                                        <input type="hidden" name="idmasuk" value="<?= $idmasuk; ?>">
                                                        <br>
                                                        <button type="submit" class="btn btn-danger float-right mt-3" name="deleteprodukmasuk">Hapus</button>
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
