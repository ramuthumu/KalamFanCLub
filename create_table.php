<?php
$servername = "localhost";
$username = "web_user";
$password = "webpassword";
$dbname = "fanclub";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql1 = "CREATE TABLE users (
 
username VARCHAR(100) NOT NULL,
password VARCHAR(100) NOT NULL,
user_dir VARCHAR(100),
status VARCHAR(100),
admin CHAR(1)

)";

if (mysqli_query($conn, $sql1)) {
    echo "Table users created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

$sql2 = "CREATE TABLE quotes(
    ID int NOT NULL AUTO_INCREMENT,
text VARCHAR(4000), 
author VARCHAR(200), 
favorite CHAR(1), 
date_entered datetime,
PRIMARY KEY (ID)
)";

if (mysqli_query($conn, $sql2)) {
    echo "Table quotes created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
