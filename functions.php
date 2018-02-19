<?php 
session_start();
date_default_timezone_set("Asia/Bangkok");

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

    if( $time_difference < 1 ) { return 'baru saja'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'tahun',
                30 * 24 * 60 * 60       =>  'bulan',
                24 * 60 * 60            =>  'hari',
                60 * 60                 =>  'jam',
                60                      =>  'menit',
                1                       =>  'detik'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return ' ' . $t . ' ' . $str . ( $t > 1 ? '' : '' ) . ' lalu';
        }
    }
}
// end -------------------------------------------

    function tampilStatus($type){

        global $link;

        if($type == 'public'){
            $whereClause ='';
        }else if($type == 'yangDiIkuti'){
             
            if(array_key_exists('id',$_SESSION)){

                $query = "SELECT * FROM `follower` WHERE `follower_id` =".mysqli_real_escape_string($link , $_SESSION['id']);
                $result = mysqli_query($link,$query);

      

                $whereClause = '';

            
                while ($row = mysqli_fetch_assoc($result)) {
                    
                    if($whereClause == ''){
                        $whereClause = ' WHERE '; 
                    }else{
                        $whereClause .= ' OR';
                    
                    }
                    $whereClause .=' `user_id`='.$row['isfollowing_id'];
                }
            };
            
        }else if($type == 'yourPapps'){
             
            if(array_key_exists('id',$_SESSION)){

                $query = "SELECT * FROM `status` WHERE `user_id` =".mysqli_real_escape_string($link , $_SESSION['id']);
                $result = mysqli_query($link,$query);

      

                $whereClause = '';

            
                while ($row = mysqli_fetch_assoc($result)) {
                    
                    if($whereClause == ''){
                        $whereClause = ' WHERE '; 
                    }else{
                        $whereClause .= ' OR';
                    
                    }
                    $whereClause .=' `user_id`='.$_SESSION['id'];
                }
            };
            
        }else if($type == 'search'){
             
            if($_GET['q'] != ''){

                $query = "SELECT * FROM `status` WHERE `status` LIKE  '%".mysqli_real_escape_string($link , $_GET['q'])."%'";


                $result = mysqli_query($link,$query);

                if(mysqli_num_rows($result) > 0){

                    $queryHitungHasil = "SELECT COUNT(`id`) AS jumlah FROM `status` WHERE `status` LIKE  '%".mysqli_real_escape_string($link , $_GET['q'])."%'" ;
                    $hasilHitung = mysqli_query($link,$queryHitungHasil);
                    $jumlahHasil = mysqli_fetch_assoc($hasilHitung);
                    
                    while ($row = mysqli_fetch_assoc($result)){
                        
                        $whereClause = " WHERE `status` LIKE '%".mysqli_real_escape_string($link , $_GET['q'])."%'";
                    }
                    echo "<h3>Search Results</h3><p class='tulisanGray'>".$jumlahHasil['jumlah']." hasil ditemukan untuk '".$_GET['q']."'</p>";

                }  else{
                    echo "<p>Tidak ditemukan hasil untuk '".$_GET['q']."'</p><hr>";
                    $whereClause = " WHERE `status` = 'lkadfjo@%^2ie'";
                }              

                
 
            }else{
                echo "<p>Silahkan masukan kata kunci</p>";
                $whereClause = " WHERE `status` = 'lkadfjo@%^2ie'";
            }
            
        };

        if(!array_key_exists('id',$_SESSION)){
            $whereClause = '';

        }

        $query = 'SELECT * FROM `status`'.$whereClause.' ORDER BY `tanggal` DESC';

        $result = mysqli_query($link,$query);

        if(mysqli_num_rows($result) == 0){
            echo('');
        }else{
        while ($barisanStatus = mysqli_fetch_assoc($result)){
            $userQuery = "SELECT * FROM `users` WHERE `id`='".mysqli_real_escape_string($link,$barisanStatus['user_id'])."'" ;
            $userQueryResult = mysqli_query($link,$userQuery);
            $user = mysqli_fetch_assoc($userQueryResult);
 
            $waktu = get_time_ago(strtotime($barisanStatus['tanggal']));   
            echo "<div class='status hurufSerif'><span style='font-size:110%;' class='hurufSerif'>".$user['username'].'</span><span style="color:lightgray; font-size:90%;" class="hurufSansSerif">&nbsp;'.$waktu.'</span><hr>';
            echo "<p class='hurufSansSerif'>".$barisanStatus['status']."</p><br>";
            if(array_key_exists('id',$_SESSION)){
                $queryCekFollower = "SELECT * FROM `follower` WHERE `follower_id` = ".mysqli_real_escape_string($link , $_SESSION['id'])." AND `isFollowing_id` = ".mysqli_real_escape_string($link,$barisanStatus['user_id']);
                $resultFollower = mysqli_query($link,$queryCekFollower);

                $row = mysqli_fetch_assoc($resultFollower) ;
                 
                    if( mysqli_num_rows($resultFollower) > 0 ){
                        if($barisanStatus['user_id'] == $row['follower_id']){
                            echo "";
                        }else{

                        echo "<a id='linkIkuti' style='cursor:pointer; color:#31B0D5;' class='toggleFollow' data-userId='".$barisanStatus['user_id']."'>Unfollow</a>";
                        }
                
                    }else{
                        if($barisanStatus['user_id'] == $_SESSION['id']){
                            echo "";
                        }else{

                        echo "<a id='linkIkuti' style='cursor:pointer; color:#31B0D5;' class='toggleFollow' data-userId='".$barisanStatus['user_id']."'>Follow</a>";
                        }
                    }
                
           
            }else{        
                echo "<a id='linkIkuti' style='cursor:pointer; color:#31B0D5;' data-toggle='modal' data-target='#myModal'>Follow</a>";
            }

            echo "</div>";
           }
           
        }
    }

    // end ================================================
    function tampilSearch(){
        echo('<form id="searchDiv" class="input-group">
        <input type="hidden" name="page" value="search">
        <input type="text" name="q" class="form-control" placeholder="Search for...">
        <span class="input-group-btn">
          <button class="btn btn-secondary" type="submit">Go!</button>
        </span>
      </form>');
    }

    function tampilKotakPapps(){
        if (array_key_exists('id',$_SESSION)){
            if($_SESSION['id']){
                echo('<div class="form">
                        <div style="float:left;width:100%;" class="form-group">
                            <textarea style="width:100%; height:100px; resize:none;" id="textAreaPostPapps" class="form-control"></textarea>
                        </div>
                        <div style="clear:both;"></div>
                        <div style="text-align:right;">
                            <button class="btn" style="background:#ffc800; color:#839EA0;" type="button" id="btnPostPapps">POST</button>
                        </div>
                    </div>');
            }
        }

    }

   function tampilPostKosong(){
        echo '<div id="postKosongError" class="alert alert-warning postKosong tulisanGray" style="margin-top:10px;" role="alert">
       <div id="pesanKosong"></div>
        </div>';

        echo '<div id="alertSuksesPapps" class="alert alert-success  tulisanGray" style="margin-top:10px;" role="alert">
       <div id="suksesPapps"></div>
        </div>';
   }

   

?>