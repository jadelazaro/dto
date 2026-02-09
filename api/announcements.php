<?php
/**
 * Announcements API Endpoints
 * Endpoints: /api/announcements.php
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';
require_once 'Auth.php';
require_once 'AnnouncementsCRUD.php';

$auth = new Auth($mysqli);
$announcementsCrud = new AnnouncementsCRUD($mysqli, $auth);

// Get request method
$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? null;

try {
    if ($method === 'GET') {
        if ($action === 'get') {
            // Get single announcement
            $id = $_GET['id'] ?? null;
            if (!$id) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'ID required']);
                exit;
            }
            echo json_encode($announcementsCrud->getById($id));
        } else {
            // Get all announcements
            $status = $_GET['status'] ?? null;
            $limit = $_GET['limit'] ?? 50;
            $offset = $_GET['offset'] ?? 0;
            echo json_encode($announcementsCrud->getAll($status, $limit, $offset));
        }
    } 
    elseif ($method === 'POST') {
        // Create announcement
        $data = json_decode(file_get_contents('php://input'), true);
        
        $title = $data['title'] ?? null;
        $content = $data['content'] ?? null;
        $category = $data['category'] ?? null;
        $status = $data['status'] ?? 'draft';

        if (!$title || !$content) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Title and content are required']);
            exit;
        }

        echo json_encode($announcementsCrud->create($title, $content, $category, $status));
    } 
    elseif ($method === 'PUT') {
        // Update announcement
        $data = json_decode(file_get_contents('php://input'), true);
        
        $id = $data['id'] ?? null;
        if (!$id) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID required']);
            exit;
        }

        $title = $data['title'] ?? null;
        $content = $data['content'] ?? null;
        $category = $data['category'] ?? null;
        $status = $data['status'] ?? null;
        $featured = $data['featured'] ?? null;

        echo json_encode($announcementsCrud->update($id, $title, $content, $category, $status, $featured));
    } 
    elseif ($method === 'DELETE') {
        // Delete announcement
        $data = json_decode(file_get_contents('php://input'), true);
        
        $id = $data['id'] ?? null;
        if (!$id) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID required']);
            exit;
        }

        echo json_encode($announcementsCrud->delete($id));
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
