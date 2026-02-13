<?php
define('BASEPATH', 'true');
require_once('application/config/database.php');
$config = $db['default'];

$mysqli = new mysqli($config['hostname'], $config['username'], $config['password'], $config['database'], 3308);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Testing connection with CI config:\n";
echo "Host: " . $config['hostname'] . "\n";
echo "DB: " . $config['database'] . "\n";

$result = $mysqli->query("SHOW TABLES LIKE 'lost_found_replies'");
if ($result->num_rows > 0) {
    echo "SUCCESS: Table 'lost_found_replies' found!\n";
} else {
    echo "ERROR: Table 'lost_found_replies' NOT found in '" . $config['database'] . "'\n";

    echo "Available tables:\n";
    $tables = $mysqli->query("SHOW TABLES");
    while ($row = $tables->fetch_array()) {
        echo "- " . $row[0] . "\n";
    }
}

$mysqli->close();
?>