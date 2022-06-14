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
        <title>Kelola Admin</title>
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
                        <h1 class="mt-4">Kelola Admin</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Kelola data admin</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus    "></i>
                                    Tambah Admin
                                    </button>
                                    <!--TAMBAH Admin Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <!-- Modal head -->
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                            <!-- Modal body -->
                                        <form method="post">
                                        <div class="modal-body">
                                        <h5 class="font-weight-normal">Email</h5>
                                            <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
                                            <h5 class="font-weight-normal">Password</h5>
                                            <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
                                          
                                            <button type="submit" class="btn btn-success float-right" name="addadmin">Submit</button>
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
                                                <th>No.</th>
                                                <th>Email Admin</th>
                                                <th style="width: 8%;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php 
                                                $ambildata_admin = mysqli_query($conn, "SELECT * FROM tbl_login");
                                                while($data = mysqli_fetch_array($ambildata_admin))
                                                {
                                                    $email_admin = $data['email'];
                                                    $pass_admin = $data['password'];
                                                    $id_admin = $data['id_user'];
                                                 
                                            ?>

                                            <tr class="text-nowrap">
                                                <td><?= $no++; ?></td>
                                                <td><?= $email_admin; ?></td>
                                                <td>
                                                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#edit<?=$id_admin;?>"><i class="fas fa-edit"></i>
                                                    
                                                </button>
                                                &nbsp;
                                                <?php 
                                                    if($id_admin == 1){
                                                ?>
                                                <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#delete<?= $id_admin;?>" disabled><i class="fas fa-trash"></i>
                                                    
                                                </button>
                                                <?php 
                                                    } else {
 
                                                ?>
                                                <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#delete<?= $id_admin;?>"><i class="fas fa-trash"></i>
                                                    
                                                </button>
                                                <?php 
                                                    }
                                                ?>
                                                </td>
                                            </tr>
                                                <!--Edit Modal -->
                                                <div class="modal fade" id="edit<?=$id_admin;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <h5 class="font-weight-normal">Email Admin</h5>
                                                        <input type="email" name="emailadmin" value="<?=$email_admin;?>" class="form-control mb-2" placeholder="Email" required>
                                                        <h5 class="font-weight-normal">New Password</h5>
                                                        <input type="password" name="passwordbaru" value="<?=$pass_admin;?>" class="form-control mb-2" placeholder="Password">

                                                        <input type="hidden" name="id" value="<?= $id_admin; ?>">
                                                        <button type="submit" class="btn btn-success float-right mt-2" name="updateadmin">Submit</button>
                                                        <button type="button" class="btn btn-secondary float-right mt-2 mr-3 mb-2" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </form>
                                                
                                                    </div>
                                                </div>
                                                </div>

                                                 <!--Delete Modal -->
                                                 <div class="modal fade" id="delete<?=$id_admin?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <!-- Modal head -->
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Admin</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                        <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus <strong><?=$email_admin;?></strong>?
                                                        <input type="hidden" name="id" value="<?= $id_admin; ?>">
                                                        <br>
                                                        <button type="submit" class="btn btn-danger float-right mt-3" name="deleteadmin">Hapus</button>
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
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
