<?php
// Quick test to verify login works
$mysqli = new mysqli('localhost', 'root', '', 'dto_database');
$mysqli->set_charset('utf8mb4');

// Test password
$testPassword = 'admin123';
$correctHash = '$2y$10$NQ0dMwY8qCaQu0vR7mN1uenE7VYwQvHXnRNJ4v4c1qV5K2K5L8H3G';

// Verify the hash works with password_verify
$isValid = password_verify($testPassword, $correctHash);

// Check if admin user exists in database
$result = $mysqli->query("SELECT id, username, email, password_hash, role, is_active FROM users WHERE username = 'admin' LIMIT 1");

echo "<h2>Login Fix Verification</h2>";
echo "<hr>";
echo "<p><strong>Hash Verification:</strong> " . ($isValid ? "✓ PASS" : "✗ FAIL") . "</p>";

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "<p><strong>Admin User Found:</strong> ✓</p>";
    echo "<ul>";
    echo "<li>Username: " . htmlspecialchars($user['username']) . "</li>";
    echo "<li>Email: " . htmlspecialchars($user['email']) . "</li>";
    echo "<li>Role: " . htmlspecialchars($user['role']) . "</li>";
    echo "<li>Active: " . ($user['is_active'] ? "Yes" : "No") . "</li>";
    
    // Test if password_verify works on stored hash
    $dbVerify = password_verify($testPassword, $user['password_hash']);
    echo "<li>Password Verify (stored hash): " . ($dbVerify ? "✓ PASS" : "✗ FAIL") . "</li>";
    echo "</ul>";
} else {
    echo "<p><strong>Admin User Found:</strong> ✗ NOT FOUND</p>";
}

echo "<hr>";
echo "<p><strong>Expected Login Credentials:</strong></p>";
echo "<ul>";
echo "<li>Username: <code>admin</code></li>";
echo "<li>Password: <code>admin123</code></li>";
echo "</ul>";

echo "<p><a href='login.php' style='color: blue; text-decoration: underline;'>&larr; Go to Login Page</a></p>";

$mysqli->close();
?>
