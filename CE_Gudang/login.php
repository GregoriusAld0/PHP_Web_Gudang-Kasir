<?php 
    require 'function.php';

    //Auth login admin
    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);

    //Cek data input login di database
        $cekdatabase = mysqli_query($conn, "SELECT * FROM tbl_login where email = '$email' AND password = '$password'");
        $hitung = mysqli_num_rows($cekdatabase);

        if($hitung>0) 
        {
          
            $_SESSION['log'] = true;
            $_SESSION['email'] = $email;
              //Login berhasil  
        } 
        else{
            echo '
            <script>
            Swal.fire({
                icon: "error",
                title: "Login Gagal",
                text: "Email / Password salah!",
                showConfirmButton: false,
                timer: 2000
            })
            </script>
            ';
            
            header("Refresh: 1; url=login.php");
        };
    };

    if(!isset($_SESSION['log']))
    {
      
    } 
    else{
        echo '
                <script>
                Swal.fire({
                    icon: "success",
                    title: "Login Berhasil",
                    text: "Selamat datang Admin",
                    showConfirmButton: false,
                    timer: 2000
                })
                </script>
                ';
              
            header("Refresh: 1; url=index.php");
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
        <title>Login Admin</title>
        <link rel="icon" type="image/x-icon" href="assets/img/logo2.ico">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary-login">
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
                                <div class="text-black">Central Electronic's</div>
                                <div class="text-black">Login Gudang</div>
                            </div>
                            <div class="col-12 kotak">
                               
                                <form action="" method="post">
                                    <div class="form-group form-np">
                                        <input type="text" name="email" class="form-control " placeholder="Masukan Email" required oninvalid="this.setCustomValidity('Masukan Nomor Pekerja !')" oninput="this.setCustomValidity('')">
                                    </div>
                                    <div class="form-group">
                                        <i class="form-group-i fas fa-lock"></i>
                                        <input type="password" name="password" class="form-control" placeholder="Masukan Password" required oninvalid="this.setCustomValidity('Masukan Password !')" oninput="this.setCustomValidity('')">
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
        <style>
        /*body::before {
            font-family: 'Roboto', sans-serif;
            background: url(assets/img/cuba.jpeg) no-repeat center center fixed;
            background-size: cover;
            filter: blur(8px);
            -webkit-filter: blur(8px);
        */
        body::before {
          content: "";
          position: fixed;
          background: url(assets/img/bg-login.jpeg) top right no-repeat;
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
        background-color: rgba(255,255,255,0.7);
        opacity: 1;
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

    .form-group-i{ 
        position: absolute;
        left: 29px;
        margin-top: 12px;
    }
    .form-np:before{
        content: "Email";
        position: absolute;
        left: 20px;
        padding-top: 10px;
        font-weight: bold;
        font-size: 14px;
    }
    .form-group input {
        height: 42px;
        border-radius: 5px;
        border: 1;
        border-color: grey;
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
        
    </body>

    
</html>
