<?php
require_once 'config.php';

// Correct bcrypt hash for "admin123"
$correctHash = '$2y$10$NQ0dMwY8qCaQu0vR7mN1uenE7VYwQvHXnRNJ4v4c1qV5K2K5L8H3G';

// Update admin user password
$stmt = $mysqli->prepare("UPDATE users SET password_hash = ? WHERE username = 'admin' LIMIT 1");
if (!$stmt) {
    die("Prepare failed: " . $mysqli->error);
}

$stmt->bind_param("s", $correctHash);
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$affected = $stmt->affected_rows;
$stmt->close();

if ($affected > 0) {
    echo "✓ Admin password hash updated successfully!<br>";
    echo "Username: admin<br>";
    echo "Password: admin123<br>";
    
    // Verify the hash works
    if (password_verify('admin123', $correctHash)) {
        echo "✓ Hash verification: OK<br>";
    } else {
        echo "✗ Hash verification: FAILED<br>";
    }
} else {
    echo "No rows updated. Checking if admin user exists...<br>";
    
    // Check if admin user exists
    $result = $mysqli->query("SELECT id, username, email FROM users WHERE username = 'admin'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Admin user found: " . htmlspecialchars($row['username']) . " (" . htmlspecialchars($row['email']) . ")<br>";
        echo "Creating update script...<br>";
        
        // Try to update with INSERT ON DUPLICATE KEY
        $insertStmt = $mysqli->prepare("INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, 'admin') ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash)");
        if (!$insertStmt) {
            die("Prepare failed: " . $mysqli->error);
        }
        
        $username = 'admin';
        $email = 'admin@dto.local';
        $insertStmt->bind_param("sss", $username, $email, $correctHash);
        if (!$insertStmt->execute()) {
            die("Execute failed: " . $insertStmt->error);
        }
        
        echo "✓ Password reset complete!<br>";
    } else {
        echo "Admin user not found. Creating new admin user...<br>";
        
        $username = 'admin';
        $email = 'admin@dto.local';
        $createStmt = $mysqli->prepare("INSERT INTO users (username, email, password_hash, role, is_active) VALUES (?, ?, ?, 'admin', TRUE)");
        if (!$createStmt) {
            die("Prepare failed: " . $mysqli->error);
        }
        
        $createStmt->bind_param("sss", $username, $email, $correctHash);
        if (!$createStmt->execute()) {
            die("Execute failed: " . $createStmt->error);
        }
        
        echo "✓ Admin user created successfully!<br>";
    }
}

$mysqli->close();
?>
