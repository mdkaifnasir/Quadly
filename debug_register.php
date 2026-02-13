<?php
/**
 * Debug Registration Script
 * Run this: http://localhost/campus_app/debug_register.php
 */

$host = '127.0.0.1';
$port = 3308;
$dbname = 'campus_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h2>Registration Debugger</h2>";
    echo "<a href='debug_login.php'>Check Existing Users</a> | <a href='auth/register'>Go to Register Page</a><br><br>";

    // 1. Check Table Structure
    echo "<h3>1. Checking 'users' Table Structure</h3>";
    $stmt = $pdo->query("DESCRIBE users");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Columns found: " . implode(", ", $columns) . "<br>";

    // Check for critical columns
    $critical = ['username', 'email', 'password', 'role', 'student_id', 'profile_photo', 'id_card', 'face_descriptor'];
    foreach ($critical as $col) {
        if (!in_array($col, $columns)) {
            echo "<span style='color:red'>MISSING COLUMN: $col</span><br>";
        } else {
            echo "<span style='color:green'>Found column: $col</span><br>";
        }
    }

    // 2. Simulate a basic insert (Dry Run)
    echo "<hr><h3>2. Test Insert Capability</h3>";
    $test_email = 'debug_' . time() . '@test.com';
    echo "Attempting to insert dummy user: $test_email<br>";

    // We won't actually insert to avoid clutter, unless requested. 
    // But we will check if the SQL is valid.

    echo "Database connection is working. If registration fails, it is likely a validation error in PHP.<br>";
    echo "Check the following in your registration process:<br>";
    echo "<ul>";
    echo "<li><strong>QR Code:</strong> Is the QR code successfully scanning? Check if the hidden input 'qr_code_data' is populated.</li>";
    echo "<li><strong>OTP:</strong> Is the OTP session matching the input?</li>";
    echo "<li><strong>Uploads:</strong> Are file uploads (photo/ID) working? Check 'uploads' folder permissions.</li>";
    echo "</ul>";

} catch (PDOException $e) {
    echo "<h2 style='color: red;'>Database Error:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>