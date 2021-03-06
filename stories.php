<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Directory Contents</title>
</head>
<body>
<<?php 

include('templates/header.html');
?>
<?php

if ($_SESSION['logged_in'] == 0) {
         header('Location:login.php');
         }        
?>

<?php 
date_default_timezone_set('America/Chicago');

$dir = "../users/";
$search_dir = $dir.$_SESSION['username'];
$contents = scandir($search_dir);

print '<hr /><h2>Files</h2>
<table cellpadding="2" cellspacing="2" align="left">
<tr>
<td>Name</td>
<td>Size</td>
<td>Last Modified</td>
</tr>';


foreach ($contents as $item) {
	if ( (is_file($search_dir . '/' . $item)) AND (substr($item, 0, 1) != '.') ) {
	
		
		$fs = filesize($search_dir . '/' . $item);

		
		$lm = date('F j, Y', filemtime($search_dir . '/' . $item));

		print "<tr>
		<td>$item</td>
		<td>$fs bytes</td>
		<td>$lm</td>
		</tr>\n";
	
	} 

} 

print '</table>'; 

?>
</body>
</html>
<?php 

include('templates/footer.html');
?>
