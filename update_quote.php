<html>
    <title>Edit quote</title>
<body>
<?php include('templates/header.html') ?>



<?php // Script 12.9 - edit_entry.php 
/* This script edits a blog entry using an UPDATE query. */
if (isset($_SESSION['username']) && $_SESSION['username'] != '')
{
    
// Connect and select:
$conn = mysqli_connect('localhost', 'web_user', 'webpassword');
mysqli_select_db($conn,'fanclub');

if (isset($_GET['id']) && is_numeric($_GET['id']) ) { // Display the entry in a form:
echo'<h1>Edit Quote</h1>';
	// Define the query.
	$query = "SELECT author,text FROM quotes WHERE id={$_GET['id']}";
	if ($r = mysqli_query($conn,$query)) { // Run the query.
	
		$row = mysqli_fetch_array($r); // Retrieve the information.
		
		// Make the form:
                
		echo ' <form method="post" action="update_quote.php">
            <p>
                Author: <input type="text" name="author" size="40" maxsize="100" value="' . htmlentities($row['author']) . '" />
            </p>
            
            <p>
                Quote text:
            
            <textarea name="text" cols="40" rows="5">' . htmlentities($row['text']) . '</textarea>
            </p><br/>
	    <input type="hidden" name="id" value="' . $_GET['id'] . '" />
            <input class="submitbtn" type="submit" value="Update this Quote!"/>
        </form>';
		

	} else { // Couldn't get the information.
		print '<p style="color: red;">Could not retrieve the blog entry because:<br />' . mysqli_error($conn) . '.</p><p>The query being run was: ' . $query . '</p>';
	}

} elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {   // Handle the form.
     

	// Validate and secure the form data:
	$problem = FALSE;
	if (!empty($_POST['author']) && !empty($_POST['text'])) {
		$author = mysqli_real_escape_string($conn,trim(strip_tags($_POST['author'])) );
		$text = mysqli_real_escape_string($conn,trim(strip_tags($_POST['text'])) );
	} else {
		print '<p style="color: red;">Please submit both a text and an author.</p>';
		$problem = TRUE;
	}

	if (!$problem) {

		// Define the query.
		$query = "UPDATE quotes SET author='$author', text='$text' WHERE id={$_POST['id']}";
		$r = mysqli_query($conn,$query ); // Execute the query.
		
		// Report on the result:
		if (mysqli_affected_rows($conn) == 1) {
			print '<p>The Quote is updated.</p>';
		} else {
			print '<p style="color: red;">Could not update the Quote because:<br />' . mysqli_error($conn) . '.</p><p>The query being run was: ' . $query . '</p>';
		}
		
	} // No problem!
} else { // No ID set.
	print '<p>No quote is selected.<a href="quotes.php"><font color="#D2DDFB"> Click here</a></p>';
} // End of main IF.

mysqli_close($conn); // Close the connection.
}
else{
    print'You must be logged in <a href="login.php"><font color="fd0101"> Click here</a>';
}
?>
<p class="bottomline"></p>
        <p class="textaligncenter"><span style="color:red;">Template design by </span><span style="color:blue;">Six Shooter Media</span>
            <span style="color:red;">&copy; 2011</span></p>
    

<?php
include('templates/footer.html');
?>
</body>
</html>
