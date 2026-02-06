<?php
/**
 * Calendar Events CRUD Class
 * Handles Create, Read, Update, Delete operations for calendar events
 * Only admin can access these functions
 */

class CalendarEventsCRUD {
    private $mysqli;
    private $auth;

    public function __construct($mysqli, $auth) {
        $this->mysqli = $mysqli;
        $this->auth = $auth;
    }

    /**
     * CREATE - Add new calendar event
     */
    public function create($title, $event_date, $description = null, $event_time = null, $end_time = null, $location = null, $category = null) {
        $this->auth->requireAdmin();

        $user_id = $this->auth->getUserId();
        $status = 'scheduled';

        $stmt = $this->mysqli->prepare(
            "INSERT INTO calendar_events (title, description, event_date, event_time, end_time, location, category, status, created_by) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssssssssi", $title, $description, $event_date, $event_time, $end_time, $location, $category, $status, $user_id);

        if ($stmt->execute()) {
            $this->logActivity('CREATE', 'calendar_events', $stmt->insert_id, null, compact('title', 'event_date', 'description', 'event_time', 'end_time', 'location', 'category'));
            return [
                'success' => true,
                'message' => 'Calendar event created successfully',
                'id' => $stmt->insert_id
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error creating calendar event: ' . $stmt->error
            ];
        }
    }

    /**
     * READ - Get all calendar events (with filtering)
     */
    public function getAll($status = null, $startDate = null, $endDate = null, $limit = 100, $offset = 0) {
        $query = "SELECT id, title, description, event_date, event_time, end_time, location, category, status, created_at FROM calendar_events WHERE 1=1";
        $params = [];
        $types = "";

        if ($status) {
            $query .= " AND status = ?";
            $params[] = $status;
            $types .= "s";
        }

        if ($startDate) {
            $query .= " AND event_date >= ?";
            $params[] = $startDate;
            $types .= "s";
        }

        if ($endDate) {
            $query .= " AND event_date <= ?";
            $params[] = $endDate;
            $types .= "s";
        }

        $query .= " ORDER BY event_date ASC LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
        $types .= "ii";

        $stmt = $this->mysqli->prepare($query);
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $events = [];
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }

        return [
            'success' => true,
            'data' => $events,
            'count' => count($events)
        ];
    }

    /**
     * READ - Get events by month
     */
    public function getByMonth($year, $month) {
        $startDate = sprintf("%04d-%02d-01", $year, $month);
        $endDate = date('Y-m-t', strtotime($startDate));

        return $this->getAll(null, $startDate, $endDate, 100, 0);
    }

    /**
     * READ - Get single event by ID
     */
    public function getById($id) {
        $stmt = $this->mysqli->prepare(
            "SELECT id, title, description, event_date, event_time, end_time, location, category, status, created_at FROM calendar_events WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return [
                'success' => false,
                'message' => 'Calendar event not found'
            ];
        }

        return [
            'success' => true,
            'data' => $result->fetch_assoc()
        ];
    }

    /**
     * UPDATE - Update calendar event
     */
    public function update($id, $title = null, $event_date = null, $description = null, $event_time = null, $end_time = null, $location = null, $category = null, $status = null) {
        $this->auth->requireAdmin();

        // Get old values for audit log
        $oldData = $this->getById($id);
        if (!$oldData['success']) {
            return $oldData;
        }

        $updates = [];
        $params = [];
        $types = "";
        $newData = [];

        if ($title !== null) {
            $updates[] = "title = ?";
            $params[] = $title;
            $types .= "s";
            $newData['title'] = $title;
        }
        if ($event_date !== null) {
            $updates[] = "event_date = ?";
            $params[] = $event_date;
            $types .= "s";
            $newData['event_date'] = $event_date;
        }
        if ($description !== null) {
            $updates[] = "description = ?";
            $params[] = $description;
            $types .= "s";
            $newData['description'] = $description;
        }
        if ($event_time !== null) {
            $updates[] = "event_time = ?";
            $params[] = $event_time;
            $types .= "s";
            $newData['event_time'] = $event_time;
        }
        if ($end_time !== null) {
            $updates[] = "end_time = ?";
            $params[] = $end_time;
            $types .= "s";
            $newData['end_time'] = $end_time;
        }
        if ($location !== null) {
            $updates[] = "location = ?";
            $params[] = $location;
            $types .= "s";
            $newData['location'] = $location;
        }
        if ($category !== null) {
            $updates[] = "category = ?";
            $params[] = $category;
            $types .= "s";
            $newData['category'] = $category;
        }
        if ($status !== null) {
            $updates[] = "status = ?";
            $params[] = $status;
            $types .= "s";
            $newData['status'] = $status;
        }

        if (empty($updates)) {
            return [
                'success' => false,
                'message' => 'No fields to update'
            ];
        }

        $query = "UPDATE calendar_events SET " . implode(", ", $updates) . " WHERE id = ?";
        $params[] = $id;
        $types .= "i";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            $this->logActivity('UPDATE', 'calendar_events', $id, $oldData['data'], $newData);
            return [
                'success' => true,
                'message' => 'Calendar event updated successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error updating calendar event: ' . $stmt->error
            ];
        }
    }

    /**
     * DELETE - Delete calendar event
     */
    public function delete($id) {
        $this->auth->requireAdmin();

        // Get data for audit log
        $data = $this->getById($id);
        if (!$data['success']) {
            return $data;
        }

        $stmt = $this->mysqli->prepare("DELETE FROM calendar_events WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $this->logActivity('DELETE', 'calendar_events', $id, $data['data'], null);
            return [
                'success' => true,
                'message' => 'Calendar event deleted successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error deleting calendar event: ' . $stmt->error
            ];
        }
    }

    /**
     * Log activity for audit trail
     */
    private function logActivity($action, $table, $recordId, $oldValues, $newValues) {
        $userId = $this->auth->getUserId();
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $oldJson = json_encode($oldValues);
        $newJson = json_encode($newValues);

        $stmt = $this->mysqli->prepare(
            "INSERT INTO activity_logs (user_id, action, table_name, record_id, old_values, new_values, ip_address) 
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("issiiss", $userId, $action, $table, $recordId, $oldJson, $newJson, $ipAddress);
        $stmt->execute();
    }
}

?>
