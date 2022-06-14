<?php  
require_once "functions.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$idtrx = $_GET['idtrx'];

if ((strpos($idtrx,"RT")) === 0) { //validasi jika id pemesanan adalah retur
    $idretur = $idtrx;
} else {
    $idretur = 'RT'.$idtrx;
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
        <title>Detail Transaksi | Central Electronic's</title>
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
                            <a class="nav-link active" href="pemesanan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                                Transaksi
                            </a>
                            <a class="nav-link" href="stok.php">
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
                        <h1 class="mt-2">Detail Transaksi</h1>
                        <ul class="breadcrumb bg-light shadow-sm">
                          <li class="breadcrumb-item"><a href="pemesanan.php">Daftar Transaksi</a></li>
                          <li class="breadcrumb-item">Detail Transaksi</a></li>
                        </ul>
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                 Transaksi <?= $idtrx; ?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="" width="100%" cellspacing="0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Produk</th>
                                                <th>Deskripsi</th>
                                                <th>Kuantitas</th>
                                                <th>Harga</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                $baca = baca_detail_trx($idtrx);
                                                foreach ($baca as $key => $val) {
                                             ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $val['namaProduk'] ?></td>
                                                <td><?= $val['deskripsi'] ?></td>
                                                <td><?= $val['qty'] ?></td>
                                                <td>Rp.<?= number_format($val['harga']) ?></td>
                                                <td>Rp.<?= number_format($val['total']) ?></td>
                                            </tr>
                                            <?php 
                                            }; //end loop
                                             ?>
                                             </tbody>
                                             <tfoot>
                                            <?php 
                                                    if ($idtrx != $idretur) {
                                                        if ($val['diskon'] > 0) {?>
                                            <tr>
                                                 <td colspan="4" class="text-right">Diskon :</td>
                                                 <td colspan="2" >Rp.<?= number_format($val['diskon']) ?> (<?= $val['kode_diskon']; ?>)</td>
                                             </tr>
                                         <?php } ?>
                                            <tr>
                                                 <td colspan="4" class="text-right">Harga Beli :</td>
                                                 <td colspan="2" >Rp.<?= number_format($val['totalHarga']) ?></td>
                                             </tr>
                                             <tr>
                                                 <td colspan="4" class="text-right">Dibayar :</td>
                                                 <td colspan="2">Rp.<?= number_format($val['totalDibayar']) ?></td>
                                             </tr>
                                             <tr>
                                                 <td colspan="4" class="text-right">Kembali :</td>
                                                 <td colspan="2">Rp.<?= number_format($val['kembalian']) ?></td>
                                             </tr>
                                             <?php 
                                                $baca_psn = baca_trx($idretur);
                                                if (sizeof($baca_psn) > 0) { ?>
                                            <tr>
                                                 <td colspan="6" class="text-right">(transaksi ini memiliki barang return : <a href="detail_pemesanan.php?idtrx=<?= $idretur; ?>"><?= $idretur;?></a>)</td>
                                             </tr>
                                                <?php }
                                                } else {?>
                                                 <td colspan="4" class="text-right">Total nilai pengembalian :</td>
                                                 <td colspan="2" >Rp.<?= number_format($val['totalHarga']) ?></td>
                                             <?php } ?>
                                             </tfoot>
                                        
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
