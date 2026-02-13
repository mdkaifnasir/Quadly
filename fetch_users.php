<?php
$hostname = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'campus_app';
$port = 3308;

$mysqli = new mysqli($hostname, $username, $password, $database, $port);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT email, username, password FROM users LIMIT 5");
echo "Users:\n";
while ($row = $result->fetch_assoc()) {
    echo "- Email: " . $row['email'] . " | Username: " . $row['username'] . " | PW Hash: " . $row['password'] . "\n";
}

$mysqli->close();
?>