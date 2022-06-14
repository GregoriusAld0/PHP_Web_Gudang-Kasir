<?php 
    //Untuk user belum login
    if(isset($_SESSION['log']))
    {

    }
    else {
        header('location:login.php');
    }

?>