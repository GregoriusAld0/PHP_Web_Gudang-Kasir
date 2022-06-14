<?php  
require_once "functions.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}


if (!empty($_GET['ubah'])) { // ubah data kasir
    $data['email'] = $_POST['email'];
    $data['nama'] = $_POST['nama'];
    $data['idU'] = $_POST['idUser'];
    if (isset($_POST['passworda'])) { // cek apakah data yang diubah adalah data dengan roll admin
        $data['password'] = md5($_POST['passworda']);
        update_kasir2($data);
        header("Location:kasir.php?sukses=y");
    } else {
        update_kasir($data);
        header("Location:kasir.php?sukses=y");
    }
}

if (!empty($_GET['tambah'])) { // fungsi tambah akun kasir
    $data['email'] = $_POST['email'];
    $data['username'] = $_POST['username'];
    $data['password'] = $_POST['password'];
    $data['nama'] = $_POST['nama'];
    $data['roll'] = $_POST['roll'];
    $username = $data['username'];
    $bacaUser = baca_user($username);
    if (sizeof($bacaUser) > 0) { // validasi jika Nomor Pekerja sudah dibuat
        header("Location:kasir.php?gagalt=y");
    } else {
        tambah_kasir($data);
        header("Location:kasir.php?suksest=y");
    }
    
}

if (!empty($_GET['hapus'])) { // hapus data kasir
    $hapus = $_GET['username'];
    delete_kasir($hapus);
    header("Location:kasir.php?suksesh=y");
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
        <title>Daftar Kasir | Central Electronic's</title>
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
                            <a class="nav-link" href="stok.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                                Produk
                            </a>
                            <?php if ($_SESSION['roll'] == 'admin') { ?>
                            <div class="sb-sidenav-menu-heading">Roll Admin</div>
                            <a class="nav-link active" href="kasir.php">
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
                        <h1 class="mt-2 mb-4">Daftar Kasir</h1>
                        
                        <?php if(isset($_GET['sukses'])){?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Sukses!</strong> Berhasil update data.</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['suksesh'])){?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Sukses!</strong> Berhasil hapus kasir.</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['suksest'])){?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Sukses!</strong> Berhasil tambah kasir.</span>
                        </div>
                        <?php }?>
                        <?php if(isset($_GET['gagalt'])){?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Gagal!</strong> NP sudah tersedia.</span>
                        </div>
                        <?php }?>
                        <?php 
                        $baca = baca_user_noid();
                        ?>
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md text-right">
                                        <button class="btn btn-baru" data-toggle="modal" data-target="#tModal"><i class="fas fa-plus"></i> Tambah Kasir</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataAkun" width="100%" cellspacing="0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Nomor Pekerja</th>
                                                <th>Email</th>
                                                <th>Roll</th>
                                                <th class="text-center" style="width: 8%">Aksi</th>
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
                                                <td nowrap><?= $val['nama'] ?></td>
                                                <td><?= $val['username'] ?></td>
                                                <td nowrap><?= $val['email'] ?></td>
                                                <td><?= $val['roll'] ?></td>
                                                <td nowrap class="text-center">
                                                <button class="btn btn-baru" title="Ubah Kasir" data-toggle="modal" data-target="#myModal<?= $i;?>"><i class="fas fa-edit"></i></button>
                                            
                                                
                                                <?php if ($val['roll'] == 'admin') { ?>
                                                <button class="btn btn-danger" disabled ><i class="fas fa-trash"></i></button>
                                            <?php } else { ?>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#Modal<?= $j;?>"><i class="fas fa-trash"></i></button>
                                            <?php } ?>
                                            </td>
                                            </tr>
                                            <!-- The Modal -->
                                            <div class="modal fade" id="myModal<?= $i;?>">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Ubah Data Kasir</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <form action="kasir.php?ubah=y" method="post">
                                                            <div class="form-group">
                                                            <label for="username">NP</label>
                                                            <input type="text" class="form-control" id="username" value="<?= $val['username'];?>" readonly>
                                                            <input type="hidden" name="idUser" class="form-control" id="idUser" value="<?= $val['idUser'];?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="email" name="email" class="form-control" id="email" value="<?= $val['email'];?>" required >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama_ksr">Nama Kasir</label>
                                                                <input type="text" class="form-control" id="nama_ksr" name="nama" value="<?= $val['nama'];?>" required oninvalid="this.setCustomValidity('Masukan Nama Kasir !')" oninput="this.setCustomValidity('')">
                                                            </div>
                                                            <?php if ($val['roll'] == 'admin') { ?>
                                                            <div class="form-group">
                                                                <label for="passworda">Password</label>
                                                                <input type="password" name="passworda" class="form-control" id="passworda" value="<?= $val['password'];?>" required oninvalid="this.setCustomValidity('Masukan Password !')" oninput="this.setCustomValidity('')">
                                                            </div>
                                                            <?php } ?>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-baru">Ubah</button>
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
                                                              <h4 class="modal-title">Hapus Data Kasir</h4>
                                                          </div>

                                                          <!-- Modal body -->
                                                          <div class="modal-body">
                                                              Apakah anda yakin ingin menghapus data kasir dari daftar? <br> *Kasir tidak bisa lagi mengaksis aplikasi.
                                                          </div>

                                                          <!-- Modal footer -->
                                                          <div class="modal-footer">
                                                              <a href="kasir.php?hapus=y&username=<?= $val['username']; ?>" class="btn btn-baru">Ya</a>
                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
        <!-- The Modal -->
        <div class="modal fade" id="tModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Kasir</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="kasir.php?tambah=y" method="post">
                        <div class="form-group">
                            <label for="username">NP</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Masukan NP" required oninvalid="this.setCustomValidity('Masukan NP kasir !')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukan passoword" required oninvalid="this.setCustomValidity('Masukan password kasir !')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Masukan email" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_ksr">Nama Kasir</label>
                            <input type="text" class="form-control" id="nama_ksr" name="nama" placeholder="Masukan nama kasir" required oninvalid="this.setCustomValidity('Masukan Nama Kasir !')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="roll">Roll</label>
                            <input type="text" name="roll" class="form-control" id="roll" value="kasir" readonly>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-baru">Tambah</button>
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
