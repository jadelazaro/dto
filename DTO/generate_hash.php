<?php
// Generate bcrypt hash for "admin123"
$hash = password_hash('admin123', PASSWORD_BCRYPT, ['cost' => 10]);
echo "Bcrypt hash for 'admin123': " . $hash . "\n";
echo "Verify: " . (password_verify('admin123', $hash) ? 'OK' : 'FAILED') . "\n";
?>
