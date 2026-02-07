<?php
// test-env.php

echo "Starting environment test...\n\n";

// Detect if running on Railway
$isRailway = getenv('RAILWAY_ENVIRONMENT') === 'production';

// Local WAMP settings
$local = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '', // WAMP has no password
    'database' => 'global_hotels_booking',
    'port' => 3306
];

// Railway settings (use environment variables from Railway)
$railway = [
    'host' => getenv('MYSQLHOST') ?: 'MySQL.railway.internal',
    'user' => getenv('MYSQLUSER') ?: 'root',
    'password' => getenv('MYSQLPASSWORD') ?: '',
    'database' => getenv('MYSQLDATABASE') ?: 'railway',
    'port' => getenv('MYSQLPORT') ?: 3306
];

// Choose settings
$config = $isRailway ? $railway : $local;

echo "Using " . ($isRailway ? "Railway" : "Local WAMP") . " MySQL settings:\n";
echo "Host: {$config['host']}\n";
echo "User: {$config['user']}\n";
echo "Database: {$config['database']}\n";
echo "Port: {$config['port']}\n\n";

// Connect to MySQL
$mysqli = @new mysqli(
    $config['host'],
    $config['user'],
    $config['password'],
    $config['database'],
    $config['port']
);

if ($mysqli->connect_error) {
    die("Connection failed ❌: " . $mysqli->connect_error . "\n");
}

echo "Connected successfully ✅\n\n";

// Test a query
$result = $mysqli->query("SHOW TABLES");
if ($result) {
    echo "Tables in database '{$config['database']}':\n";
    while ($row = $result->fetch_array()) {
        echo "- {$row[0]}\n";
    }
} else {
    echo "No tables found or query failed.\n";
}

// Close connection
$mysqli->close();
echo "\nEnvironment test completed.\n";
