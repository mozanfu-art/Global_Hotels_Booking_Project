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
$conn->set_charset("utf8");
?>
