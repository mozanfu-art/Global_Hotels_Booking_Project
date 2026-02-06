<?php
$servername = getenv('RAILWAY_MYSQL_HOST');
$username   = getenv('RAILWAY_MYSQL_USER');
$password   = getenv('RAILWAY_MYSQL_PASSWORD');
$dbname     = getenv('RAILWAY_MYSQL_DATABASE');
$port       = getenv('RAILWAY_MYSQL_PORT'); // optional, default 3306

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
