<?php
/**
 * Authentication Class
 * Handles user login, logout, session management, and authorization
 */

// Prevent direct access
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
    die('Direct access not allowed.');
}

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Auth {
    private $mysqli;
    private $loginAttempts = [];
    
    public function __construct($mysqli) {
        if (!$mysqli) {
            throw new Exception('Database connection required');
        }
        $this->mysqli = $mysqli;
    }

    /**
     * Authenticate user with username and password
     * @param string $username
     * @param string $password
     * @return array Result array with success, message, and user data
     */
    public function login($username, $password) {
        // Input validation
        if (empty($username) || empty($password)) {
            return [
                'success' => false,
                'message' => 'Username and password are required'
            ];
        }

        // Check for brute force attempts
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? '';
        if ($this->isLockedOut($ipAddress)) {
            return [
                'success' => false,
                'message' => 'Too many login attempts. Please try again later.'
            ];
        }

        // Fetch user from database
        $stmt = $this->mysqli->prepare(
            "SELECT id, username, email, password_hash, role, is_active, created_at 
             FROM users WHERE username = ? LIMIT 1"
        );
        
        if (!$stmt) {
            return [
                'success' => false,
                'message' => 'Database error: ' . $this->mysqli->error
            ];
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $this->recordFailedAttempt($ipAddress);
            return [
                'success' => false,
                'message' => 'Username or password incorrect'
            ];
        }

        $user = $result->fetch_assoc();
        $stmt->close();

        // Check if account is active
        if (!$user['is_active']) {
            $this->recordFailedAttempt($ipAddress);
            return [
                'success' => false,
                'message' => 'User account is inactive. Please contact administrator.'
            ];
        }

        // Verify password
        if (!password_verify($password, $user['password_hash'])) {
            $this->recordFailedAttempt($ipAddress);
            return [
                'success' => false,
                'message' => 'Username or password incorrect'
            ];
        }

        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['login_time'] = time();
        $_SESSION['ip_address'] = $ipAddress;

        // Log successful login
        $this->logActivity(
            $user['id'],
            'LOGIN',
            'users',
            $user['id'],
            null,
            ['username' => $user['username'], 'role' => $user['role']]
        );

        return [
            'success' => true,
            'message' => 'Login successful',
            'user' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role']
            ]
        ];
    }

    /**
     * Logout user and destroy session
     * @return array Result array
     */
    public function logout() {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            
            // Log logout activity
            $this->logActivity($userId, 'LOGOUT', 'users', $userId);
            
            // Destroy session
            session_destroy();
        }

        return [
            'success' => true,
            'message' => 'Logged out successfully'
        ];
    }

    /**
     * Check if user is currently logged in
     * @return bool
     */
    public function isLoggedIn() {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }

    /**
     * Check if current user is admin
     * @return bool
     */
    public function isAdmin() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }

    /**
     * Get current user ID
     * @return int|null
     */
    public function getUserId() {
        return $_SESSION['user_id'] ?? null;
    }

    /**
     * Get current user information
     * @return array|null
     */
    public function getUserInfo() {
        if (!$this->isLoggedIn()) {
            return null;
        }
        
        return [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'email' => $_SESSION['email'] ?? '',
            'role' => $_SESSION['role'],
            'login_time' => $_SESSION['login_time'] ?? null
        ];
    }

    /**
     * Require admin access - die if not admin
     * @return void
     */
    public function requireAdmin() {
        if (!$this->isLoggedIn() || !$this->isAdmin()) {
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Access denied. Admin privileges required.'
            ]);
            exit();
        }
    }

    /**
     * Create new admin user
     * @param string $username
     * @param string $email
     * @param string $password
     * @return array Result array
     */
    public function createAdmin($username, $email, $password) {
        // Only allow current admin to create new admins
        if (!$this->isAdmin()) {
            return [
                'success' => false,
                'message' => 'Unauthorized. Admin privileges required.'
            ];
        }

        // Validate inputs
        if (empty($username) || empty($email) || empty($password)) {
            return [
                'success' => false,
                'message' => 'All fields are required'
            ];
        }

        if (strlen($password) < 6) {
            return [
                'success' => false,
                'message' => 'Password must be at least 6 characters'
            ];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [
                'success' => false,
                'message' => 'Invalid email address'
            ];
        }

        // Hash password using bcrypt
        $password_hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        
        // Insert user
        $stmt = $this->mysqli->prepare(
            "INSERT INTO users (username, email, password_hash, role, is_active) 
             VALUES (?, ?, ?, 'admin', TRUE)"
        );

        if (!$stmt) {
            return [
                'success' => false,
                'message' => 'Database error: ' . $this->mysqli->error
            ];
        }

        $stmt->bind_param("sss", $username, $email, $password_hash);

        if ($stmt->execute()) {
            $userId = $stmt->insert_id;
            $stmt->close();
            
            // Log activity
            $this->logActivity(
                $_SESSION['user_id'],
                'CREATE_USER',
                'users',
                $userId,
                null,
                ['username' => $username, 'email' => $email, 'role' => 'admin']
            );

            return [
                'success' => true,
                'message' => 'Admin user created successfully',
                'user_id' => $userId
            ];
        } else {
            $error = $stmt->error;
            $stmt->close();
            
            // Check for duplicate username/email
            if (strpos($error, 'Duplicate') !== false) {
                return [
                    'success' => false,
                    'message' => 'Username or email already exists'
                ];
            }

            return [
                'success' => false,
                'message' => 'Error creating user: ' . $error
            ];
        }
    }

    /**
     * Check if IP is locked out due to too many failed attempts
     * @param string $ipAddress
     * @return bool
     */
    private function isLockedOut($ipAddress) {
        // Store in session for simplicity (in production, use database)
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = [];
        }

        if (isset($_SESSION['login_attempts'][$ipAddress])) {
            $attempts = $_SESSION['login_attempts'][$ipAddress];
            if ($attempts['count'] >= MAX_LOGIN_ATTEMPTS) {
                $timeSinceLast = time() - $attempts['last_attempt'];
                if ($timeSinceLast < LOCKOUT_TIME) {
                    return true;
                } else {
                    // Reset attempts
                    unset($_SESSION['login_attempts'][$ipAddress]);
                }
            }
        }
        
        return false;
    }

    /**
     * Record failed login attempt
     * @param string $ipAddress
     */
    private function recordFailedAttempt($ipAddress) {
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = [];
        }

        if (!isset($_SESSION['login_attempts'][$ipAddress])) {
            $_SESSION['login_attempts'][$ipAddress] = [
                'count' => 0,
                'last_attempt' => time()
            ];
        }

        $_SESSION['login_attempts'][$ipAddress]['count']++;
        $_SESSION['login_attempts'][$ipAddress]['last_attempt'] = time();
    }

    /**
     * Log activity for audit trail
     * @param int $userId
     * @param string $action
     * @param string $tableName
     * @param int $recordId
     * @param array|null $oldValues
     * @param array|null $newValues
     */
    private function logActivity($userId, $action, $tableName, $recordId, $oldValues = null, $newValues = null) {
        try {
            $ipAddress = $_SERVER['REMOTE_ADDR'] ?? '';
            $oldJson = $oldValues ? json_encode($oldValues) : null;
            $newJson = $newValues ? json_encode($newValues) : null;

            $stmt = $this->mysqli->prepare(
                "INSERT INTO activity_logs (user_id, action, table_name, record_id, old_values, new_values, ip_address) 
                 VALUES (?, ?, ?, ?, ?, ?, ?)"
            );

            $stmt->bind_param('issssss', $userId, $action, $tableName, $recordId, $oldJson, $newJson, $ipAddress);
            $stmt->execute();
            $stmt->close();
        } catch (Exception $e) {
            // Silently fail - don't break main functionality
            error_log('Activity logging error: ' . $e->getMessage());
        }
    }
}

?>

