<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Register</title>
	<style type="text/css" media="screen">
		.error { color: red; }
	</style>
</head>
<body>

<?php
include('templates/header.html'); 
// Report all errors except E_NOTICE   
      error_reporting(E_ALL ^ E_NOTICE);
      
echo "<h1> Register </h1> ";
$dir = '../users/';
$file = $dir . 'users.txt';
$username=$_POST['username'];
$password=md5($_POST['password1']);
$subdir=$_POST['username'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

	$problem = FALSE; 

	
	if (empty($_POST['username'])) {
		$problem = TRUE;
		print '<p class="error">Please enter a username!</p>';
	}

     	
	if (empty($_POST['password1'])) {
		$problem = TRUE;
		print '<p class="error">Please enter a password!</p>';
	}

	if ($_POST['password1'] != $_POST['password2']) {
		$problem = TRUE;
		print '<p class="error">Your password did not match your confirmed password!</p>';
	} 
else{
	
	ini_set('auto_detect_line_endings', 1);

	
	$fp = fopen($file, 'rb');
		
	
	while ( $line = fgetcsv($fp, 200, "\t") ) {

		
		if ( ($line[0] == $_POST['username'])) {
                 
             $problem = TRUE;
		print '<p class="error">username taken please choose an other one</p>';

      }

  }

}

	
	if (!$problem) { 
	
		if (is_writable($file)) { 
			
			
			$data = $_POST['username'] . "\t" . md5(trim($_POST['password1'])) . "\t" . $subdir . PHP_EOL;

			
			file_put_contents($file, $data, FILE_APPEND | LOCK_EX);
			
			mkdir ($dir . $subdir);
			
			
                
                
}}
if(!$problem){
    // Attempt to connect to MySQL and print out messages:
if ($dbc = mysqli_connect('localhost', 'web_user', 'webpassword')) {
	//'<p>Successfully connected to MySQL!</p>';
        mysqli_select_db($dbc,"fanclub");
		// Define the query and Enter the credentials into Database:
		$query = "INSERT INTO users (username, password,user_dir,status, admin) VALUES ('$username','$password','$username','OPEN', 'N')";
		
		// Execute the query:
		if (mysqli_query($dbc, $query)) {
			print '<p>User credentials added to database successfuly..</p>';
		} else {
			print '<p style="color: red;">Could not add the user to the database FANCLUB because:<br />' . mysqli_error($dbc) . '.</p>';
		}
	mysqli_close($dbc); // Close the connection.

} else {
    die("Connection failed: " . mysqli_connect_error());
}
}
                }

			
?>
<form action="register.php" method="post">
	<p>Username: <input type="text" name="username" size="20" /></p>
	<p>Password: <input type="password" name="password1" size="20" /></p>
	<p>Confirm:   <input type="password" name="password2" size="20" /></p>
	<input type="submit" name="submit" value="Register" />
</form>


</body>
</html>
<?php include('templates/footer.html');?>



