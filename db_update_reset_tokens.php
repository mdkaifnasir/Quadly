<?php
$mysqli = new mysqli("localhost", "root", "", "campus_app");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Add reset_token column
$check = $mysqli->query("SHOW COLUMNS FROM users LIKE 'reset_token'");
if ($check->num_rows == 0) {
    echo "Adding reset_token column...<br>";
    if ($mysqli->query("ALTER TABLE users ADD COLUMN reset_token VARCHAR(255) NULL AFTER password")) {
        echo "Success.<br>";
    } else {
        echo "Error: " . $mysqli->error . "<br>";
    }
} else {
    echo "reset_token column already exists.<br>";
}

// Add reset_token_expire column
$check = $mysqli->query("SHOW COLUMNS FROM users LIKE 'reset_token_expire'");
if ($check->num_rows == 0) {
    echo "Adding reset_token_expire column...<br>";
    if ($mysqli->query("ALTER TABLE users ADD COLUMN reset_token_expire DATETIME NULL AFTER reset_token")) {
        echo "Success.<br>";
    } else {
        echo "Error: " . $mysqli->error . "<br>";
    }
} else {
    echo "reset_token_expire column already exists.<br>";
}

$mysqli->close();
?>