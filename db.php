<?php
// db.php
$servername = "localhost"; // Replace with your server details
$username = "root";        // Your MySQL username
$password = "";            // Your MySQL password
$dbname = "newproject";    // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
