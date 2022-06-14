<?php  
require_once "functions.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

if (!empty($_GET['ubah'])) { // fungsi ubah harga produk sepertinya tidak terpakai karna ada fungsi milik gudang
    $data['harga'] = $_POST['harga'];
    $data['id'] = $_POST['id'];
    update_pr2($data);
    header("Location:stok.php?sukses=y");
}

if (!empty($_GET['hapus'])) { // fungsi hapus produk
    $hapus = $_GET['idpr'];
    delete_pr($hapus);
    header("Location:stok.php?suksesh=y");
    
    
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Daftar Produk | Central Electronic's</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/logo2.ico">
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed bg-main">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-baru">
            <a class="navbar-brand" href="index.php">Central Electronic's</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <a class="text-light d-none d-md-inline-block ml-auto mr-0 mr-md-3 my-2 my-md-0" href="logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-baru" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu Kasir</div>
                            <a class="nav-link " href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-bullhorn"></i></div>
                                Pengumuman
                            </a>
                            <a class="nav-link" href="pembayaran.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill-alt"></i></div>
                                Pembayaran
                            </a>
                            <a class="nav-link" href="pemesanan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                                Transaksi
                            </a>
                            <a class="nav-link active" href="stok.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                                Produk
                            </a>
                            <?php if ($_SESSION['roll'] == 'admin') { ?>
                            <div class="sb-sidenav-menu-heading">Roll Admin</div>
                            <a class="nav-link" href="kasir.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-cog"></i></div>
                                Kelola Kasir
                            </a>
                            <?php } else { ?>
                            <div class="sb-sidenav-menu-heading">Roll Kasir</div>
                            <a class="nav-link" href="pwd.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-exchange-alt"></i></div>
                                Ubah Password
                            </a>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Masuk sebagai :</div>
                        <?php echo $_SESSION['nama']; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-2 mb-4">Daftar Produk</h1>
                        <?php if(isset($_GET['sukses'])){?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Sukses!</strong> Berhasil update produk.</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['suksesh'])){?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Sukses!</strong> Berhasil hapus produk.</span>
                        </div>
                        <?php }?>
                        <?php 
                        $baca = baca_produk();
                        ?>
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Deskripsi</th>
                                                <th>Stok</th>
                                                <th>Harga</th>
                                                <?php  // tak komen dulu fiturnya
                                                /*<?php if ($_SESSION['roll'] == 'admin') { ?>
                                                <th class="text-center" style="width: 8%">Aksi</th>
                                            <?php } else {

                                            } ?> 
                                            */?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                $j =1;
                                                foreach ($baca as $key => $val) {
                                             ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $val['kodeProduk'] ?></td>
                                                <td nowrap><?= $val['namaProduk'] ?></td>
                                                <td><?= $val['deskripsi'] ?></td>
                                                <td><?= $val['stok'] ?></td>
                                                <td>Rp.<?= number_format($val['harga']) ?></td>
                                                <?php /* // tak komen dulu fiturnya
                                                <?php if ($_SESSION['roll'] == 'admin') { ?>
                                                <td nowrap class="text-center">
                                                <button class="btn btn-baru" data-toggle="modal" data-target="#myModal<?= $i;?>"><i class="fas fa-edit"></i></button>
                                            
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#Modal<?= $j;?>"><i class="fas fa-trash"></i></button></td>
                                            <?php } else {
                                                
                                            } ?>
                                            */?>
                                            </tr>
                                            <!-- The Modal -->
                                            <div class="modal fade" id="myModal<?= $i;?>">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Ubah Detail Produk</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <form action="stok.php?ubah=y" method="post">
                                                            <div class="form-group">
                                                            <label for="kodeP">Kode Produk</label>
                                                            <input type="text" class="form-control" id="kodeP" value="<?= $val['kodeProduk'];?>" readonly>
                                                            <input type="hidden" name="id" class="form-control" id="id" value="<?= $val['idProduk'];?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama_pr">Nama Produk</label>
                                                                <input type="text" class="form-control" id="nama_pr" value="<?= $val['namaProduk'];?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="harga">Harga Produk</label>
                                                                <input type="number" name="harga" class="form-control" id="harga" min="1" value="<?= $val['harga'];?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Ubah</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- The Modal -->
                                                    <div class="modal fade" id="Modal<?= $j;?>">
                                                        <div class="modal-dialog">
                                                          <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                              <h4 class="modal-title">Hapus Produk</h4>
                                                          </div>

                                                          <!-- Modal body -->
                                                          <div class="modal-body">
                                                              Apakah anda yakin ingin menghapus produk dari daftar?
                                                          </div>

                                                          <!-- Modal footer -->
                                                          <div class="modal-footer">
                                                              <button type="button" class="btn btn-success" data-dismiss="modal">tidak</button>
                                                              <a href="stok.php?hapus=y&idpr=<?= $val['idProduk']; ?>" class="btn btn-danger">Ya</a>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                            <?php $i++; $j++;
                                            }; //end loop
                                             ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">&copy; Central Electronic's &trade; 2021</div>
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
    </body>
</html>
