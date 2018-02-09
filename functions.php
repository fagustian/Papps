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
// fuction ngitung waktu status -----------------
function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}
// end -------------------------------------------





    function tampilStatus($type){

        global $link;

        if($type == 'public'){
            $whereClause ='';
        }
        $query = 'SELECT * FROM `status`'.$whereClause.'ORDER BY `tanggal` DESC';
        $result = mysqli_query($link,$query);

        if(mysqli_num_rows($result) == 0){
            echo('teu aya status kanggo ditampilkeun');
        }else{
           while ($barisanStatus = mysqli_fetch_assoc($result)){
            $userQuery = "SELECT * FROM `users` WHERE `id`='".mysqli_real_escape_string($link,$barisanStatus['user_id'])."'" ;
            $userQueryResult = mysqli_query($link,$userQuery);
            $user = mysqli_fetch_assoc($userQueryResult);

           
           

        //  echo get_time_ago(strtotime($barisanStatus['tanggal'])); 
        echo get_time_ago(strtotime($barisanStatus['tanggal']));          
            echo "<p>".$barisanStatus['status']."</p><br>";
           }
           
        }
    }


?>