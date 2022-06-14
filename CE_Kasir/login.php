<?php  
require_once "functions.php";

if(isset($_SESSION['user'])){
    header("Location: index.php");
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
    <title>Login | Central Electronic's</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/logo2.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        /*body::before {
            font-family: 'Roboto', sans-serif;
            background: url(assets/img/cuba.jpeg) no-repeat center center fixed;
            background-size: cover;
            filter: blur(8px);
            -webkit-filter: blur(8px);
        }*/
        body::before {
          content: "";
          position: fixed;
          background: url(assets/img/cuba.jpeg) top right no-repeat;
          background-size: cover;
          left: 0;
          right: 0;
          top: 0;
          height: 100vh;
          z-index: -1;
          filter: blur(8px);
      }
      @media (min-width: 1024px) {
          body::before {
            background-attachment: fixed;
        }
    }

      .kolom-kotak {
        margin: 0 auto;
        margin-top: 130px;
        padding: 0;
    }
    .modal-content {
        background-color: rgba(0,0,0,1);
        opacity: .8;
        padding: 0 18px;
        border-radius: 10px;
    }
    .logo img {
        height: 120px;
        width: 120px;
    }
    .logo {
        margin-top: -60px;
        margin-bottom: 8px;
    }
    .judul {
        letter-spacing: 1px;
        font-size: 28px;
        margin-bottom: 15px;
    }
    .form-group {
        margin-bottom: 25px;
    }
    .form-group i {
        position: absolute;
        left: 28px;
        padding-top: 10px;
    }
    .form-np:before{
        content: "NP";
        position: absolute;
        left: 28px;
        padding-top: 10px;
        font-weight: bold;
        font-size: 14px;
    }
    .form-group input {
        height: 42px;
        border-radius: 5px;
        border: 0;
        font-size: 16px;
        letter-spacing: 2px;
        padding-left: 54px;
    }
    .kotak button {
        width: 40%;
        margin: 5px 0 25px;
    }
    .btn-primary {
        background-color: #41658A;
        font-size: 19px;
        border-radius: 5px;
        padding: 7px 14px;
        border: 1px solid #49729C;
    }
    .btn-primary:hover {
        background-color: #355270;
        border: 1px solid #49729C;
    }
    .teks-alert{
        font-size: 14px;
    }
</style>
</style>
</head>
<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="modal-dialog text-center">
                    <div class="col-sm-9 kolom-kotak">
                        <div class="modal-content">
                            <div class="col-12 logo">
                                <img src="assets/img/logo2.png" alt="Logo CE">
                            </div>
                            <div class="col-12 judul">
                                <div class="text-white">Central Electronic's</div>
                                <div class="text-white">Login Kasir</div>
                            </div>
                            <div class="col-12 kotak">
                                <?php if(isset($_POST['login'])){
                                    $user = $_POST['user'];
                                    $pass = md5($_POST['pass']);

                                    if(check_login($user,$pass) == true) {
                                        $baca = baca_user($user);
                                        $_SESSION['roll'] = $baca['roll'];
                                        $_SESSION['nama'] = $baca['nama'];
                                        $_SESSION['user'] = $user;
                                        header("Location:index.php");
                                    }else if (check_id($user) == true){?>
                                        <div class="alert alert-danger alert-dismissible fade show p-2 mb-4 text-nowrap text-left">
                                            <button type="button" class="close p-1 text-right" data-dismiss="alert">&times;</button>
                                            <span class="teks-alert"><strong>Password Salah!</strong></span>
                                        </div>
                                    <?php }else {?>
                                        <div class="alert alert-danger alert-dismissible fade show p-2 mb-4 text-nowrap text-left">
                                            <button type="button" class="close p-1 text-right" data-dismiss="alert">&times;</button>
                                            <span class="teks-alert"><strong>NP tidak terdaftar!</strong></span>
                                        </div>
                                    <?php }
                                }?>
                                <form action="" method="post">
                                    <div class="form-group form-np">
                                        <input type="text" name="user" class="form-control " placeholder="Masukan Nomor Pekerja" required oninvalid="this.setCustomValidity('Masukan Nomor Pekerja !')" oninput="this.setCustomValidity('')">
                                    </div>
                                    <div class="form-group">
                                        <i class="bi bi-lock-fill"></i>
                                        <input type="password" name="pass" class="form-control" placeholder="Masukan Password" required oninvalid="this.setCustomValidity('Masukan Password !')" oninput="this.setCustomValidity('')">
                                    </div>
                                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
