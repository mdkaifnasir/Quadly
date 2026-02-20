<?php
$hostname = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'campus_app';
$port = 3308;

$mysqli = new mysqli($hostname, $username, $password, "", $port);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Databases:\n";
$result = $mysqli->query("SHOW DATABASES");
while ($row = $result->fetch_assoc()) {
    echo "- " . $row['Database'] . "\n";
}

$mysqli->select_db($database);
if ($mysqli->error) {
    echo "Error selecting db '$database': " . $mysqli->error . "\n";
} else {
    echo "Tables in '$database':\n";
    $result = $mysqli->query("SHOW TABLES");
    while ($row = $result->fetch_row()) {
        echo "- " . $row[0] . "\n";
    }
}
?>