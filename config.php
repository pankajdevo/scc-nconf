<?php
// Database configuration
$servername = "localhost";  // Replace with your server details
$username = "root";         // Database username
$password = "";             // Database password
$dbname = "scc_nconf";  // Replace with your database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Stop execution and show error
}

?>
