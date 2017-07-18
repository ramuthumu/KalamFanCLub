
<?php

define('TITLE', 'Welcome to the Ramu Thumu Fan Club!');
include('templates/header.html'); 


?>

<!DOCTYPE html>
<head>
<title>Form submission</title>
</head>
<body>
 <style>
 p {
 
 width: 200px;
}

 p input {
 float:right;
 
}
<?php session_start();?>
<?php

if (!isset($_SESSION['username']) && $_SESSION['username'] != '') {
         header('Location:login.php');
         }        
?>
</style>
<h><b><font size="5"> Email Form</font> </b> </h>
<form action="phpmailer.php" method="post">
<p> My Email: <input type="text" name="email"><br> </p>
<p> Subject: <input type="text" name="subject"><br></p>
Message:<br><textarea rows="5" name="message" cols="30"></textarea><br>
<input type="submit" name="submit" value="Submit">
</form>

</body>
</html>

?>
<?php include('templates/footer.html');
 
