<?php 
session_start();
    $link = mysqli_connect('localhost','root','12345','papps');
    
    if(mysqli_connect_errno()){
       print_r(mysqli_connect_error());
       exit();
    }

    if(array_key_exists('id',$_COOKIE)){
        $_SESSION['id']=$_COOKIE['id'];
    }
 
    if (array_key_exists('logout', $_GET)) {

        if ($_GET['logout'] == md5('logout') ) {
            unset($_SESSION['id']);
            unset($_GET['logout']);
            setcookie('id', '', time() - 60 * 60);
            $_COOKIE['id'] = '';
        }
    }

    


?>