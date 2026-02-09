<?php
// db-connect.php

// Load environment variables from Railway or fallback to local defaults
$servername = getenv('MYSQLHOST') ?: "127.0.0.1";
$username   = getenv('MYSQLUSER') ?: "root";
$password   = getenv('MYSQLPASSWORD') ?: ""; // change locally
$dbname     = getenv('MYSQLDATABASE') ?: "global_hotels_booking";
$port       = getenv('MYSQLPORT') ?: 3306;

// Create a MySQLi connection
$conn = @new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: (" . $conn->connect_errno . ") " . $conn->connect_error);
}

// Optional: Uncomment to test connection
// echo "Connected successfully to $servername:$port, DB: $dbname";

?>
