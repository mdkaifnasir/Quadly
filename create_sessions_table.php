<?php
/**
 * Create Session Table Script
 * Run this by visiting: http://localhost/campus_app/create_sessions_table.php
 * Or via command line: php create_sessions_table.php
 */

// Database credentials from database.php (assuming standard local setup matching create_table.php)
$host = '127.0.0.1';
$port = 3308; // Based on create_table.php
$dbname = 'campus_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h2>Creating Sessions Table...</h2>";

    // CodeIgniter 3 Session Table Schema
    // Reference: https://codeigniter.com/userguide3/libraries/sessions.html#database-driver
    $sql = "CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `ci_sessions_timestamp` (`timestamp`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $pdo->exec($sql);

    // Add Primary Key if not exists (separate execution to avoid errors if key exists differently)
    // Note: We use a simple query to add the primary key if the table was just created
    // But if it existed without a PK, this might fail or duplicate. 
    // Given the 'IF NOT EXISTS' above, we'll try to add the index safely if it's a fresh create.

    // For safety, let's just make sure the table has the correct index structure
    // We'll rely on the user having a fresh restart or this being the first time creation.
    // If the table already exists but is broken, this script might need manual intervention,
    // but the error was "Table doesn't exist", so we are good.

    // We need to set the Primary Key. CodeIgniter expects 'id' to be the primary key (when sess_match_ip is FALSE)
    // However, the CREATE TABLE statement above didn't specify PRIMARY KEY directly to keep it flexible
    // Let's alter it to add the primary key.

    try {
        $sqlIdx = "ALTER TABLE `ci_sessions` ADD PRIMARY KEY (`id`)";
        $pdo->exec($sqlIdx);
        echo "<p>Primary Key added to 'id'.</p>";
    } catch (PDOException $e) {
        // Ignore if key already exists or defined
        echo "<p>Note: " . $e->getMessage() . "</p>";
    }

    echo "<h3 style='color: green;'>✅ Table 'ci_sessions' Created Successfully!</h3>";
    echo "<p>Session error should be resolved.</p>";
    echo "<p><a href='index.php' style='background: #6366f1; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Home</a></p>";

} catch (PDOException $e) {
    echo "<h2 style='color: red;'>Error:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>