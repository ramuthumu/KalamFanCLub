<?php include('templates/header.html') ?>
<tr>
    <td class="contentmain">
        <?php
        
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') 
        {
            echo '<h1>Quotes</h1>';
            echo '<a href="add_quote.php"> <font color="#69663B"><b>Add New Quote</b></font></a>';
            // Attempt to connect to MySQL and print out messages:
if ($dbc = mysqli_connect('localhost', 'web_user', 'webpassword')) {
	//'<p>Successfully connected to MySQL!</p>';
    
     mysqli_select_db($dbc,"fanclub");
     // Define the query:
	$query = 'SELECT * FROM quotes ORDER BY date_entered DESC';
        if ($r = mysqli_query($dbc,$query)) { // Run the query.

	// Retrieve and print every record:
	while ($row = mysqli_fetch_array($r)) {
		print "<p style='font-size:20px;' >{$row['text']}</p>
		<b>{$row['author']}</b><br />
		<a href=\"update_quote.php?id={$row['id']}\"><font color='#69663B'>Edit</font></a>
		<a href=\"delete_quote.php?id={$row['id']}\"><font color='#69663B'>Delete</font></a>
		</p><hr />\n";
	}
}
else { // Query didn't run.
	print '<p style="color: #69663B;">Could not retrieve the data because:<br />' . mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
} // End of query IF.
        }
        }
        
          else  if ($dbc = mysqli_connect('localhost', 'web_user', 'webpassword')) {
	//'<p>Successfully connected to MySQL!</p>';
              echo '<h1>Quotes</h1>';
     mysqli_select_db($dbc,"fanclub");
     // Define the query:
	$query = 'SELECT * FROM quotes ORDER BY date_entered DESC';
	
$r = mysqli_query($dbc,$query);
$t=mysqli_num_rows($r);

if($t==0){

    print'<b>No Quotes </b><br><br>';    
}
else if($t!=0){
    
	// Retrieve and print every record:
	while ($row = mysqli_fetch_array($r)) {
		print "<p style='font-size:15px;'>{$row['text']}</p>
		{$row['author']}<br/><hr/>\n";
	
        }
        }
        
        }
        else { // Query didn't run.
	print '<p style="color: red;">Could not retrieve the data because:<br />' . mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
} // End of query IF.
mysqli_close($dbc); // Close the connection.
?>
<p class="bottomline"></p>
        <p class="textaligncenter"><span style="color:red;">Template design by </span><span style="color:blue;">Six Shooter Media</span>
            <span style="color:red;">&copy; 2011</span></p>
    </td>
    
 
</tr>
<?php include('templates/footer.html') ?>

              
