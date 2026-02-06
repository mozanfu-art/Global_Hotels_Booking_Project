<?php
echo "<h1>Environment Variables Debug</h1>";
echo "<pre>";

// Check common Railway MySQL environment variables
$env_vars = [
    'MYSQLHOST',
    'MYSQLUSER',
    'MYSQLPASSWORD',
    'MYSQLDATABASE',
    'DATABASE_URL',
    'MYSQL_URL',
    'DB_HOST',
    'DB_USER',
    'DB_PASSWORD',
    'DB_NAME'
];

foreach ($env_vars as $var) {
    $value = getenv($var);
    echo "$var: " . ($value ? $value : "NOT SET") . "\n";
}

echo "</pre>";
?>
