<?php
/**
 * Script to create a test user account
 * Run this file once in your browser: http://localhost/campus_app/create_test_user.php
 */

// Database configuration
$host = '127.0.0.1';
$port = 3308;
$dbname = 'campus_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Test account details
    $email = 'test@campus.com';
    $plain_password = 'test123';
    $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

    // Check if user already exists
    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        echo "<h2>User already exists!</h2>";
        echo "<p>Email: <strong>$email</strong></p>";
        echo "<p>Password: <strong>$plain_password</strong></p>";
        echo "<p><a href='auth/login'>Go to Login</a></p>";
        exit;
    }

    // Insert test user
    $sql = "INSERT INTO users (
        username, 
        first_name, 
        last_name, 
        email, 
        password, 
        dob, 
        gender, 
        mobile, 
        major, 
        student_id, 
        role, 
        is_verified,
        created_at
    ) VALUES (
        'testuser',
        'Test',
        'User',
        ?,
        ?,
        '2000-01-01',
        'Male',
        '1234567890',
        'Computer Science',
        'TEST001',
        'student',
        1,
        NOW()
    )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, $hashed_password]);

    echo "<h2 style='color: green;'>✅ Test Account Created Successfully!</h2>";
    echo "<div style='background: #f0f0f0; padding: 20px; border-radius: 10px; max-width: 500px;'>";
    echo "<h3>Login Credentials:</h3>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Password:</strong> $plain_password</p>";
    echo "<p style='margin-top: 20px;'><a href='auth/login' style='background: #6366f1; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Login Page</a></p>";
    echo "</div>";
    echo "<p style='color: red; margin-top: 20px;'><strong>Important:</strong> Delete this file (create_test_user.php) after use for security!</p>";

} catch (PDOException $e) {
    echo "<h2 style='color: red;'>Error creating test user:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p>Make sure your database is running and the connection details are correct.</p>";
}
?>