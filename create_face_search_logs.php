<?php
/**
 * Create Face Search Logs Table Query
 * Run via: php create_face_search_logs.php
 */

$host = '127.0.0.1';
$port = 3308; // Based on previous context
$dbname = 'campus_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Creating face_search_logs table...\n";

    $sql = "CREATE TABLE IF NOT EXISTS face_search_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        admin_id INT NOT NULL,
        search_type ENUM('upload', 'webcam') NOT NULL,
        matches_found INT DEFAULT 0,
        search_timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $pdo->exec($sql);
    echo "Table 'face_search_logs' created successfully!\n";

} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage() . "\n");
}
