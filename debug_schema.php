<?php
/**
 * Debug Schema Script
 * Run this: http://localhost/campus_app/debug_schema.php
 */

$host = '127.0.0.1';
$port = 3308;
$dbname = 'campus_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h2>Database Schema Debugger</h2>";

    // Check users table columns and types
    echo "<h3>Users Table Columns:</h3>";
    $stmt = $pdo->query("DESCRIBE users");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";

    foreach ($columns as $col) {
        $color = ($col['Field'] == 'password') ? 'style="background: #ffffcc"' : '';
        echo "<tr $color>";
        echo "<td>{$col['Field']}</td>";
        echo "<td>{$col['Type']}</td>";
        echo "<td>{$col['Null']}</td>";
        echo "<td>{$col['Key']}</td>";
        echo "<td>{$col['Default']}</td>";
        echo "</tr>";
    }
    echo "</table>";

    // Check if password column is long enough
    foreach ($columns as $col) {
        if ($col['Field'] == 'password') {
            echo "<h3>Password Column Analysis:</h3>";
            if (strpos($col['Type'], 'varchar') !== false) {
                preg_match('/\d+/', $col['Type'], $matches);
                $length = isset($matches[0]) ? intval($matches[0]) : 0;
                if ($length < 60) {
                    echo "<p style='color:red; font-weight:bold'>CRITICAL ERROR: Password column is too short ($length). It must be at least 60 characters for BCrypt!</p>";
                } else {
                    echo "<p style='color:green'>Password column length ($length) is sufficient.</p>";
                }
            } else {
                echo "<p>Password column type is: " . $col['Type'] . "</p>";
            }
        }
    }

} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
?>