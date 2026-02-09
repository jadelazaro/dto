<?php
/**
 * News API Endpoints
 * Endpoints: /api/news.php
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config.php';
require_once '../Auth.php';
require_once '../NewsCRUD.php';

$auth = new Auth($mysqli);
$newsCrud = new NewsCRUD($mysqli, $auth);

// Get request method
$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? null;

try {
    if ($method === 'GET') {
        if ($action === 'get') {
            // Get single news article
            $id = $_GET['id'] ?? null;
            if (!$id) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'ID required']);
                exit;
            }
            echo json_encode($newsCrud->getById($id));
        } else {
            // Get all news articles
            $status = $_GET['status'] ?? null;
            $limit = $_GET['limit'] ?? 50;
            $offset = $_GET['offset'] ?? 0;
            echo json_encode($newsCrud->getAll($status, $limit, $offset));
        }
    } 
    elseif ($method === 'POST') {
        // Create news article
        $data = json_decode(file_get_contents('php://input'), true);
        
        $title = $data['title'] ?? null;
        $content = $data['content'] ?? null;
        $summary = $data['summary'] ?? null;
        $category = $data['category'] ?? null;
        $author = $data['author'] ?? null;
        $status = $data['status'] ?? 'draft';

        if (!$title || !$content) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Title and content are required']);
            exit;
        }

        echo json_encode($newsCrud->create($title, $content, $summary, $category, $author, $status));
    } 
    elseif ($method === 'PUT') {
        // Update news article
        $data = json_decode(file_get_contents('php://input'), true);
        
        $id = $data['id'] ?? null;
        if (!$id) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID required']);
            exit;
        }

        $title = $data['title'] ?? null;
        $content = $data['content'] ?? null;
        $summary = $data['summary'] ?? null;
        $category = $data['category'] ?? null;
        $author = $data['author'] ?? null;
        $status = $data['status'] ?? null;
        $featured = $data['featured'] ?? null;
        $featured_image = $data['featured_image'] ?? null;

        echo json_encode($newsCrud->update($id, $title, $content, $summary, $category, $author, $status, $featured, $featured_image));
    } 
    elseif ($method === 'DELETE') {
        // Delete news article
        $data = json_decode(file_get_contents('php://input'), true);
        
        $id = $data['id'] ?? null;
        if (!$id) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID required']);
            exit;
        }

        echo json_encode($newsCrud->delete($id));
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
