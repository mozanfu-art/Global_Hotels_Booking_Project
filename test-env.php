<?php
include __DIR__ . '/db-connect.php';

// Test query
$result = $conn->query("SHOW DATABASES");

if ($result) {
    echo "Connection works! Databases on this server:\n";
    while ($row = $result->fetch_assoc()) {
        echo "- " . $row['Database'] . "\n";
    }
} else {
    echo "Query failed: " . $conn->error;
}

$conn->close();
?>
