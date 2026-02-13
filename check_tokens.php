<?php
$mysqli = new mysqli("localhost", "root", "", "campus_app");
$result = $mysqli->query("SELECT email, reset_token, reset_token_expire FROM users WHERE reset_token IS NOT NULL");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Email: " . $row['email'] . " | Token: " . substr($row['reset_token'], 0, 10) . "... | Expire: " . $row['reset_token_expire'] . "\n";
    }
} else {
    echo "No reset tokens found.\n";
}
$mysqli->close();
?>