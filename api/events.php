<?php
/**
 * Calendar Events API Endpoints
 * Endpoints: /api/events.php
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config.php';
require_once '../Auth.php';
require_once '../CalendarEventsCRUD.php';

$auth = new Auth($mysqli);
$eventsCrud = new CalendarEventsCRUD($mysqli, $auth);

// Get request method
$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? null;

try {
    if ($method === 'GET') {
        if ($action === 'get') {
            // Get single event
            $id = $_GET['id'] ?? null;
            if (!$id) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'ID required']);
                exit;
            }
            echo json_encode($eventsCrud->getById($id));
        } 
        elseif ($action === 'month') {
            // Get events by month
            $year = $_GET['year'] ?? date('Y');
            $month = $_GET['month'] ?? date('m');
            echo json_encode($eventsCrud->getByMonth($year, $month));
        }
        else {
            // Get all events
            $status = $_GET['status'] ?? null;
            $startDate = $_GET['startDate'] ?? null;
            $endDate = $_GET['endDate'] ?? null;
            $limit = $_GET['limit'] ?? 100;
            $offset = $_GET['offset'] ?? 0;
            echo json_encode($eventsCrud->getAll($status, $startDate, $endDate, $limit, $offset));
        }
    } 
    elseif ($method === 'POST') {
        // Create event
        $data = json_decode(file_get_contents('php://input'), true);
        
        $title = $data['title'] ?? null;
        $event_date = $data['event_date'] ?? null;
        $description = $data['description'] ?? null;
        $event_time = $data['event_time'] ?? null;
        $end_time = $data['end_time'] ?? null;
        $location = $data['location'] ?? null;
        $category = $data['category'] ?? null;

        if (!$title || !$event_date) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Title and event_date are required']);
            exit;
        }

        echo json_encode($eventsCrud->create($title, $event_date, $description, $event_time, $end_time, $location, $category));
    } 
    elseif ($method === 'PUT') {
        // Update event
        $data = json_decode(file_get_contents('php://input'), true);
        
        $id = $data['id'] ?? null;
        if (!$id) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID required']);
            exit;
        }

        $title = $data['title'] ?? null;
        $event_date = $data['event_date'] ?? null;
        $description = $data['description'] ?? null;
        $event_time = $data['event_time'] ?? null;
        $end_time = $data['end_time'] ?? null;
        $location = $data['location'] ?? null;
        $category = $data['category'] ?? null;
        $status = $data['status'] ?? null;

        echo json_encode($eventsCrud->update($id, $title, $event_date, $description, $event_time, $end_time, $location, $category, $status));
    } 
    elseif ($method === 'DELETE') {
        // Delete event
        $data = json_decode(file_get_contents('php://input'), true);
        
        $id = $data['id'] ?? null;
        if (!$id) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID required']);
            exit;
        }

        echo json_encode($eventsCrud->delete($id));
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
