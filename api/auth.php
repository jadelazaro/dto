<?php
/**
 * Authentication API Endpoints
 * Endpoints: /api/auth.php
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config.php';
require_once '../Auth.php';

$auth = new Auth($mysqli);

// Get request method
$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? null;

try {
    if ($method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        if ($action === 'login') {
            $username = $data['username'] ?? null;
            $password = $data['password'] ?? null;

            if (!$username || !$password) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Username and password required']);
                exit;
            }

            echo json_encode($auth->login($username, $password));
        } 
        elseif ($action === 'logout') {
            echo json_encode($auth->logout());
        }
        elseif ($action === 'create_admin') {
            $username = $data['username'] ?? null;
            $email = $data['email'] ?? null;
            $password = $data['password'] ?? null;

            if (!$username || !$email || !$password) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Username, email, and password required']);
                exit;
            }

            echo json_encode($auth->createAdmin($username, $email, $password));
        }
        else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
        }
    } 
    elseif ($method === 'GET') {
        if ($action === 'status') {
            // Check user login status
            if ($auth->isLoggedIn()) {
                echo json_encode([
                    'success' => true,
                    'isLoggedIn' => true,
                    'isAdmin' => $auth->isAdmin(),
                    'user' => $auth->getUserInfo()
                ]);
            } else {
                echo json_encode([
                    'success' => true,
                    'isLoggedIn' => false,
                    'isAdmin' => false
                ]);
            }
        }
        else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
        }
    }
    else {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error: ' . $e->getMessage()
    ]);
}

?>
