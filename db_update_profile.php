<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "campus_app", 3308);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Add bio column
$check = $mysqli->query("SHOW COLUMNS FROM users LIKE 'bio'");
if ($check->num_rows == 0) {
    echo "Adding bio column...<br>";
    if ($mysqli->query("ALTER TABLE users ADD COLUMN bio TEXT NULL AFTER last_name")) {
        echo "Success.<br>";
    } else {
        echo "Error: " . $mysqli->error . "<br>";
    }
} else {
    echo "bio column already exists.<br>";
}

// Add link column
$check = $mysqli->query("SHOW COLUMNS FROM users LIKE 'link'");
if ($check->num_rows == 0) {
    echo "Adding link column...<br>";
    if ($mysqli->query("ALTER TABLE users ADD COLUMN link VARCHAR(255) NULL AFTER bio")) {
        echo "Success.<br>";
    } else {
        echo "Error: " . $mysqli->error . "<br>";
    }
} else {
    echo "link column already exists.<br>";
}

$mysqli->close();
?>