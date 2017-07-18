<html>
<body>
<?php include('templates/header.html') ?>


        
        <?php
        // Report all errors except E_NOTICE   
           error_reporting(E_ALL ^ E_NOTICE);
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') 
        {
            echo'<h1>Add your Quote</h1>';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	// Connect and select:
	$conn = mysqli_connect('localhost', 'web_user', 'webpassword');
	mysqli_select_db( $conn,'fanclub');
        // Validate the form data:
	$loggedin = FALSE;

        
	if (!empty($_POST['author']) && !empty($_POST['text'])) {
		$author_name = trim(strip_tags($_POST['author']));
		$text = trim(strip_tags($_POST['text']));
 		$favorite = trim(strip_tags($_POST['favorite'])); 
                 
            if(isset($_POST['favorite'])) {$favorite='Y';}
            else{$favorite='N';}    
            }
	 else {
		print '<p style="color: red;">Please submit the required fields.</p>';
		$loggedin = TRUE;
	}
        if (!$loggedin) {

		// Define the query:
		$query = "INSERT into quotes (text,author,favorite,date_entered) VALUES ('$text','$author_name','$favorite', NOW())";
		
		// Execute the query:
		if (@mysqli_query($conn,$query)) {
			echo '<p>Quote is added!</p>';
		} else {
			echo '<p style="color: red;">Could not add Quote because:<br />' . mysqli_error($conn) . '.</p><p>The query being run was: ' . $query . '</p>';
		}
	
	} // No problem!
        
   

	mysqli_close($conn); // Close the connection.
        } // End of form submission IF. 
           
           
    //Display the Form
 echo ' 
        <form method="post" action="add_quote.php">
            <p>Author:<input type="text" name="author" required></p>
            <p>Quote text:</p><textarea name="text" cols="40" rows="5" ></textarea><br/>
            <input class="checkbox" type="checkbox" name="favorite" value="Y"> check to add as favorite<br>
            <input class="submitbtn" type="submit" value="Submit Quote!"/><br>
        </form>'; 
 
     }
       else{
            echo 'You must be logged in. <a href="login.php"><font color="#CECFD1">Click here</a>';
           }
        ?>

<p class="bottomline"></p>
        <p class="textaligncenter"><span style="color:red;">Template design by </span><span style="color:blue;">Six Shooter Media</span>
            <span style="color:red;">&copy; 2011</span></p>
        
   

<?php include('templates/footer.html') ; ?> 
</body>
</html>
