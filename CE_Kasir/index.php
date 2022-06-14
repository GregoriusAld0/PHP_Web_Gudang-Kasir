<?php  
require_once "functions.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

if (!empty($_GET['ubah'])) { // ubah pengumuman atau diskon
    $data['isi'] = $_POST['isi'];
    $data['diskon'] = $_POST['diskon'];
    $data['expired'] = $_POST['expired'];
    $data['stok_diskon'] = $_POST['stok_diskon'];
    $data['id_diskon'] = $_POST['id_diskon'];
    $data['id_pengumuman'] = $_POST['id_pengumuman'];
    update_diskon($data);
    update_pengumuman($data);
    header("Location:index.php?sukses=y");
}

if (!empty($_GET['tambah'])) { // tambah pengumuman atau dan diskon
    $data['isi'] = $_POST['isi'];
    $data['kode_diskon'] = $_POST['kode_diskon'];
    $data['diskon'] = $_POST['diskon'];
    $data['stok_diskon'] = $_POST['stok_diskon'];
    $data['expired'] = $_POST['expired'];
    $kode_d = $data['kode_diskon'];
    $bacaD = baca_diskon($kode_d);
    if (sizeof($bacaD) > 0) {
        header("Location:index.php?gagalt=y");
    } else {
        tambah_pengumuman($data);
        tambah_diskon($data);
        header("Location:index.php?suksest=y");
    }
    
}

