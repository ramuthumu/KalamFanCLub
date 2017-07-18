<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Upload a File</title>
<?php include('templates/header.html');?>
</head>
<body>


<?php

if ($_SESSION['logged_in'] == 0){
         header('Location:login.php');
         }        
?>
<?php 


if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
	$dir = "../users/";
        $username = $_SESSION['username'];
	if (move_uploaded_file ($_FILES['the_file']['tmp_name'], "$dir$username/{$_FILES['the_file']['name']}")) {
	
		print '<p>Your file has been uploaded.</p>';
	
	} else { 

		print '<p style="color: red;">Your file could not be uploaded because: ';
		
		
		switch ($_FILES['the_file']['error']) {
			case 1:
				print 'The file exceeds the upload_max_filesize setting in php.ini';
				break;
			case 2:
				print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form';
				break;
			case 3:
				print 'The file was only partially uploaded';
				break;
			case 4:
				print 'No file was uploaded';
				break;
			case 6:
				print 'The temporary folder does not exist.';
				break;
			default:
				print 'Something unforeseen happened.';
				break;
		}
		
		print '.</p>'; 

	} 
	
} 
?>

<form action="upload.php" enctype="multipart/form-data" method="post">
	<b>Upload a file using this form:</b>
	<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
	<p><input type="file" name="the_file" /></p>
	<p><input type="submit" name="submit" value="Upload This File" /></p>
</form>

</body>
</html>
<?php include('templates/footer.html');
