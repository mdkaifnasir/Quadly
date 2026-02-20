<?php
/**
 * Debug script to check login issue
 * Run this: http://localhost/campus_app/debug_login.php
 */

$host = '127.0.0.1';
$port = 3308;
$dbname = 'campus_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h2>Login Debug Information</h2>";
    echo "<hr>";

    // Check if test user exists
    $email = 'test@campus.com';
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "<h3 style='color: green;'>✅ User Found in Database</h3>";
        echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
        echo "<tr><th>Field</th><th>Value</th></tr>";
        echo "<tr><td>ID</td><td>{$user['id']}</td></tr>";
        echo "<tr><td>Username</td><td>{$user['username']}</td></tr>";
        echo "<tr><td>Email</td><td>{$user['email']}</td></tr>";
        echo "<tr><td>First Name</td><td>{$user['first_name']}</td></tr>";
        echo "<tr><td>Role</td><td>{$user['role']}</td></tr>";
        echo "<tr><td>Password Hash</td><td>" . substr($user['password'], 0, 50) . "...</td></tr>";
        echo "</table>";

        echo "<hr>";
        echo "<h3>Password Verification Test</h3>";

        $test_password = 'test123';
        $is_valid = password_verify($test_password, $user['password']);

        if ($is_valid) {
            echo "<p style='color: green; font-size: 18px;'><strong>✅ Password verification PASSED!</strong></p>";
            echo "<p>The password 'test123' matches the hash in database.</p>";
            echo "<p style='color: red;'><strong>This means there's an issue with the login controller logic, not the password.</strong></p>";
        } else {
            echo "<p style='color: red; font-size: 18px;'><strong>❌ Password verification FAILED!</strong></p>";
            echo "<p>The password 'test123' does NOT match the hash in database.</p>";
            echo "<p>This shouldn't happen - the script should have created it correctly.</p>";
        }

    } else {
        echo "<h3 style='color: red;'>❌ User NOT Found</h3>";
        echo "<p>The user with email '$email' does not exist in the database.</p>";
        echo "<p>Please run create_test_user.php first.</p>";
    }

    echo "<hr>";
    echo "<h3>All Users in Database:</h3>";
    $all_users = $pdo->query("SELECT id, username, email, role FROM users")->fetchAll(PDO::FETCH_ASSOC);

    if (count($all_users) > 0) {
        echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
        echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th></tr>";
        foreach ($all_users as $u) {
            echo "<tr>";
            echo "<td>{$u['id']}</td>";
            echo "<td>{$u['username']}</td>";
            echo "<td>{$u['email']}</td>";
            echo "<td>{$u['role']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No users found in database.</p>";
    }

} catch (PDOException $e) {
    echo "<h2 style='color: red;'>Database Error:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>