if (!empty($_GET['hapus'])) { // hapus pengumuman serta diskon
    $hapus = $_GET['pengumuman'];
    $hapus2 = $_GET['diskon'];
    delete_diskon($hapus2);
    delete_pengumuman($hapus);
    header("Location:index.php?suksesh=y");
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
        <title>Pengumuman | Central Electronic's</title>
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
                            <a class="nav-link active" href="index.php">
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
                    <?php 
                        $baca_trx = baca_trx();
                        $baca_produk = baca_produk();
                        $baca_kasir = baca_user_noid();
                     ?>
                    <div class="container-fluid">
                        <h1 class="mt-2">Pengumuman</h1>
                        <div class="row mt-4">
                            <?php if ($_SESSION['roll'] == 'admin') { ?>
                            <div class="col-md-4">
                                <div class="card bg-baru2 text-white mb-4 shadow">
                                    <div class="card-body"><i class="fas fa-users mr-2"></i><strong>Total Kasir</strong></div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div class="text-white stretched-link"><h2><?= sizeof($baca_kasir)-1; ?></h2></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                            <div class="col-md-4">
                                <div class="card bg-baru2 text-white mb-4 shadow">
                                    <div class="card-body"><i class="fas fa-boxes mr-2"></i><strong>Total Produk</strong></div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div class="text-white stretched-link"><h2><?= sizeof($baca_produk); ?></h2></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-baru2 text-white mb-4 shadow">
                                    <div class="card-body"><i class="fas fa-receipt mr-2"></i><strong>Total Transaksi</strong></div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div class="text-white stretched-link"><h2><?= sizeof($baca_trx); ?></h2></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($_GET['sukses'])){?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Sukses!</strong> Berhasil ubah pengumuman atau diskon.</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['suksest'])){?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Sukses!</strong> Berhasil tambah pengumuman atau diskon.</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['suksesh'])){?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Sukses!</strong> Berhasil hapus pengumuman dan diskon.</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['gagalt'])){?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Gagal!</strong> Kode diskon sudah tersedia.</span>
                        </div>
                        <?php }?>
                        <?php 
                                    $bacaPengumuman = baca_pengumuman();
                                    $bacaDiskon = baca_diskon();
                                 ?>
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header">
                                <div class="row">
                                    <?php if ($_SESSION['roll'] == 'admin') { ?>
                                    <div class="col-md text-right">
                                        <button class="btn btn-baru" data-toggle="modal" data-target="#tModal"><i class="fas fa-plus"></i> Tambah Pengumuman</button>
                                    </div>
                                <?php } else {

                                } ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="dataPengumuman" width="100%" cellspacing="0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th hidden style="width: 8%">No</th>
                                                <th><center>Pengumuman</center></th>
                                                <?php if ($_SESSION['roll'] == 'admin') { ?>
                                                <th class="text-center" style="width: 8%">Aksi</th>
                                            <?php } else {

                                            } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                $j =1;
                                                $k = 0;
                                                foreach ($bacaPengumuman as $key => $val) {
                                             ?>
                                            <tr>
                                                <td hidden><?= $i;?></td>
                                                <td ><div class="alert alert-baru"><?= $val['isi']; ?> (<?= $bacaDiskon[$k]['kodeDiskon']; ?>)</div></td>
                                                <?php if ($_SESSION['roll'] == 'admin') { ?>
                                                <td nowrap class="text-center">
                                                <button class="btn btn-baru" title="Ubah Pengumuman" data-toggle="modal" data-target="#myModal<?= $i;?>"><i class="fas fa-edit"></i></button>
                                            
                                                <button class="btn btn-danger" title="Hapus Pengumuman" data-toggle="modal" data-target="#Modal<?= $j;?>"><i class="fas fa-trash"></i></button></td>
                                            <?php } else {

                                            } ?>
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
                                                            <form action="index.php?ubah=y" method="post">
                                                            <div class="form-group">
                                                            <label for="isi">Isi Pengumuman</label>
                                                            <input type="text" name="isi" class="form-control" id="isi" value="<?= $val['isi'];?>" required>
                                                            <input type="hidden" name="id_pengumuman" class="form-control" id="id_pengumuman" value="<?= $val['idPengumuman'];?>">
                                                            </div>
                                                            <div id="collap" class="collapse">
                                                            <div class="form-group">
                                                                <label for="kode_diskon">Kode diskon</label>
                                                                <input type="text" class="form-control" id="kode_diskon" value="<?= $bacaDiskon[$k]['kodeDiskon'];?>" readonly>
                                                                <input type="hidden" name="id_diskon" class="form-control" id="id_diskon" value="<?= $bacaDiskon[$k]['idDiskon'];?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="diskon">Diskon</label>
                                                                <input type="number" name="diskon" class="form-control" id="diskon" max="100" maxlength="3" value="<?= $bacaDiskon[$k]['diskon'];?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="expired">Tanggal Kadaluarsa</label>
                                                                <?php $date = $bacaDiskon[$k]['expired'];
                                                                $newDate = date("Y-m-d", strtotime($date)); ?>   
                                                                <input type="date" class="form-control" id="expiredD" name="expired" value="<?php echo $newDate;?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="stok_diskon">Stok Voucher Diskon</label>
                                                                <input type="number" class="form-control" id="stok_diskon" name="stok_diskon" value="<?= $bacaDiskon[$k]['stok_diskon'];?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                                            </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#collap">Ubah Diskon</button>
                                                            <button type="submit" class="btn btn-baru">Submit</button>
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
                                                              <h4 class="modal-title">Hapus Pengumuman</h4>
                                                          </div>

                                                          <!-- Modal body -->
                                                          <div class="modal-body">
                                                              Apakah anda yakin ingin menghapus pengumuman?
                                                              <br>*voucher diskon juga akan terhapus
                                                          </div>

                                                          <!-- Modal footer -->
                                                          <div class="modal-footer">
                                                            <a href="index.php?hapus=y&pengumuman=<?= $val['idPengumuman']; ?>&diskon=<?= $bacaDiskon[$k]['idDiskon']; ?>" class="btn btn-baru">Ya</a>
                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                            <?php $i++; $j++; $k++;
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
        <!-- The Modal -->
        <div class="modal fade" id="tModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pengumuman</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="index.php?tambah=y" method="post">
                        <div class="form-group">
                            <label for="isi">Isi Pengumuman</label>
                            <input type="text" name="isi" class="form-control" id="isi" placeholder="Masukan isi pengumuman" required oninvalid="this.setCustomValidity('Masukan Isi Pengumuman !')" oninput="this.setCustomValidity('')">
                        </div>
                        <div id="coll" class="collapse">
                            <div class="form-group">
                                <?php 
                                $bacaDis = baca_diskon();
                                if (sizeof($bacaDis) > 0){
                                    $gen = gen_diskon(); // generate kode diskon (untuk diskon yg tidak terpakai)
                                    $generate = $gen['noAkhir'];

                                    $nomor = $generate++;

                                    $no_diskon = "".sprintf("%03s",$nomor);
                                } else {
                                    $nomor =1;
                                    $no_diskon = "".sprintf("%03s",$nomor);
                                }
                                ?>
                                <label for="kode_diskon">Kode diskon</label>
                                <input type="kode_diskon" name="kode_diskon" class="form-control" id="kode_diskon" value="P<?= $no_diskon;?>">
                            </div>
                            <div class="form-group">
                                <label for="Diskon">Diskon</label>
                                <input type="number" name="diskon" maxlength="3" max="100" class="form-control" id="Diskon" placeholder="Masukan diskon [0-100]" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </div>
                            <div class="form-group">
                                <label for="expired">Tanggal Kadaluarsa</label>
                                <input type="date" class="form-control" id="expired" name="expired">
                            </div>
                            <div class="form-group">
                                <label for="stok_diskon">Stok voucher diskon</label>
                                <input type="number" name="stok_diskon" class="form-control" id="stok_diskon" placeholder="Masukan jumlah voucher" value="user" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#coll">Tambah Diskon</button>
                        <button type="submit" class="btn btn-baru">Submit</button>
                    </div>
                </form>
            </div>
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
