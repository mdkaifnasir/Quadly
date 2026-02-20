<?php
// seeder.php - Populates database with fake data

$mysqli = new mysqli("localhost", "root", "", "campus_app");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Starting Seeder...<br>";

// 1. Create Fake Users
$users = [
    ['fname' => 'John', 'lname' => 'Doe', 'role' => 'student', 'gender' => 'Male', 'dept' => 'Computer Science'],
    ['fname' => 'Sarah', 'lname' => 'Smith', 'role' => 'student', 'gender' => 'Female', 'dept' => 'Mathematics'],
    ['fname' => 'Michael', 'lname' => 'Johnson', 'role' => 'faculty', 'gender' => 'Male', 'dept' => 'Physics'],
    ['fname' => 'Emily', 'lname' => 'Davis', 'role' => 'student', 'gender' => 'Female', 'dept' => 'Biology'],
    ['fname' => 'David', 'lname' => 'Wilson', 'role' => 'faculty', 'gender' => 'Male', 'dept' => 'Chemistry']
];

$password = password_hash("password123", PASSWORD_DEFAULT);
$created_user_ids = [];

foreach ($users as $index => $u) {
    $email = strtolower($u['fname'] . "." . $u['lname'] . "@university.edu");
    $check = $mysqli->query("SELECT id FROM users WHERE email = '$email'");
    
    if ($check->num_rows == 0) {
        $stmt = $mysqli->prepare("INSERT INTO users (first_name, last_name, email, password, role, status, is_verified, major, gender, profile_photo, created_at) VALUES (?, ?, ?, ?, ?, 'active', 1, ?, ?, ?, NOW())");
        
        // Use realistic placeholder avatars
        $gender_num = ($u['gender'] == 'Male') ? 'men' : 'women';
        $photo_url = "https://randomuser.me/api/portraits/" . $gender_num . "/" . ($index + 10) . ".jpg";
        
        $stmt->bind_param("ssssssss", $u['fname'], $u['lname'], $email, $password, $u['role'], $u['dept'], $u['gender'], $photo_url);
        
        if ($stmt->execute()) {
            $created_user_ids[] = $mysqli->insert_id;
            echo "Created User: " . $u['fname'] . "<br>";
        } else {
            echo "Error creating " . $u['fname'] . ": " . $mysqli->error . "<br>";
        }
    } else {
        $row = $check->fetch_assoc();
        $created_user_ids[] = $row['id'];
        echo "User " . $u['fname'] . " already exists.<br>";
    }
}

// 2. Create Fake Posts
$sample_posts = [
    "Just finished the final project for CS101! 💻 #coding #university",
    "Campus looks beautiful today! ☀️",
    "Anyone want to study at the library later? 📚",
    "Don't forget the seminar tomorrow at 2 PM in Hall A.",
    "Excited for the upcoming cultural fest! 🎉",
    "Does anyone have notes for yesterday's Physics lecture?",
    "Coffee break at the cafeteria ☕️",
    "Just submitted my research paper! Fingers crossed. 🤞",
    "Football match this weekend! Who's coming? ⚽️",
    "Reminder: Assignment due date extended to Friday."
];

$sample_images = [
    "https://images.unsplash.com/photo-1510915228340-29c85a43dcfe?w=800&q=80", // coding
    "https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=800&q=80", // campus
    "https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=800&q=80", // library
    null,
    "https://images.unsplash.com/photo-1517457373958-b7bdd4587205?w=800&q=80", // party
    null,
    "https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=800&q=80", // coffee
    null, 
    "https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=800&q=80", // sports
    null
];

// Combine existing users (including admin) with new ones for variety
$all_check = $mysqli->query("SELECT id FROM users");
$all_user_ids = [];
while ($row = $all_check->fetch_assoc()) {
    $all_user_ids[] = $row['id'];
}

if (!empty($all_user_ids)) {
    for ($i = 0; $i < 15; $i++) {
        $uid = $all_user_ids[array_rand($all_user_ids)];
        $content = $sample_posts[array_rand($sample_posts)];
        $image = $sample_images[array_rand($sample_images)];
        $likes = rand(0, 50);
        
        // SQL Injection unsafe but acceptable for this internal seeding script
        // Escaping manually just in case
        $content = $mysqli->real_escape_string($content);
        $image_val = $image ? "'$image'" : "NULL";
        
        $sql = "INSERT INTO posts (user_id, content, image, likes_count, created_at) VALUES ($uid, '$content', $image_val, $likes, NOW() - INTERVAL " . rand(0, 100) . " HOUR)";
        
        if ($mysqli->query($sql)) {
             echo "Created Post.<br>";
        } else {
             echo "Error creating post: " . $mysqli->error . "<br>";
        }
    }
}

// 3. Create Fake Stories
$story_images = [
    "https://images.unsplash.com/photo-1593642532400-2682810df593?w=800&q=80",
    "https://images.unsplash.com/photo-1627398242454-45a947e3ab93?w=800&q=80",
    "https://images.unsplash.com/photo-1506784983877-45594efa4cbe?w=800&q=80",
    "https://images.unsplash.com/photo-1510915366472-7cb6256f145f?w=800&q=70",
    "https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=800&q=80"
];

if (!empty($all_user_ids)) {
    for ($i = 0; $i < 10; $i++) {
        $uid = $all_user_ids[array_rand($all_user_ids)];
        $img = $story_images[array_rand($story_images)];
        $caption = "Daily update #" . ($i + 1);
        
        // Active stories (created < 24h ago)
        $sql = "INSERT INTO stories (user_id, image, caption, created_at, expires_at) VALUES ($uid, '$img', '$caption', NOW(), NOW() + INTERVAL 24 HOUR)";
        
        if ($mysqli->query($sql)) {
             echo "Created Active Story.<br>";
        }
    }
}

echo "Seeding Complete.";
$mysqli->close();
?>
