<?php 
require_once "functions.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
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
        <title>Pembayaran Produk | Central Electronic's</title>
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
                            <a class="nav-link active" href="pembayaran.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill-alt"></i></div>
                                Pembayaran
                            </a>
                            <a class="nav-link" href="pemesanan.php">
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
                        <h1 class="mt-2 mb-4">Pembayaran</h1>
                        <?php if(isset($_GET['sukses'])){?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Sukses!</strong> Berhasil Update Produk Transaksi.</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['sukseshapus'])){?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Sukses!</strong> Berhasil Hapus Produk Transaksi.</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['diskons'])){?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Sukses!</strong> Berhasil Menambahkan Kode Voucher.</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['gagal'])){?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Gagal!</strong> Stok Produk Tidak Mencukupi.</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['suksesp'])){?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Sukses!</strong> Berhasil Menambah Produk Transaksi.</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['gagalp'])){?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Gagal!</strong> Stok Produk Tidak Mencukupi.</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['suksesb'])){?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Sukses!</strong> Pembayaran Berhasil.</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['gagalb'])){?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Gagal!</strong> Jumlah yang dibayarkan kurang <?= $_GET['kurang']; ?>.</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['diskong'])){?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Gagal!</strong> Kode Voucher Salah!</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['kadaluarsa'])){?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Gagal!</strong> Kode voucher sudah tidak berlaku!</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['kosong'])){?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Gagal!</strong> Kode voucher telah habis!</span>
                        </div>
                        <?php }?>
                        <div class="row">
                            <div class="col-sm-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header">
                                    <h5 class="mt-2"><i class="fa fa-search"></i> Cari Produk</h5>
                                </div>
                                <div class="card-body">
                                    <form action="">
                                    <input type="text" id="cari" class="form-control" name="cari_barang" placeholder="Masukan : Kode / Nama Produk  [ENTER]" 
                                    <?php 
                                    if(isset($_GET['cari_barang'])) {?> 
                                        value="<?= $_GET['cari_barang'] ?>"
                                        <?php } else {

                                        } //end if?> 
                                         >
                                    </form>
                                </div>
                            </div>
                            </div>
                            <?php // fitur cari
                            if(!empty($_GET['cari_barang'])){
                                $cari = $_GET['cari_barang'];
                                $hasil_cari = cari_barang($cari);
                                if ($cari='') {
                                
                                }else {
                                ?>
                        <div class="col-sm-8">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header">
                                    <h5 class="mt-2"><i class="fa fa-list"></i> Hasil Pencarian</h5>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" id="datahasil" cellspacing="0">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Produk</th>
                                            <th>Deskripsi</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        foreach ($hasil_cari as $key => $val) {?>
                                            <tr>
                                                <td><?php echo $val['kodeProduk'];?></td>
                                                <td><?php echo $val['namaProduk'];?></td>
                                                <td><?php echo $val['deskripsi'];?></td>
                                                <td>Rp.<?php echo number_format($val['harga']);?></td>
                                                <td><a href="pembayaran.php?cari_barang=<?= $_GET['cari_barang'] ?>&tambah_kasir=y&idProduk=<?= $val['idProduk'];?>" class="btn btn-baru" title="Tambahkan produk"><i class="fa fa-shopping-cart"></i></a>
                                                    </td>
                                                    </tr>
                                                <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- <script src="assets/demo/datatables-demo.js"></script> -->
                            <?php } }?>
                        </div>
                        <?php if(!empty($_GET['reset'])) { //reset keranjang kasir
                            delete_pem();
                            if (isset($_SESSION['diskon'])) {
                                $baca_kasir = baca_pembayaran();
                                if (sizeof($baca_kasir)<1) {
                                    unset($_SESSION["diskon"]);
                                    unset($_SESSION["k_diskon"]);
                                }
                            }
                            header("Location:pembayaran.php");
                        } ?>
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-10 mt-2">
                                        <h5><i class="fas fa-cash-register"></i> Pembayaran Kasir</h5>
                                    </div>
                                    <div class="col-2 text-right">
                                        <a href="pembayaran.php?reset=y" class="btn btn-danger">Reset</a>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            if(!empty($_GET['tambah_kasir'])){ // tambah data ke keranjang kasir
                                $id = $_GET['idProduk'];
                                $jumlah = 1;
                                $baca = baca_produk($id);
                                $total = $baca[0]['harga'];
                                $bacaKasir = baca_pembayaran($id);
                                
                                if ($baca[0]['stok'] > 0) { // validasi jika stok produk masih cukup
                                    if (sizeof($bacaKasir) > 0) { // validasi jika barang dengan nama yang dipilih di hasil pencarian sudah ada dikeranjang
                                        if ($baca[0]['stok'] > $bacaKasir[0]['qty']) { // validasi jika stok produk yang dimasukan ke keranjang dalam stok yang masih cukup
                                            $qty = $bacaKasir[0]['qty'];
                                            $total2 = $bacaKasir[0]['total'];
                                            update_pk($id,$qty,$total2,$total); // tambah kuantitas dikeranjang
                                            header("Location:pembayaran.php?cari_barang=".$_GET['cari_barang']."&suksesp=y");
                                        } else {
                                            header("Location:pembayaran.php?gagalp=y");
                                        }
                                    } else {
                                        tambah_pk($id,$jumlah,$total); // tambah data produk ke keranjang
                                        header("Location:pembayaran.php?cari_barang=".$_GET['cari_barang']."&suksesp=y");
                                        }
                                    } else {
                                        header("Location:pembayaran.php?gagalp=y");
                                    }
                                }

                                if(!empty($_GET['up'])){ // update kuantitas pada keranjang
                                    $idProduk = $_POST['idProduk'];
                                    $qty = $_POST['kuantitas'];

                                    $baca = baca_produk($idProduk);

                                    if ($baca[0]['stok'] >= $qty) { // validasi jika stok masih cukup untuk mengupdate kuantitas
                                        $harga = $baca[0]['harga'];
                                        update_qty($idProduk,$qty,$harga);
                                        header("Location:pembayaran.php?sukses=y");
                                    } else {
                                        header("Location:pembayaran.php?gagal=y");
                                    } 
                                }

                                if(!empty($_GET['hapus'])){ // hapus produk pada keranjang kasir
                                    $hapus = $_GET['hapus'];
                                    delete_pk($hapus);
                                    
                                    if (isset($_SESSION['diskon'])) { // jika diskon terpasang maka hapus diskon
                                        $baca_kasir = baca_pembayaran();
                                        if (sizeof($baca_kasir)<1) {
                                            unset($_SESSION["diskon"]);
                                            unset($_SESSION["k_diskon"]);
                                        }
                                    }
                                    header("Location:pembayaran.php?sukseshapus=y");
                                }
                                ?>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataKasir" width="100%" cellspacing="0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Produk</th>
                                                <th>Kuantitas</th>
                                                <th>Total</th>
                                                <th class="text-center" style="width: 8%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i=1;
                                                $bacaPembayaran = baca_pembayaran();
                                                $total_harga = 0;
                                                foreach ($bacaPembayaran as $key => $val) {
                                             ?>
                                            <tr>
                                                <?php 
                                                if (isset($_SESSION['diskon'])) {?> <!-- validasi jika diskon sudah terpasang atau belum -->
                                                    <form action="pembayaran.php?up=y&dis=y" method="post">
                                            <?php } else { ?>
                                                <form action="pembayaran.php?up=y" method="post">
                                          <?php }
                                                 ?>
                                                
                                                <td><?= $i++; ?></td>
                                                <td><?= $val['namaProduk'] ?></td>
                                                <td style="width: 10%">
                                                    <input name="kuantitas" type="number" value="<?= $val['qty'] ?>" class="form-control" min="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required oninvalid="this.setCustomValidity('Stok produk tidak boleh kosong!')" oninput="this.setCustomValidity('')">
                                                    <input name="idProduk" type="hidden" value="<?= $val['idProduk'] ?>" class="form-control">
                                                </td>
                                                <td>Rp.<?= number_format($val['total']) ?></td>
                                                <td nowrap class="text-center"><button type="submit" class="btn btn-baru text-light" title="Update Keranjang"><i class="fa fa-sync"></i></button>
                                                </form>
                                                    <a href="pembayaran.php?hapus=<?= $val['idProduk']?>"  class="btn btn-danger" title="Hapus Keranjang"><i class="fa fa-trash"></i>
                                                        </a>
                                                </td>
                                            </tr>
                                            <?php 
                                            $total_harga += $val['total'];
                                            }; //end loop
                                             ?>
                                        </tbody>
                                    </table>
                                    <?php 
                                        if(!empty($_GET['bayar'])) { // pembayaran pada keranjang kasir
                                            $bayar = $_POST['jum_bayar'];
                                            $total_h = $_POST['total_harga'];
                                            if(!empty($bayar)) // cek jika jumlah yang dibayarkan tidak kosong
                                            {
                                                $hitung = $bayar - $total_h;
                                                if($bayar >= $total_h) // validasi jika jumlah yang dibayar melebihi harga yang tertera
                                                {
                                                    $new_d['idProduk'] = $_POST['idProduk'];
                                                    $new_d['nama_produk'] = $_POST['namaProduk'];
                                                    $new_d['deskripsi'] = $_POST['deskripsi'];
                                                    $new_d['harga'] = $_POST['harga'];
                                                    $new_d['qty'] = $_POST['qty'];
                                                    $new_d['total'] = $_POST['total'];
                                                    $new_d['id'] = $_POST['kode_tr'];
                                                    $jumlah_loop = count($new_d['idProduk']);
                                                    $data['id'] = $_POST['kode_tr'];
                                                    $data['nama'] = $_POST['nama_pl'];
                                                    $data['hp'] = $_POST['no_telp'];
                                                    $data['alamat'] = $_POST['alamat'];
                                                    $data['kasir'] = $_SESSION['nama'];
                                                    $data['diskon'] = $_SESSION['diskon'];
                                                    $data['kode_diskon'] = $_SESSION['k_diskon'];
                                                    $data['total_harga'] = $total_h;
                                                    $data['total_dibayar'] = $bayar;
                                                    $data['kembalian'] = $hitung;
                                                    tambah_psn($data); // insert data pemesanan

                                                    for ($x=0; $x < $jumlah_loop; $x++) { // insert data detail pemesanan dan update stok barang
                                                        tambah_keluar($new_d,$x,$data['nama']); // data barang yang masuk gudang barang keluar
                                                        tambah_dtl($new_d,$x); // menambah detail pemesanan
                                                        $baca_u = baca_produk($new_d['idProduk'][$x]);
                                                        $stok_s = $baca_u[0]['stok'];
                                                        $id_p = $new_d['idProduk'][$x];

                                                        $stok_b = $stok_s - $new_d['qty'][$x];
                                                        update_pr($id_p,$stok_b); // mengurangi stok produk
                                                    }
                                                        delete_pem(); // reset daftar pada keranjang kasir
                                                        if (isset($_SESSION['k_diskon'])) { // validasi apakah diskon sudah terpasang
                                                            $kode_d = $_SESSION['k_diskon'];
                                                            $baca_diskon2 = baca_diskon($kode_d);
                                                            $stok_d = $baca_diskon2[0]['stok_diskon']-1;
                                                            update_diskon2($kode_d, $stok_d); // kurangi stok diskon
                                                            unset($_SESSION["diskon"]); 
                                                            unset($_SESSION["k_diskon"]); // hapus diskon yang terpasang
                                                        }
                                                        
                                                        header("Location:pembayaran.php?suksesb=y");
                                                    }else{
                                                        header("Location:pembayaran.php?gagalb=y&kurang=".abs($hitung)."&jum_bayar=$bayar"); // pesan bayaran kurang
                                                    }
                                                }
                                            }
                                     ?>

                                    <table class="table table-stripped mt-2">
                                        <form action="pembayaran.php?bayar=y" method="post">
                                        <?php 
                                            foreach ($bacaPembayaran as $key => $val) {
                                         ?>
                                         <input type="hidden" name="idProduk[]" value="<?= $val['idProduk']?>">
                                         <input type="hidden" name="namaProduk[]" value="<?= $val['namaProduk']?>">
                                         <input type="hidden" name="deskripsi[]" value="<?= $val['deskripsi']?>">
                                         <input type="hidden" name="harga[]" value="<?= $val['harga']?>">
                                         <input type="hidden" name="qty[]" value="<?= $val['qty']?>">
                                         <input type="hidden" name="total[]" value="<?= $val['total']?>">
                                     <?php } ?>
                                        <tr>
                                            <td>Total Harga</td>
                                            <?php 
                                            if(!empty($_GET['disx'])) { // fungsi batal penggunaan diskon
                                                unset($_SESSION["diskon"]);
                                                unset($_SESSION["k_diskon"]);
                                                header("Location:pembayaran.php");
                                            }
                                                if(!empty($_GET['dis'])) { // penggunaan diskon
                                                
                                                if (isset($_SESSION['k_diskon'])) { // validasi apakah diskon sudah terpasang
                                                    $kode_d = $_SESSION['k_diskon'];
                                                } else {
                                                    $kode_d = $_POST['diskon'];
                                                }
                                                $baca_diskon = baca_diskon($kode_d);
                                                if (sizeof($baca_diskon)>0) { // cek apakah voucher tersedia
                                                    $kadaluarsa = strtotime($baca_diskon[0]['expired']);
                                                    $tgl_s = strtotime(date("Y-m-d"));
                                                    if ($tgl_s <= $kadaluarsa) { // cek apakah diskon masih berlaku
                                                        if ($baca_diskon[0]['stok_diskon']>0) { // cek apakah stok diskon masih cukup
                                                            $diskon_p = $baca_diskon[0]['diskon'];
                                                            $diskon = ($total_harga*$diskon_p)/100;
                                                            $_SESSION['diskon'] = $diskon; // gunakan diskon
                                                            $_SESSION['k_diskon'] = $kode_d;
                                                            header("Location:pembayaran.php?diskons=y");
                                                        } else {
                                                            header("Location:pembayaran.php?kosong=y");
                                                        }
                                                    } else {
                                                        header("Location:pembayaran.php?kadaluarsa=y");
                                                    }
                                                } else{
                                                    header("Location:pembayaran.php?diskong=y");
                                                }
                                                
                                            }?>
                                            <td><input type="text" class="form-control" name="total_harga"
                                                <?php if (isset($_SESSION['diskon'])){ ?> 
                                                    value="<?= $total_harga-$_SESSION['diskon']; ?>"
                                                <?php } else {?>
                                                value="<?= $total_harga; ?>" 
                                            <?php } ?>
                                                readonly></td>
                                            <td>Kembalian</td>
                                            <td><input type="text" name="kembalian" class="form-control" value="0" id="cal2" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Bayar</td>
                                            <td>
                                                
                                                <input type="number" name="jum_bayar" class="form-control" id="cal3" placeholder="Masukan Jumlah Bayar" min="1" required oninvalid="this.setCustomValidity('Masukan jumlah yang akan dibayarkan !')" onkeypress="return event.charCode >= 48 && event.charCode <= 57" oninput="this.setCustomValidity('')" onkeyup="auto();" 
                                                <?php if(isset($_GET['jum_bayar'])) {?> 
                                                    value="<?= $_GET['jum_bayar'] ?>"
                                                <?php } else {

                                                } //end if?> 
                                                >
                                                <input type="hidden" class="form-control" id="cal1" 
                                                <?php if (isset($_SESSION['diskon'])){ ?>
                                                    value="<?= $total_harga-$_SESSION['diskon']; ?>"
                                                <?php } else {?>
                                                value="<?= $total_harga; ?>" 
                                            <?php } ?> onkeyup="auto();">
                                            </td>
                                            <td>
                                                <?php 
                                                    if (sizeof($bacaPembayaran) > 0) {
                                                        $modal = "#myModal";
                                                    }else {
                                                        $modal = "#myModal2";
                                                    }
                                                 ?>
                                                <button type="button" class="btn btn-baru" data-toggle="modal" data-target="<?php echo $modal; ?>"><i class="fa fa-shopping-cart"></i> Bayar</button>
                                            </td>
                                        </tr>
                                        <!-- The Modal -->
                                        <div class="modal fade" id="myModal">
                                            <div class="modal-dialog">
                                              <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Pembayaran</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              </div>

                                              <!-- Modal body -->
                                              <div class="modal-body">
                                                <div class="form-group">
                                                    <?php 
                                                    $bacaTrx = baca_detail_trx();
                                                    if (sizeof($bacaTrx) > 0){ // validasi apakah sudah ada data detail transaksi
                                                        $gen = gen_trx(); // generate kode dari nilai tertinggi detail transaksi
                                                        $generate = $gen['noAkhir'];

                                                        $nomor = $generate++;

                                                        $no_trx = "".sprintf("%09s",$nomor);
                                                    } else {
                                                        $nomor =1;
                                                        $no_trx = "".sprintf("%09s",$nomor);
                                                    }
                                                     ?>
                                                    
                                                    <label for="kode_tr">Kode Transaksi</label>
                                                    <input type="text" name="kode_tr" class="form-control" id="kode_tr" value="ADA<?= $no_trx;?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tgl_byr">Tanggal Pembayaran</label>
                                                    <input type="text" class="form-control" id="tgl_byr" value="<?= date("Y-m-d");?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_pl">Nama Pelanggan</label>
                                                    <input type="text" name="nama_pl" class="form-control" id="nama_pl" placeholder="Masukan nama pelanggan" required oninvalid="this.setCustomValidity('Masukan Nama Pelanggan !')" oninput="this.setCustomValidity('')">
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_hp">Nomor Telepon : </label>
                                                    <input type="tel" name="no_telp" class="form-control" id="no_hp" placeholder="0812-2312-1234" required oninvalid="this.setCustomValidity('Masukan Nomor Telepon Pelanggan !')" oninput="this.setCustomValidity('')">
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukan alamat pelanggan" required oninvalid="this.setCustomValidity('Masukan Alamat Pelanggan !')" oninput="this.setCustomValidity('')">
                                                </div>
                                                
                                                  
                                              </div>

                                              <!-- Modal footer -->
                                              <div class="modal-footer">
                                                  <button type="submit" class="btn btn-baru"><i class="fa fa-shopping-cart"></i> Bayar</button>
                                              </div>

                                          </div>
                                      </div>
                                  </div>
                                        </form>
                                        <tr>
                                            <form action="pembayaran.php?dis=y" method="post">
                                            <td>Voucher Diskon</td>
                                            <td><input type="text" name="diskon" class="form-control" placeholder="Masukan Kode" 
                                            <?php if (isset($_SESSION['diskon'])) {?>
                                                value="<?= $_SESSION['k_diskon']; ?>"    
                                            <?php } ?> required oninvalid="this.setCustomValidity('Masukan Kode Voucher !')" oninput="this.setCustomValidity('')"></td>
                                            <td>
                                                <?php if (isset($_SESSION['diskon'])) {?>
                                                    <a href="pembayaran.php?disx=y" class="btn btn-danger"><i class="fas fa-times"></i></a>
                                                    <?php } else {?>
                                                <?php 
                                                    if (sizeof($bacaPembayaran) > 0) {?>
                                                        <button type="submit" class="btn btn-baru">Gunakan</button>
                                                   <?php } else {?>
                                                    <button type="button" class="btn btn-baru" data-toggle="modal" data-target="#myModal2">Gunakan</button>
                                            <?php } } ?>
                                            </td>
                                            </form>
                                        </tr>
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

        <!-- The Modal -->
        <div class="modal fade" id="myModal2">
            <div class="modal-dialog">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Pembayaran</h4>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                  Silahkan masukan produk pada kasir terlebih dahulu
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              </div>

          </div>
      </div>
  </div>

        <script>
            function auto() {
              var bayar = document.getElementById('cal3').value;
              var harga = document.getElementById('cal1').value;
              var result = parseInt(bayar) - parseInt(harga);
              if (!isNaN(result)) {
               document.getElementById('cal2').value = result;
               if (result < 0) {
                    document.getElementById('cal2').value = 0;
               }
           }
       }
        </script>
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
