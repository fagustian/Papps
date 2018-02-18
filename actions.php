<?php

    include("functions.php");

    if ($_GET['actions'] == "LoginSignup") {
        $error='';
        if(!$_POST['email']){
            $error .='Silahkan masukan alamat email kamu'; 
        }else if (!$_POST['password']){
            $error .='Silahkan masukan password dulu';
        }else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error .= "Format email tidak dikenal"; 
        }else{
            // pengecekan ketika SignUP
            if($_POST['loginActive'] == '0'){
               
                    
                    if($_POST['username'] == ''){
                        $error .='Silahkan masukan username kamu'; 
                    }else{

                        $query="SELECT * from `users` WHERE `email`='".mysqli_real_escape_string($link,$_POST['email'])."'";
                        $hasil = mysqli_query($link,$query);

                        if(mysqli_num_rows ($hasil)> 0){
                            $error = 'Email sudah ada, silahkan coba dengan Email yang lain';
                        }else{
                            $insertQuery = "INSERT INTO `users` (`username`,`email`,`password`) VALUES 
                            ('".mysqli_real_escape_string($link,$_POST['username'])."',
                            '".mysqli_real_escape_string($link,$_POST['email'])."',
                            '".mysqli_real_escape_string($link,$_POST['password'])."')";
                        
                            if(mysqli_query($link,$insertQuery)){
                            //  pembuatan SESSION
                            $_SESSION['id']=mysqli_insert_id($link);
                            //  ---
                            //  pembuatan cookie
                                if($_POST['stayLogin'] == 1){
                                    setcookie('id', $_SESSION['id'], time() + 60 * 60 * 24 * 365);
                                }// end------
            
            
                                $hashPassword = md5(md5($_SESSION['id'].mysqli_real_escape_string($link,$_POST['password'])));
                                $updatePasswordQuery = "UPDATE `users` SET `password`='".$hashPassword."' WHERE `id`='".$_SESSION['id']."'LIMIT 1";
                                mysqli_query($link,$updatePasswordQuery);
                            }else{
                                $error ="Gagal membuat akun, Coba lagi nanti";
                            }
            
                            
            
                            echo('login');
                            
                        }

                    }

                
            //END ---------------------------------------- 
            // pengecekan ketika LogIn
            }else{
                
                $query="SELECT * from `users` WHERE `email`='".mysqli_real_escape_string($link,$_POST['email'])."'";
                $hasil = mysqli_query($link,$query);

                $row = mysqli_fetch_assoc($hasil);
                $hashPassword = md5(md5($row['id'].mysqli_real_escape_string($link,$_POST['password'])));
                if($row['password']== $hashPassword){
                    echo('login');
                    $_SESSION['id']=$row['id'];
                    //  pembuatan cookie
                    if($_POST['stayLogin'] == 1){
                        setcookie('id', $_SESSION['id'], time() + 60 * 60 * 24 * 365);
                    }// end------
                }else{
                    $error ="Akun tidak ditemukan <p>Silahkan periksa email & password kamu</p>";
                }
            }//end ----------------------------------------
        }
  
        if($error != ''){
            echo $error;
            exit();
        };
    };

    

    if($_GET['actions'] == 'toggleFollow'){
    
        $query = "SELECT * FROM `follower` WHERE `follower_id` =".mysqli_real_escape_string($link , $_SESSION['id'])." AND `isfollowing_id`=".mysqli_real_escape_string($link , $_POST['userId']);
        $result = mysqli_query($link,$query);
       
        if(mysqli_num_rows(mysqli_query($link,$query)) > 0){
            $row = mysqli_fetch_assoc($result);
            $queryUnFollow = 'DELETE FROM `follower` WHERE  `id` ='.mysqli_real_escape_string($link,$row['id']).' LIMIT 1';
            mysqli_query($link,$queryUnFollow);
            echo '1';
        }else{
            $queryFollow = 'INSERT INTO `follower` (`follower_id`,`isFollowing_id`) VALUES ('.mysqli_real_escape_string($link,$_SESSION['id']).','.mysqli_real_escape_string($link,$_POST['userId']).')';
            mysqli_query($link,$queryFollow);
            echo '2';
        }
        
    };

    if($_GET['actions'] == 'postPapps'){
        if(empty(ltrim($_POST['postingan']))){
            echo '0';
        }else if(strlen($_POST['postingan']) > 145){
            echo '1';
        }else{
             $queryPosting = "INSERT INTO `status` (`status`,
                `user_id`,
                `tanggal`) VALUES 
                ('".mysqli_real_escape_string($link,$_POST['postingan'])."',".mysqli_real_escape_string($link,$_SESSION['id']).
                ",now())";

            mysqli_query($link,$queryPosting);
           
            echo '2';

        }
    };

?>