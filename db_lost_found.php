<?php
/**
 * Create Lost & Found Items Table Script
 */

$host = '127.0.0.1';
$port = 3308;
$dbname = 'campus_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h2>Creating Lost & Found Table...</h2>";

    $sql = "CREATE TABLE IF NOT EXISTS `lost_found_items` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `user_id` int(11) NOT NULL,
        `type` enum('lost','found') NOT NULL,
        `item_name` varchar(255) NOT NULL,
        `description` text,
        `location` varchar(255) DEFAULT NULL,
        `category` varchar(100) DEFAULT NULL,
        `image` varchar(255) DEFAULT NULL,
        `status` enum('active','resolved') DEFAULT 'active',
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        KEY `user_id` (`user_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $pdo->exec($sql);

    echo "<h3 style='color: green;'>✅ Table 'lost_found_items' Created Successfully!</h3>";
    echo "<p><a href='index.php'>Go to Home</a></p>";

} catch (PDOException $e) {
    echo "<h2 style='color: red;'>Error:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>