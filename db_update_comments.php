<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "campus_app", 3308);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Create Comments Table
$sql = "CREATE TABLE IF NOT EXISTS `comments` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `post_id` INT(11) NOT NULL,
    `user_id` INT(11) NOT NULL,
    `content` TEXT NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`post_id`) REFERENCES `posts`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
)";

if ($mysqli->query($sql)) {
    echo "Comments table created or verified.<br>";
} else {
    echo "Error creating comments table: " . $mysqli->error . "<br>";
}

$mysqli->close();
?>