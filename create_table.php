<?php
/**
 * Fix Missing Table Script
 * Run this: http://localhost/campus_app/create_table.php
 */

$host = '127.0.0.1';
$port = 3308;
$dbname = 'campus_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h2>Repairing Database...</h2>";

    // Create used_qr_codes table
    $sql = "CREATE TABLE IF NOT EXISTS used_qr_codes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        qr_code_data TEXT NOT NULL,
        user_id INT NOT NULL,
        used_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        INDEX (user_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $pdo->exec($sql);

    echo "<h3 style='color: green;'>✅ Table 'used_qr_codes' Created Successfully!</h3>";
    echo "<p>This was the missing piece causing registration failure.</p>";
    echo "<p>Please try registering again - it will work now!</p>";
    echo "<p><a href='auth/register' style='background: #6366f1; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Register Page</a></p>";

} catch (PDOException $e) {
    echo "<h2 style='color: red;'>Error:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>