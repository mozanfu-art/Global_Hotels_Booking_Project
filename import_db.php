<?php
$conn = new mysqli(
    getenv('MYSQLHOST'),      // mysql.railway.internal
    getenv('MYSQLUSER'),
    getenv('MYSQLPASSWORD'),
    getenv('MYSQLDATABASE'),
    getenv('MYSQLPORT')
);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = file_get_contents('global_hotels_booking.sql');

if ($conn->multi_query($sql)) {
    echo "Database imported successfully!";
} else {
    echo "Error importing database: " . $conn->error;
}

$conn->close();
?>
