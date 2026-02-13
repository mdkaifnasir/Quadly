<?php
/**
 * Reset QR Codes Script
 * Run this: http://localhost/campus_app/reset_qr.php
 */

$host = '127.0.0.1';
$port = 3308;
$dbname = 'campus_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h2>QR Code Reset</h2>";

    // Clear qr_codes table
    $pdo->exec("TRUNCATE TABLE qr_codes");

    echo "<h3 style='color: green;'>✅ QR Code History Cleared!</h3>";
    echo "<p>You can now reuse your ID card for registration.</p>";
    echo "<p><strong>Note:</strong> In a real scenario, this would allow double-registration, but for testing it's fine.</p>";
    echo "<p><a href='auth/register' style='background: #6366f1; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Register Page</a></p>";

} catch (PDOException $e) {
    echo "<h2 style='color: red;'>Error:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>