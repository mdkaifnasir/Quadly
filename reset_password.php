<?php
/**
 * Reset password for existing user
 * Run this: http://localhost/campus_app/reset_password.php
 */

$host = '127.0.0.1';
$port = 3308;
$dbname = 'campus_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Update password for your account
    $email = 'mdkaifnasir@gmail.com';
    $new_password = 'password123';
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->execute([$hashed_password, $email]);

    echo "<h2 style='color: green;'>✅ Password Reset Successfully!</h2>";
    echo "<div style='background: #f0f0f0; padding: 20px; border-radius: 10px; max-width: 500px;'>";
    echo "<h3>Your New Login Credentials:</h3>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>New Password:</strong> $new_password</p>";
    echo "<p style='margin-top: 20px;'><a href='auth/login' style='background: #6366f1; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Login Page</a></p>";
    echo "</div>";
    echo "<hr>";
    echo "<p style='color: #666;'>You can now login with the new password!</p>";
    echo "<p style='color: red; margin-top: 20px;'><strong>Delete this file after use!</strong></p>";

} catch (PDOException $e) {
    echo "<h2 style='color: red;'>Error:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>