<?php
// Script to update database and seed admin
$mysqli = new mysqli("localhost", "root", "", "campus_app");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// 1. Add Columns
$sql = "ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `status` ENUM('pending', 'active', 'suspended') DEFAULT 'pending'";
$mysqli->query($sql);
$sql = "ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `is_verified` TINYINT(1) DEFAULT 0";
$mysqli->query($sql);
$sql = "ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `id_card` VARCHAR(255) DEFAULT NULL";
$mysqli->query($sql);
$sql = "ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `face_descriptor` TEXT DEFAULT NULL";
$mysqli->query($sql);

// 1b. Create Departments Table
$sql = "CREATE TABLE IF NOT EXISTS `departments` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `code` VARCHAR(20) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
)";
if ($mysqli->query($sql)) {
    echo "Departments table check/creation successful.<br>";
} else {
    echo "Error creating departments table: " . $mysqli->error . "<br>";
}

// 1c. Create Posts Table
$sql = "CREATE TABLE IF NOT EXISTS `posts` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT(11) NOT NULL,
    `content` TEXT,
    `image` VARCHAR(255),
    `likes_count` INT(11) DEFAULT 0,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
)";
if ($mysqli->query($sql)) {
    echo "Posts table check/creation successful.<br>";
    echo "Error creating posts table: " . $mysqli->error . "<br>";
}

// 1d. Create Stories Table
$sql = "CREATE TABLE IF NOT EXISTS `stories` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT(11) NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `caption` VARCHAR(255) DEFAULT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `expires_at` DATETIME,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
)";
if ($mysqli->query($sql)) {
    echo "Stories table check/creation successful.<br>";
} else {
    echo "Error creating stories table: " . $mysqli->error . "<br>";
}

// 2. Seed Admin
$password = password_hash("admin123", PASSWORD_DEFAULT);
$check = $mysqli->query("SELECT id FROM users WHERE email = 'admin@university.edu'");
if ($check->num_rows == 0) {
    $stmt = $mysqli->prepare("INSERT INTO users (first_name, last_name, email, password, role, status, is_verified, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    $fname = "System";
    $lname = "Admin";
    $email = "admin@university.edu";
    $role = "admin";
    $status = "active";
    $ver = 1;
    $stmt->bind_param("ssssssi", $fname, $lname, $email, $password, $role, $status, $ver);
    if ($stmt->execute()) {
        echo "Admin user created successfully.<br>";
    } else {
        echo "Error creating admin: " . $mysqli->error . "<br>";
    }
} else {
    echo "Admin user already exists.<br>";
}

// 3. Seed Sample Post
$check_post = $mysqli->query("SELECT id FROM posts LIMIT 1");
if ($check_post->num_rows == 0) {
    // Get admin ID
    $admin_res = $mysqli->query("SELECT id FROM users WHERE role='admin' LIMIT 1");
    if($admin_row = $admin_res->fetch_assoc()) {
        $uid = $admin_row['id'];
        $content = "Welcome to the new Campus App! 🎓 This is the start of our dynamic timeline. Stay tuned for updates.";
        $mysqli->query("INSERT INTO posts (user_id, content, created_at) VALUES ($uid, '$content', NOW())");
        echo "Sample post created.<br>";
    }
}

echo "Database updated successfully.";
$mysqli->close();
?>
