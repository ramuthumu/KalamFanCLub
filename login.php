<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Login</title>
</head>
<body>

<?php 
if (isset($_SESSION['username']) && $_SESSION['username'] != '')
 define('TITLE', 'Login');
 include('templates/header.html');
 // Report all errors except E_NOTICE   
      error_reporting(E_ALL ^ E_NOTICE);
echo"<h1>Login</h1>";



$username=$_POST['username'];
$password=  md5($_POST['password']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

	
        
    $loggedin = false; 
     $stat= false;
	
	 // Attempt to connect to MySQL and print out messages:
if ($dbc = mysqli_connect('localhost', 'web_user', 'webpassword')) {
	//'<p>Successfully connected to MySQL!</p>';
        mysqli_select_db($dbc,"fanclub");
		// Define the query:
		$query = "select username,password from users where username='$username' and password='$password'";	
		// Execute the query:           
                	
               // print "select username,password from users where username='$username' and password='$m_password'";
                $result = mysqli_query($dbc,$query);
                $row = mysqli_fetch_array($result);
               $s1 = "select status from users where username='$username'";
               $s2 = mysqli_query($dbc,$s1);
               $s3= mysqli_fetch_array($s2);
             
               
                if ($row){
                    $loggedin=true;
                    
                }
                if($s3['status']=='OPEN'){
                    $stat=true;
                }

	mysqli_close($dbc); // Close the connection.

} else {
    die("Connection failed: " . mysqli_connect_error());
}
	if ($loggedin && $stat) {
		session_start();
                $username = $_POST['username'];
$_SESSION['username'] = $username;
$_SESSION['logged_in'] = time();
 header('Location:index.php');
 exit();

        }
        
        
        if(!$loggedin){
            echo'Username and password do not match please try again';
        }
        if($loggedin && !$stat){
            echo'Your account is locked please contact the administrator';
        }
} else { 
?>

<form action="login.php" method="post">
	<p>Username: <input type="text" name="username" size="20" /></p>
	<p>Password: <input type="password" name="password" size="20" /></p>
	<input type="submit" name="submit" value="Login" />
</form>

<?php }  ?>

</body>
</html>

<?php include('templates/footer.html'); ?>
