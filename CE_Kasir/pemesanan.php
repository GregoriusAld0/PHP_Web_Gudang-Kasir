<?php  
require_once "functions.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

if (!empty($_GET['retur'])) { // pengembalian barang
    $data['nama'] = $_POST['nama_pl'];
    $data['hp'] = $_POST['no_telp'];
    $data['alamat'] = $_POST['alamat'];
    $data['idProduk'] = $_POST['idProduk'];
    $data['kuantitas'] = $_POST['kuantitas'];
    $data['ket'] = $_POST['ket'];
    $data['kode'] = $_POST['kode_rt'];
    $data['kodetr'] = $_POST['kode_tr'];
    $data['tgl'] = $_POST['tgl_byr'];
    $data['kasir'] = $_SESSION['nama'];

    $baca_dtl2 = cek_detail_trx($data);
    if ($baca_dtl2[0]['qty'] >= $data['kuantitas']) { // validasi kuantitas yang ingin di retur tidak melebihi stok yang telah dibeli
        $qty_s = $baca_dtl2[0]['qty'] - $data['kuantitas'];
        $idP = $baca_dtl2[0]['idProduk'];
        $kodetr = $data['kodetr'];
        $kode = $data['kode'];
        $hargaP = $baca_dtl2[0]['harga'];
        $data['nama_produk'] = $baca_dtl2[0]['namaProduk'];
        $data['deskripsi'] = $baca_dtl2[0]['deskripsi'];
        $data['harga'] = $baca_dtl2[0]['harga'];
        update_dtl_psn($qty_s,$idP,$kodetr,$hargaP); //update pemesanan sblm retur(komen dlu)
        
        tambah_dtl_psn_d($data,$hargaP); //tambah detail retur pesanan
        tambah_masuk($data); // tambah produk ke gudang tabel masuk

        $baca_retur = baca_detail_trx2($kode);
        $baca_rt2 = baca_trx($kode);
        $total_hrt = 0;
        foreach ($baca_retur as $key => $val) {
        $total_hrt += $val['total'];
        }
        if (sizeof($baca_rt2) > 0) { // validasi jika data retur telah dibuat
            update_psn_d($data,$total_hrt);
        }else{
            tambah_psn_d($data,$total_hrt);
        }
        
        $baca_pr = baca_produk($idP); 
        $stok_s = $baca_pr[0]['stok'];
        $stok_u = $data['kuantitas'];
        $stok = $stok_s + $stok_u;
        update_pr($idP, $stok); // update stok produk setelah retur

        header("Location:pemesanan.php?sukses=y");
    } else {
        header("Location:pemesanan.php?gagal=y");
    }
    
    
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
        <title>Daftar Transaksi | Central Electronic's</title>
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
                        <h1 class="mt-2 mb-4">Daftar Transaksi</h1>
                        <?php if(isset($_GET['sukses'])){?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Sukses!</strong> Berhasil mengembalikan produk.</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['gagal'])){?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Gagal!</strong> Kuantitas yang dimasukan melebihi jumlah produk transaksi.</span>
                        </div>
                        <?php }?>
                        <?php
                        if (isset($_POST['filter_tgl'])) { // filter transaksi bdsrkn tanggal
                            $tgl_mulai = $_POST['tgl_mulai'];
                            $tgl_selesai = $_POST['tgl_selesai'];
                            if($tgl_mulai != null || $tgl_selesai != null) { //validasi jika filter tanggal diisi
                                $baca = baca_filter($tgl_mulai,$tgl_selesai);
                            } else {
                                $baca = baca_trx();
                            }
                        } else {
                            $baca = baca_trx();
                        }?>
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md">
                                        <div class="float-right">
                                        <form method="post" class="form-inline">
                                            <input type="date" name="tgl_mulai" class="form-control mr-3">
                                            <h3>-</h3>
                                            <input type="date" name="tgl_selesai" class="form-control ml-3">
                                            <button type="submit" name="filter_tgl" class="btn btn-baru ml-2"><i class="fas fa-filter mr-1" title="Filter Tanggal"></i>Filter</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="datatrx" width="100%" cellspacing="0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Kode</th>
                                                <th>Tanggal</th>
                                                <th nowrap>Nama Pelanggan</th>
                                                <th>No. Hp</th>
                                                <th>Alamat</th>
                                                <th>Total</th>
                                                <th>Kasir</th>
                                                <th class="text-center" style="width: 8%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                foreach ($baca as $key => $val) {
                                                $baca_dtl = baca_detail_trx($val['idPemesanan']);
                                             ?>
                                            <tr>
                                                <td><a href="detail_pemesanan.php?idtrx=<?= $val['idPemesanan'];?>"><?= $val['idPemesanan'] ?></a></td>
                                                <td nowrap><?= $val['tglPemesanan'] ?></td>
                                                <td nowrap><?= $val['namaPelanggan'] ?></td>
                                                <td nowrap><?= $val['hp'] ?></td>
                                                <td nowrap><?= $val['alamat'] ?></td>
                                                <td>Rp.<?= number_format($val['totalHarga']); ?></td>
                                                <td><?= $val['kasir'] ?></td>
                                                <td nowrap class="text-center">
                                                    <?php 
                                                        if (strpos($val['idPemesanan'], "RT") === 0) {
                                                     ?>
                                                     <button class="btn btn-baru" title="Retur Produk" data-toggle="modal" data-target="#myModal<?= $i;?>" disabled><i class="fas fa-people-carry"></i></button>
                                                    <?php } else {?>
                                                <button class="btn btn-baru" title="Retur Produk" data-toggle="modal" data-target="#myModal<?= $i;?>"><i class="fas fa-people-carry"></i></button>
                                            <?php } ?>
                                                <a href="print.php?id=<?= $val['idPemesanan'] ?>" target="_blank"><button class="btn btn-baru" title="Print Data Transaksi"><i class="fas fa-print"></i></button></td>
                                            </tr>
                                            <!-- The Modal -->
                                            <div class="modal fade" id="myModal<?= $i;?>">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Pengembalian Produk</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <form action="pemesanan.php?retur=y" method="post">
                                                        <div class="form-group">
                                                            <label for="kode_tr">Kode Transaksi</label>
                                                            <input type="text" class="form-control" id="kode_tr" value="<?= $val['idPemesanan'];?>" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" name="kode_rt" class="form-control" id="kode_rt" value="RT<?= $val['idPemesanan'];?>">
                                                            <input type="hidden" name="kode_tr" class="form-control" id="kode_tr" value="<?= $val['idPemesanan'];?>">
                                                            <input type="hidden" name="no_telp" class="form-control" id="no_hp" value="<?= $val['hp'];?>">
                                                            <input type="hidden" name="alamat" class="form-control" id="alamat" value="<?= $val['alamat'];?>">
                                                            <label for="tgl_byr">Tanggal Pengembalian</label>
                                                            <input type="date" class="form-control" id="tgl_byr" required oninvalid="this.setCustomValidity('Masukan Tanggal Retur Produk !')" oninput="this.setCustomValidity('')">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama_pl">Nama Pelanggan</label>
                                                            <input type="text" name="nama_pl" class="form-control" id="nama_pl" value="<?= $val['namaPelanggan'];?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="idProduk">Produk</label>
                                                            <select name="idProduk" class="form-control" id="idProduk">
                                                                <?php 
                                                                    foreach ($baca_dtl as $key => $val2) {
                                                                 ?>
                                                                <option value="<?= $val2['idProduk'];?>"><?= $val2['namaProduk'];?></option>
                                                            <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="kuantitas">Jumlah Pengembalian</label>
                                                            <input type="number" name="kuantitas" class="form-control" id="kuantitas" min="1" placeholder="Qty" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required oninvalid="this.setCustomValidity('Stok produk tidak boleh kosong !')" oninput="this.setCustomValidity('')">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ket">Alasan</label>
                                                            <input type="text" name="ket" class="form-control" id="ket" placeholder="Alasan pengembalian" required oninvalid="this.setCustomValidity('Masukan Alasan Retur Produk !')" oninput="this.setCustomValidity('')">
                                                        </div>

                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-baru">Return</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                            <?php $i++;
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
