<?php
/**
 * News CRUD Class
 * Handles Create, Read, Update, Delete operations for news
 * Only admin can access these functions
 */

class NewsCRUD {
    private $mysqli;
    private $auth;

    public function __construct($mysqli, $auth) {
        $this->mysqli = $mysqli;
        $this->auth = $auth;
    }

    /**
     * CREATE - Add new news article
     */
    public function create($title, $content, $summary = null, $category = null, $author = null, $status = 'draft') {
        $this->auth->requireAdmin();

        $user_id = $this->auth->getUserId();

        $stmt = $this->mysqli->prepare(
            "INSERT INTO news (title, content, summary, category, author, status, created_by) VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssssssi", $title, $content, $summary, $category, $author, $status, $user_id);

        if ($stmt->execute()) {
            $this->logActivity('CREATE', 'news', $stmt->insert_id, null, compact('title', 'content', 'summary', 'category', 'author', 'status'));
            return [
                'success' => true,
                'message' => 'News article created successfully',
                'id' => $stmt->insert_id
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error creating news article: ' . $stmt->error
            ];
        }
    }

    /**
     * READ - Get all news articles (with filtering)
     */
    public function getAll($status = null, $limit = 50, $offset = 0) {
        $query = "SELECT id, title, content, summary, category, author, featured, status, created_at, published_at FROM news WHERE 1=1";
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

        $news = [];
        while ($row = $result->fetch_assoc()) {
            $news[] = $row;
        }

        return [
            'success' => true,
            'data' => $news,
            'count' => count($news)
        ];
    }

    /**
     * READ - Get single news article by ID
     */
    public function getById($id) {
        $stmt = $this->mysqli->prepare(
            "SELECT id, title, content, summary, category, author, featured_image, featured, status, created_at, published_at FROM news WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return [
                'success' => false,
                'message' => 'News article not found'
            ];
        }

        return [
            'success' => true,
            'data' => $result->fetch_assoc()
        ];
    }

    /**
     * UPDATE - Update news article
     */
    public function update($id, $title = null, $content = null, $summary = null, $category = null, $author = null, $status = null, $featured = null, $featured_image = null) {
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
        if ($summary !== null) {
            $updates[] = "summary = ?";
            $params[] = $summary;
            $types .= "s";
            $newData['summary'] = $summary;
        }
        if ($category !== null) {
            $updates[] = "category = ?";
            $params[] = $category;
            $types .= "s";
            $newData['category'] = $category;
        }
        if ($author !== null) {
            $updates[] = "author = ?";
            $params[] = $author;
            $types .= "s";
            $newData['author'] = $author;
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
        if ($featured_image !== null) {
            $updates[] = "featured_image = ?";
            $params[] = $featured_image;
            $types .= "s";
            $newData['featured_image'] = $featured_image;
        }

        if (empty($updates)) {
            return [
                'success' => false,
                'message' => 'No fields to update'
            ];
        }

        $query = "UPDATE news SET " . implode(", ", $updates) . " WHERE id = ?";
        $params[] = $id;
        $types .= "i";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            $this->logActivity('UPDATE', 'news', $id, $oldData['data'], $newData);
            return [
                'success' => true,
                'message' => 'News article updated successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error updating news article: ' . $stmt->error
            ];
        }
    }

    /**
     * DELETE - Delete news article
     */
    public function delete($id) {
        $this->auth->requireAdmin();

        // Get data for audit log
        $data = $this->getById($id);
        if (!$data['success']) {
            return $data;
        }

        $stmt = $this->mysqli->prepare("DELETE FROM news WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $this->logActivity('DELETE', 'news', $id, $data['data'], null);
            return [
                'success' => true,
                'message' => 'News article deleted successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error deleting news article: ' . $stmt->error
            ];
        }
    }

    /**
     * Publish news article (change status to active and set published_at)
     */
    public function publish($id) {
        $this->auth->requireAdmin();

        $now = date('Y-m-d H:i:s');
        $stmt = $this->mysqli->prepare(
            "UPDATE news SET status = 'active', published_at = ? WHERE id = ?"
        );
        $stmt->bind_param("si", $now, $id);

        if ($stmt->execute()) {
            $this->logActivity('PUBLISH', 'news', $id, null, ['status' => 'active']);
            return [
                'success' => true,
                'message' => 'News article published successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error publishing news article: ' . $stmt->error
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
