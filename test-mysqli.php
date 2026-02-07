<?php
echo "PHP version: " . PHP_VERSION . PHP_EOL;
echo "Loaded php.ini: " . php_ini_loaded_file() . PHP_EOL;

if (class_exists('mysqli')) {
    echo "mysqli is loaded ✅" . PHP_EOL;
} else {
    echo "mysqli is NOT loaded ❌" . PHP_EOL;
}

if (extension_loaded('pdo_mysql')) {
    echo "pdo_mysql is loaded ✅" . PHP_EOL;
} else {
    echo "pdo_mysql is NOT loaded ❌" . PHP_EOL;
}
