<?php
    include("functions.php");
    include("views/header.php");

    if(array_key_exists('page',$_GET)){
        if(isset($_SESSION['id'])){
            if($_GET['page'] == 'timeline'){
                include('views/timeline.php');

            }else if($_GET['page'] == 'yourpapps'){
                include('views/yourpapps.php');

            }else if($_GET['page'] == 'publicprofiles'){
                include('views/publicprofile.php');
            }else if($_GET['page'] == 'search'){
                include('views/search.php');
            }
        }else{
            include("views/home.php");
        }
    }else{
        include("views/home.php");
    }
    include("views/footer.php");
?>