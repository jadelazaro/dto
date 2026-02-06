<?php
/**
 * Configuration File
 * Centralized database and application settings
 */

// Prevent direct access
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
    die('Direct access not allowed.');
}

// ===== DATABASE CONFIGURATION =====
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'dto_database');
define('DB_CHARSET', 'utf8mb4');
define('DB_PORT', 3306);

// ===== APPLICATION SETTINGS =====
define('APP_NAME', 'DTO - Digital Transformation Office');
define('APP_URL', 'http://localhost/DTO/');
define('APP_TIMEZONE', 'UTC');

// ===== SESSION CONFIGURATION =====
define('SESSION_TIMEOUT', 3600); // 1 hour
define('SESSION_NAME', 'DTO_SESSION');

// ===== SECURITY SETTINGS =====
define('PASSWORD_MIN_LENGTH', 6);
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOCKOUT_TIME', 900); // 15 minutes

// ===== DATABASE CONNECTION =====
try {
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    // Check connection
    if ($mysqli->connect_error) {
        throw new Exception('Database connection failed: ' . $mysqli->connect_error);
    }
    
    // Set charset to utf8mb4
    if (!$mysqli->set_charset(DB_CHARSET)) {
        throw new Exception('Error setting charset: ' . $mysqli->error);
    }
    
    // Enable error reporting for debugging (disable in production)
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
} catch (Exception $e) {
    // Log error and show user-friendly message
    error_log('Database Error: ' . $e->getMessage());
    
    // Only show detailed error if in development
    if (php_sapi_name() === 'cli') {
        die('Database Error: ' . $e->getMessage());
    } else {
        header('HTTP/1.1 503 Service Unavailable');
        die('Database connection error. Please try again later.');
    }
}

// ===== HELPER FUNCTIONS =====

/**
 * Escape string for database queries
 */
function escape($str) {
    global $mysqli;
    return $mysqli->real_escape_string($str);
}

/**
 * Sanitize input
 */
function sanitize($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

/**
 * Send JSON response
 */
function sendJSON($success, $message = '', $data = []) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit();
}

/**
 * Log activity
 */
function logActivity($userId, $action, $tableName, $recordId, $oldValues = null, $newValues = null) {
    global $mysqli;
    
    $ipAddress = $_SERVER['REMOTE_ADDR'] ?? '';
    $oldJson = $oldValues ? json_encode($oldValues) : null;
    $newJson = $newValues ? json_encode($newValues) : null;
    
    $stmt = $mysqli->prepare(
        "INSERT INTO activity_logs (user_id, action, table_name, record_id, old_values, new_values, ip_address) 
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    
    $stmt->bind_param('issssss', $userId, $action, $tableName, $recordId, $oldJson, $newJson, $ipAddress);
    $stmt->execute();
}

?>

