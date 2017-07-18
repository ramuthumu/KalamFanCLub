<html>
    <title>Delete Quote</title>
<body>
<?php include('templates/header.html') ?>



<?php // Script 12.8 - delete_entry.php 
/* This script deletes a blog entry. */
if (isset($_SESSION['username']) && $_SESSION['username'] != '')
{
    

// Connect and select:
$conn = mysqli_connect('localhost', 'web_user', 'webpassword');
mysqli_select_db($conn,'fanclub');
	
if (isset($_GET['id']) && is_numeric($_GET['id']) ) { // Display the entry in a form:
echo'<h1>Delete a Quote </h1>';
	// Define the query:
	$query = "SELECT text, author FROM quotes WHERE ID={$_GET['id']}";
	if ($r = mysqli_query($conn,$query)) { // Run the query.
	
		$row = mysqli_fetch_array($r); // Retrieve the information.

		// Make the form:
		print '<form action="delete_quote.php" method="post">
		<p>Are you sure you want to delete this quote?</p>
		<p>' . $row['text'] . '</br></br>' . $row['author'] . '<br />
		<input type="hidden" name="id" value="' . $_GET['id'] . '" />
		<input type="submit" name="submit" value="Delete this Entry!" /></p>
		</form>';

	} else { // Couldn't get the information.
		print '<p style="color: red;">Could not retrieve the blog entry because:<br />' . mysqli_error($conn) . '.</p><p>The query being run was: ' . $query . '</p>';
	}

} elseif (isset($_POST['id']) && is_numeric($_POST['id'])) { // Handle the form.
	
	// Define the query:
	$query = "DELETE FROM quotes WHERE ID={$_POST['id']} LIMIT 1";
	$r = mysqli_query($conn,$query); // Execute the query.
	
	// Report on the result:
	if (mysqli_affected_rows($conn) == 1) {
		print '<p>The Quote is deleted.</p>';
	} else {
		print '<p style="color: red;">Could not delete the Quote because:<br />' . mysqli_error($conn) . '.</p><p>The query being run was: ' . $query . '</p>';
	}

} else { // No ID received.
	print '<p>No quote is selected.<a href="quotes.php"><font color="#ff0000"> Click here</a></p>';
} // End of main IF.

mysqli_close($conn); // Close the connection.
}
else{
    print'You must be logged<a href="login.php"><font color="fd0101"> Click here</a>';
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
