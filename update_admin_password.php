<?php
// Database connection
$mysqli = new mysqli('localhost', 'root', '', 'dto_database');

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

$mysqli->set_charset('utf8mb4');

// Correct bcrypt hash for "admin123"
// Generated with: password_hash('admin123', PASSWORD_BCRYPT, ['cost' => 10])
$correctHash = '$2y$10$NQ0dMwY8qCaQu0vR7mN1uenE7VYwQvHXnRNJ4v4c1qV5K2K5L8H3G';

echo "Fixing admin user login...<br><br>";

// First, check if admin user exists
$check = $mysqli->query("SELECT id, username FROM users WHERE username = 'admin'");

if ($check && $check->num_rows > 0) {
    // Admin exists, update password hash
    $sql = "UPDATE users SET password_hash = '$correctHash' WHERE username = 'admin'";
    
    if ($mysqli->query($sql)) {
        echo "✓ Admin password hash updated!<br>";
    } else {
        echo "✗ Update failed: " . $mysqli->error . "<br>";
    }
} else {
    // Admin doesn't exist, create it
    $sql = "INSERT INTO users (username, email, password_hash, role, is_active) 
            VALUES ('admin', 'admin@dto.local', '$correctHash', 'admin', TRUE)";
    
    if ($mysqli->query($sql)) {
        echo "✓ Admin user created!<br>";
    } else {
        echo "✗ Insert failed: " . $mysqli->error . "<br>";
    }
}

// Verify the hash
echo "<br>Testing hash verification:<br>";
if (password_verify('admin123', $correctHash)) {
    echo "✓ Hash verification: SUCCESS<br>";
} else {
    echo "✗ Hash verification: FAILED<br>";
}

echo "<br><strong>Login Credentials:</strong><br>";
echo "Username: <code>admin</code><br>";
echo "Password: <code>admin123</code><br>";

echo "<br><a href='login.php' style='color: blue; text-decoration: underline;'>Go to Login Page</a>";

$mysqli->close();
?>
