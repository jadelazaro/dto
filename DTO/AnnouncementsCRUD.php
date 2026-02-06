<?php
/**
 * Announcements CRUD Class
 * Handles Create, Read, Update, Delete operations for announcements
 * Only admin can access these functions
 */

class AnnouncementsCRUD {
    private $mysqli;
    private $auth;

    public function __construct($mysqli, $auth) {
        $this->mysqli = $mysqli;
        $this->auth = $auth;
    }

    /**
     * CREATE - Add new announcement
     */
    public function create($title, $content, $category, $status = 'draft') {
        $this->auth->requireAdmin();

        $user_id = $this->auth->getUserId();

        $stmt = $this->mysqli->prepare(
            "INSERT INTO announcements (title, content, category, status, created_by) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssssi", $title, $content, $category, $status, $user_id);

        if ($stmt->execute()) {
            $this->logActivity('CREATE', 'announcements', $stmt->insert_id, null, compact('title', 'content', 'category', 'status'));
            return [
                'success' => true,
                'message' => 'Announcement created successfully',
                'id' => $stmt->insert_id
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error creating announcement: ' . $stmt->error
            ];
        }
    }

    /**
     * READ - Get all announcements (with filtering)
     */
    public function getAll($status = null, $limit = 50, $offset = 0) {
        $query = "SELECT id, title, content, category, status, featured, created_at, published_at FROM announcements WHERE 1=1";
        $params = [];
        $types = "";

        if ($status) {
            $query .= " AND status = ?";
            $params[] = $status;
            $types .= "s";
        }

        $query .= " ORDER BY created_at DESC LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
        $types .= "ii";

        $stmt = $this->mysqli->prepare($query);
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $announcements = [];
        while ($row = $result->fetch_assoc()) {
            $announcements[] = $row;
        }

        return [
            'success' => true,
            'data' => $announcements,
            'count' => count($announcements)
        ];
    }

    /**
     * READ - Get single announcement by ID
     */
    public function getById($id) {
        $stmt = $this->mysqli->prepare(
            "SELECT id, title, content, category, status, featured, created_at, published_at FROM announcements WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return [
                'success' => false,
                'message' => 'Announcement not found'
            ];
        }

        return [
            'success' => true,
            'data' => $result->fetch_assoc()
        ];
    }

    /**
     * UPDATE - Update announcement
     */
    public function update($id, $title = null, $content = null, $category = null, $status = null, $featured = null) {
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
        if ($content !== null) {
            $updates[] = "content = ?";
            $params[] = $content;
            $types .= "s";
            $newData['content'] = $content;
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
        if ($featured !== null) {
            $updates[] = "featured = ?";
            $params[] = $featured;
            $types .= "i";
            $newData['featured'] = $featured;
        }

        if (empty($updates)) {
            return [
                'success' => false,
                'message' => 'No fields to update'
            ];
        }

        $query = "UPDATE announcements SET " . implode(", ", $updates) . " WHERE id = ?";
        $params[] = $id;
        $types .= "i";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            $this->logActivity('UPDATE', 'announcements', $id, $oldData['data'], $newData);
            return [
                'success' => true,
                'message' => 'Announcement updated successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error updating announcement: ' . $stmt->error
            ];
        }
    }

    /**
     * DELETE - Delete announcement
     */
    public function delete($id) {
        $this->auth->requireAdmin();

        // Get data for audit log
        $data = $this->getById($id);
        if (!$data['success']) {
            return $data;
        }

        $stmt = $this->mysqli->prepare("DELETE FROM announcements WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $this->logActivity('DELETE', 'announcements', $id, $data['data'], null);
            return [
                'success' => true,
                'message' => 'Announcement deleted successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error deleting announcement: ' . $stmt->error
            ];
        }
    }

    /**
     * Publish announcement (change status to active and set published_at)
     */
    public function publish($id) {
        $this->auth->requireAdmin();

        $now = date('Y-m-d H:i:s');
        $stmt = $this->mysqli->prepare(
            "UPDATE announcements SET status = 'active', published_at = ? WHERE id = ?"
        );
        $stmt->bind_param("si", $now, $id);

        if ($stmt->execute()) {
            $this->logActivity('PUBLISH', 'announcements', $id, null, ['status' => 'active']);
            return [
                'success' => true,
                'message' => 'Announcement published successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error publishing announcement: ' . $stmt->error
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
