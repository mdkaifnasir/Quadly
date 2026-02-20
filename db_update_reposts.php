<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "campus_app", 3308);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Create Reposts Table
$sql = "CREATE TABLE IF NOT EXISTS `reposts` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `original_post_id` INT(11) NOT NULL,
    `user_id` INT(11) NOT NULL,
    `comment` TEXT DEFAULT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`original_post_id`) REFERENCES `posts`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
)";

if ($mysqli->query($sql)) {
    echo "Reposts table created or verified.<br>";
} else {
    echo "Error creating reposts table: " . $mysqli->error . "<br>";
}

// Check if reposts_count column exists in posts table, if not add it
$check = $mysqli->query("SHOW COLUMNS FROM posts LIKE 'reposts_count'");
if ($check->num_rows == 0) {
    $mysqli->query("ALTER TABLE posts ADD COLUMN reposts_count INT(11) DEFAULT 0");
    echo "Added reposts_count column to posts table.<br>";
}

$mysqli->close();
?>