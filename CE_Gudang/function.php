<html>
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    </head>
</html>

<?php 
    session_start();
    //Koneksi ke database
    $conn =  mysqli_connect("localhost", "root", "", "merbabu1_CE");



    //Tambah data produk
    if(isset($_POST['addnewproduk']))
    {
        $kodeproduk = $_POST['kodeproduk'];
        $namaproduk = $_POST['namaproduk'];
        $deskripsi = $_POST['deskripsi'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];

        //Validasi nama produk
        $cek = mysqli_query($conn, "SELECT * FROM produk WHERE nama_produk='$namaproduk' OR kode_produk='$kodeproduk'");
        $hitung_data = mysqli_num_rows($cek);
        

        if($hitung_data < 1) 
        {
              //Nama produk tidak ada
              $addtotable = mysqli_query($conn, "INSERT into produk (kode_produk, nama_produk, deskripsi, stok, harga) values('$kodeproduk','$namaproduk', '$deskripsi', '$stok','$harga')");

              //Memasukkan data baru ke halaman produk masuk
              $ambilsemuadata = mysqli_query($conn, "SELECT MAX(id_produk) AS contohid FROM produk");
              $fetcharray = mysqli_fetch_array($ambilsemuadata);
              $idproduks = $fetcharray['contohid'];
              $idproduks_total = $idproduks;
              $addtoprodukmasuk = mysqli_query($conn, "INSERT into tbl_masuk (id_produk, keterangan, kuantitas) values('$idproduks_total','$deskripsi','$stok')");

              if($addtotable && $addtoprodukmasuk)
              {
                echo '
                <script>
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: "Produk berhasil ditambahkan!",
                    timer: 2000
                  })
                </script>
                ';
                  
                header("Refresh: 1; url=index.php");
              }
              else {
                  echo 'Gagal';
                  header('location:index.php');
              }

        } else {
            echo '
            <script>
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: "Nama / Kode produk sudah terdaftar!",
                timer: 2000
              })
            </script>
            ';

            header("Refresh: 1; url=index.php"); 
        }

        
    }

    //Tambah produk masuk
    if(isset($_POST['produkmasuk']))
    {
        $produknya = $_POST['produknya'];
        $keterangan = $_POST['keterangan'];
        $kuantitas = $_POST['kuantitas'];

        $cekstok_sekarang= mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$produknya'");
        $ambildatanya = mysqli_fetch_array($cekstok_sekarang);

        $stoksekarang = $ambildatanya['stok'];
        //tambah stok sekarang dengan kuantitas
        $tambahstok_sekarang = $stoksekarang + $kuantitas;

        $addtomasuk = mysqli_query($conn, "INSERT into tbl_masuk (id_produk, keterangan, kuantitas) values('$produknya','$keterangan','$kuantitas')");
        $update_stokmasuk = mysqli_query($conn, "UPDATE produk SET stok = '$tambahstok_sekarang' WHERE id_produk = '$produknya'");
        if($addtomasuk && $update_stokmasuk)
        {
            echo '
            <script>
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "Produk Masuk berhasil ditambahkan!",
                timer: 2000
              })
            </script>
            ';
              
            header("Refresh: 1; url=produk_masuk.php");
        }
        else {
            echo 'Gagal';
            header('location:produk_masuk.php');
        }

    }


    //Tambah produk keluar
    if(isset($_POST['produkkeluar']))
    {
        $produknya = $_POST['produknya'];
        $penerima = $_POST['penerima'];
        $kuantitas = $_POST['kuantitas'];

        $cekstok_sekarang= mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$produknya'");
        $ambildatanya = mysqli_fetch_array($cekstok_sekarang);

        $stoksekarang = $ambildatanya['stok'];

        if($stoksekarang >= $kuantitas)
        {
            //Kurang stok sekarang dengan kuantitas
            $kurangstok_sekarang = $stoksekarang - $kuantitas;

            $addtokeluar = mysqli_query($conn, "INSERT into tbl_keluar (id_produk, penerima, kuantitas) values('$produknya','$penerima','$kuantitas')");
            $update_stokkeluar = mysqli_query($conn, "UPDATE produk SET stok = '$kurangstok_sekarang' WHERE id_produk = '$produknya'");
            if($addtokeluar && $update_stokkeluar)
            {
                echo '
                <script>
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: "Produk Keluar berhasil ditambahkan!",
                    timer: 2000
                  })
                </script>
                ';
                  
                header("Refresh: 1; url=produk_keluar.php");
            }
            else {
                echo 'Gagal';
                header('location:produk_keluar.php');
            }
        } else {
            echo '
            <script>
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: "Stok tidak mencukupi untuk proses!",
                timer: 2000
              })
            </script>
            ';
        }

    }


    //Edit Produk
    if(isset($_POST['updateproduk']))
    {
        $idproduk = $_POST['idproduk'];
        $namaproduk = $_POST['namaproduk'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];

        $update = mysqli_query($conn, "UPDATE produk SET nama_produk = '$namaproduk', stok = '$stok', harga = '$harga', deskripsi = '$deskripsi' WHERE id_produk = '$idproduk'");
        if($update)
        {
            echo '
                <script>
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: "Produk berhasil diperbaharui!",
                    timer: 2000
                  })
                </script>
                ';
                  
                header("Refresh: 1; url=index.php");
        }
        else {
            echo 'Gagal';
            header('location:index.php');
        }
    }

    //Delete Produk
    if(isset($_POST['deleteproduk']))
    {
        $idproduk = $_POST['idproduk'];

        $delete = mysqli_query($conn, "DELETE FROM produk WHERE id_produk = '$idproduk'");
        $delete2 = mysqli_query($conn, "DELETE FROM tbl_masuk WHERE id_produk = '$idproduk'");
        if($delete && $delete2)
        {
            echo '
            <script>
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "Produk berhasil dihapus!",
                timer: 2000
              })
            </script>
            ';
              
            header("Refresh: 1; url=index.php");
        }
        else {
            echo 'Gagal';
            header('location:index.php');
        }
    }


    //Edit data produk masuk
    if(isset($_POST['updateprodukmasuk']))
    {
        $idproduk = $_POST['idproduk'];
        $idmasuk = $_POST['idmasuk'];
        $deskripsi = $_POST['keterangan'];
        $kuantitas = $_POST['kuantitas'];

        $lihat_stok = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$idproduk'");
        $stoknya = mysqli_fetch_array($lihat_stok);
        $stok_sekarang = $stoknya['stok'];

        $kuantitas_sekarang = mysqli_query($conn, "SELECT * FROM tbl_masuk WHERE id_masuk='$idmasuk'");
        $kuantitasnya = mysqli_fetch_array($kuantitas_sekarang);
        $kuantitas_sekarang = $kuantitasnya['kuantitas'];

        if($kuantitas>$kuantitas_sekarang)
        {
            $selisih = $kuantitas - $kuantitas_sekarang;
            $kurang = $stok_sekarang + $selisih; 
            $kurangstok = mysqli_query($conn, "UPDATE produk set stok='$kurang' WHERE id_produk='$idproduk'");

            $update = mysqli_query($conn, "UPDATE tbl_masuk SET kuantitas='$kuantitas', keterangan='$deskripsi' WHERE id_masuk='$idmasuk'");
                if($kurangstok && $update)
                {
                    echo '
                    <script>
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Produk Masuk berhasil diperbaharui!",
                        timer: 2000
                      })
                    </script>
                    ';
                      
                    header("Refresh: 1; url=produk_masuk.php");
                }
                else {
                    echo 'Gagal';
                    header('location:produk_masuk.php');
                }
                
        } else {
            $selisih = $kuantitas_sekarang - $kuantitas;
            $kurang = $stok_sekarang - $selisih; 
            $kurangstok = mysqli_query($conn, "UPDATE produk set stok='$kurang' WHERE id_produk='$idproduk'");

            $update = mysqli_query($conn, "UPDATE tbl_masuk SET kuantitas='$kuantitas', keterangan='$deskripsi' WHERE id_masuk='$idmasuk'");
                if($kurangstok && $update)
                {
                    echo '
                    <script>
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Produk Masuk berhasil diperbaharui!",
                        timer: 2000
                      })
                    </script>
                    ';
                      
                    header("Refresh: 1; url=produk_masuk.php");
                }
                else {
                    echo 'Gagal';
                    header('location:produk_masuk.php');
                }
        }
    }


    //Delete produk masuk
    if(isset($_POST['deleteprodukmasuk']))
    {
        $idproduk = $_POST['idproduk'];
        $kuantitas = $_POST['qty'];
        $idmasuk = $_POST['idmasuk'];

        $getdatastok = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$idproduk'");
        $data = mysqli_fetch_array($getdatastok);
        $stok = $data['stok'];

        $selisih = $stok - $kuantitas;

        $update = mysqli_query($conn, "UPDATE produk SET stok='$selisih' WHERE id_produk='$idproduk'");
        $hapusdata = mysqli_query($conn, "DELETE FROM tbl_masuk WHERE id_masuk='$idmasuk'");

        if($update && $hapusdata)
        {
            echo '
            <script>
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "Produk Masuk berhasil dihapus!",
                timer: 2000
              })
            </script>
            ';
              
            header("Refresh: 1; url=produk_masuk.php");
        } else {
            header('location:produk_masuk.php');
        }
        
    }


    //Edit data produk keluar
    if(isset($_POST['updateprodukkeluar']))
    {
        $idproduk = $_POST['idproduk'];
        $idkeluar = $_POST['idkeluar'];
        $penerima = $_POST['penerima'];
        $kuantitas = $_POST['kuantitas'];

        $lihat_stok = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$idproduk'");
        $stoknya = mysqli_fetch_array($lihat_stok);
        $stok_sekarang = $stoknya['stok'];
     
        $kuantitas_sekarang = mysqli_query($conn, "SELECT * FROM tbl_keluar WHERE id_keluar='$idkeluar'");
        $kuantitasnya = mysqli_fetch_array($kuantitas_sekarang);
        $kuantitas_sekarang = $kuantitasnya['kuantitas'];
 
        if($kuantitas>$kuantitas_sekarang)
        {
            $selisih = $kuantitas - $kuantitas_sekarang;
            $kurang = $stok_sekarang - $selisih; 

            if($selisih <= $stok_sekarang)
            {
                $kurangstok = mysqli_query($conn, "UPDATE produk set stok='$kurang' WHERE id_produk='$idproduk'");

                $update = mysqli_query($conn, "UPDATE tbl_keluar SET kuantitas='$kuantitas', penerima='$penerima' WHERE id_keluar='$idkeluar'");
                    if($kurangstok && $update)
                    {
                        echo '
                        <script>
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: "Produk Keluar berhasil diperbaharui!",
                            timer: 2000
                          })
                        </script>
                        ';
                          
                        header("Refresh: 1; url=produk_keluar.php");
                    }
                    else {
                        echo 'Gagal';
                        header('location:produk_keluar.php');
                    }
                    
            } else {
                echo '
                <script>
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Stok tidak mencukupi!",
                    timer: 2000
                  })
                </script>
                ';

                header("Refresh: 1; url=produk_keluar.php");
            }

           
        } else {
            $selisih = $kuantitas_sekarang - $kuantitas;
            $kurang = $stok_sekarang + $selisih; 
            $kurangstok = mysqli_query($conn, "UPDATE produk set stok='$kurang' WHERE id_produk='$idproduk'");

            $update = mysqli_query($conn, "UPDATE tbl_keluar SET kuantitas='$kuantitas', penerima='$penerima' WHERE id_keluar='$idkeluar'");
                if($kurangstok && $update)
                {
                    echo '
                        <script>
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: "Produk Keluar berhasil diperbaharui!",
                            timer: 2000
                          })
                        </script>
                        ';
                          
                        header("Refresh: 1; url=produk_keluar.php");
                }
                else {
                    echo 'Gagal';
                    header('location:produk_keluar.php');
                }
        }
   
    }


    //Delete produk keluar
    if(isset($_POST['deleteprodukkeluar']))
    {
        $idproduk = $_POST['idproduk'];
        $kuantitas = $_POST['qty'];
        $idkeluar = $_POST['idkeluar'];

        $getdatastok = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$idproduk'");
        $data = mysqli_fetch_array($getdatastok);
        $stok = $data['stok'];

        $selisih = $stok + $kuantitas;

        $update = mysqli_query($conn, "UPDATE produk SET stok='$selisih' WHERE id_produk='$idproduk'");
        $hapusdata = mysqli_query($conn, "DELETE FROM tbl_keluar WHERE id_keluar='$idkeluar'");

        if($update && $hapusdata)
        {
            echo '
            <script>
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "Produk Keluar berhasil dihapus!",
                timer: 2000
              })
            </script>
            ';
              
            header("Refresh: 1; url=produk_keluar.php");
        } else {
            header('location:produk_keluar.php');
        }
        
    }


    //Tambah Admin baru
    if(isset($_POST['addadmin']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query_insert = mysqli_query($conn, "INSERT INTO tbl_login (email, password) values('$email', '$password')");
        
        if($query_insert) 
        {
            echo '
            <script>
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "Admin berhasil ditambah!",
                timer: 2000
              })
            </script>
            ';
              
            header("Refresh: 1; url=kelola_admin.php");

        } else {
            header('location:kelola_admin.php');
        }
    }

    //Edit Data Admin
    if(isset($_POST['updateadmin']))
    {
        $email = $_POST['emailadmin'];
        $password_baru = $_POST['passwordbaru'];
        $id_admin = $_POST['id'];

        $query_update = mysqli_query($conn, "UPDATE tbl_login SET email='$email', password='$password_baru' WHERE id_user = '$id_admin'");

        if($query_update)
        {
            echo '
            <script>
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "Admin berhasil diperbaharui!",
                timer: 2000
              })
            </script>
            ';
              
            header("Refresh: 1; url=kelola_admin.php");
        } else {
            header('location:kelola_admin.php');
        }
    }

    //Hapus Admin
    if(isset($_POST['deleteadmin']))
    {
        $id = $_POST['id'];

        $query_delete = mysqli_query($conn, "DELETE FROM tbl_login WHERE id_user='$id'");

        if($query_delete)
        {
            echo '
            <script>
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "Admin berhasil dihapus!",
                timer: 2000
              })
            </script>
            ';
              
            header("Refresh: 1; url=kelola_admin.php");
        } else {
            header('location:kelola_admin.php');
        }

    }


?>

