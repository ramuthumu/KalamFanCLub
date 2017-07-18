
<?php
error_reporting(E_ALL ^ E_NOTICE);
$ram=$_POST['use'];
echo"$ram";

 if ($conn = mysqli_connect('localhost', 'web_user', 'webpassword')) {
	//'<p>Successfully connected to MySQL!</p>';
            mysqli_select_db($conn,"fanclub");
if(isset($_POST['user'])){
    if($_POST['status']){
        if($_POST['status']=='Open'){
            $q5="update users set status='OPEN' where username='$ram'";
            if(mysqli_query($conn,$q5)){
                echo'The account is opened';
            }
        }
    }
    if($_POST['status']=='Locked'){
        $q6="update users set status='LOCKED' where username='$ram'";
            if(mysqli_query($conn,$q6)){
                echo'The account is Locked';
                
            }
    }
    if($_POST['status'] =='Admin'){
        $q7="select admin from users where username='$ram'";
        
        $ad = mysqli_query($conn,$q7);
        while($ad1= mysqli_fetch_assoc($ad)){
            $ad2 = $ad1['admin'];
        }
        if($ad2 == 'Y'){
            $rad="update users set admin='N' where username='$ram'";
            if(mysqli_query($conn,$rad)){
                echo"This user is removed as an admin";
            }
            
        }else{
            $rad="update users set admin='Y' where username='$ram'";
            if(mysqli_query($conn,$rad)){
                echo"This user is now an admin";
            }
        }
    }
    if($_POST['status']=='Delete'){
        $dac="delete from users where username='$ram'";
        if(mysqli_query($conn,$dac)){
            $ddir="../users/$ram"  ;
                                if ($dir = opendir($ddir)) {

    
                            foreach (glob($ddir."/*.*") as $filename) {
                              if (is_file($filename)) {
                                unlink($filename);
    }}
                           rmdir( $ddir);
}
            echo "You have deleted this users account succesfully";
        }
    }
      
 }else{echo'please select a user';}
 
            }
            else{echo'could not connect to database';}
?>