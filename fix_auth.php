<?php
/**
 * Master Fix Script
 * Run this: http://localhost/campus_app/fix_auth.php
 */

$host = '127.0.0.1';
$port = 3308;
$dbname = 'campus_app';
$username = 'root';
$password = '';

echo "<html><body style='font-family: sans-serif; padding: 20px; line-height: 1.6;'>";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h1>🔧 Authentication Repair</h1>";

    // 1. CHECK SCHEMA
    echo "<h3>1. Checking Database Schema...</h3>";
    $stmt = $pdo->query("SHOW COLUMNS FROM users LIKE 'password'");
    $col = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($col) {
        $type = $col['Type'];
        echo "Password column type: <code>$type</code><br>";
        if (strpos($type, 'varchar') !== false) {
            preg_match('/\d+/', $type, $matches);
            $len = $matches[0] ?? 0;
            if ($len < 60) {
                echo "<b style='color:red'>CRITICAL: Password column too short ($len). fixing...</b><br>";
                $pdo->exec("ALTER TABLE users MODIFY password VARCHAR(255)");
                echo "<b style='color:green'>FIXED: Password column expanded to VARCHAR(255)</b><br>";
            } else {
                echo "<span style='color:green'>✔ Password column length is good.</span><br>";
            }
        }
    } else {
        echo "<b style='color:red'>CRITICAL: Password column missing!</b><br>";
    }

    // 2. FORCE CREATE/UPDATE USER
    echo "<h3>2. Account Repair...</h3>";
    $email = 'mdkaifnasir@gmail.com'; // The user's email
    $pass = 'password123';
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    // Check if user exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Update existing
        echo "User <b>$email</b> does exist. Resetting password...<br>";
        $upd = $pdo->prepare("UPDATE users SET password = ?, is_verified = 1 WHERE email = ?");
        $upd->execute([$hash, $email]);
        echo "<b style='color:green'>✔ PASSWORD RESET SUCCESSFUL</b><br>";
    } else {
        // Create new
        echo "User <b>$email</b> NOT found. Creating new account...<br>";
        $ins = $pdo->prepare("INSERT INTO users (username, first_name, last_name, email, password, role, is_verified, created_at) VALUES (?, ?, ?, ?, ?, ?, 1, NOW())");
        // Generate random username
        $username = 'user_' . substr(md5(time()), 0, 8);
        $ins->execute([$username, 'Kaif', 'Nasir', $email, $hash, 'student']);
        echo "<b style='color:green'>✔ NEW ACCOUNT CREATED SUCESSFULLY</b><br>";
    }

    echo "<hr>";
    echo "<div style='background:#e6fffa; border:2px solid #38b2ac; padding:20px; border-radius:10px; text-align:center;'>";
    echo "<h2>🚀 ACCOUNT READY</h2>";
    echo "<p>Login with:</p>";
    echo "<p>Email: <b>$email</b></p>";
    echo "<p>Password: <b>$pass</b></p>";
    echo "<p><a href='auth/login' style='background:#6366f1; color:white; padding:10px 20px; text-decoration:none; border-radius:5px; font-weight:bold;'>LOGIN NOW</a></p>";
    echo "</div>";

} catch (PDOException $e) {
    echo "<h2 style='color:red'>❌ ERROR</h2>";
    echo $e->getMessage();
}

echo "</body></html>";
?>