<?php
$servername = getenv('MYSQLHOST');      // Railway host
$username   = getenv('MYSQLUSER');      // Railway username
$password   = getenv('MYSQLPASSWORD');  // Railway password
$dbname     = getenv('MYSQLDATABASE');  // Railway database

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
