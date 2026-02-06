<?php
$servername = getenv('MYSQLHOST') ?: "mysql.railway.internal";
$username = getenv('MYSQLUSER') ?: "root";
$password = getenv('MYSQLPASSWORD') ?: "pWdzfiXDERePDBdxujdVHludnwhRvBPv";
$dbname = getenv('MYSQLDATABASE') ?: "railway";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read the SQL file
$sql = file_get_contents('global_hotels_booking.sql');

// Execute the SQL
if ($conn->multi_query($sql)) {
    echo "Database imported successfully!";
} else {
    echo "Error importing database: " . $conn->error;
}

$conn->close();
?>
