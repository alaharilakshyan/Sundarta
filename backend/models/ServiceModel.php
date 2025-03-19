<?php
require_once __DIR__ . '/BaseModel.php';

class ServiceModel extends BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'services';
    }

    /**
     * Create a new service
     * 
     * @param int $userId User ID (seller)
     * @param string $name Service name
     * @param string $description Service description
     * @param float $price Service price
     * @param int $category Category ID
     * @param string $images JSON string of image URLs
     * @return int|false Service ID or false on failure
     */
    public function create($userId, $name, $description, $price, $category, $images = '[]') {
        $sql = "INSERT INTO {$this->table} (user_id, name, description, price, category, images) 
                VALUES (?, ?, ?, ?, ?, ?)";
        return $this->insert($sql, [$userId, $name, $description, $price, $category, $images], 'issdis');
    }

    /**
     * Update a service
     * 
     * @param int $id Service ID
     * @param array $data Data to update
     * @return bool True on success, false on failure
     */
    public function update($id, $data) {
        $allowedFields = ['name', 'description', 'price', 'category', 'images'];
        $updates = [];
        $params = [];
        $types = '';

        foreach ($allowedFields as $field) {
            if (isset($data[$field])) {
                $updates[] = "{$field} = ?";
                $params[] = $data[$field];
                
                if ($field === 'price') {
                    $types .= 'd';
                } elseif ($field === 'category') {
                    $types .= 'i';
                } else {
                    $types .= 's';
                }
            }
        }

        if (empty($updates)) {
            return false;
        }

        $sql = "UPDATE {$this->table} SET " . implode(', ', $updates) . " WHERE id = ?";
        $params[] = $id;
        $types .= 'i';

        return $this->updateOrDelete($sql, $params, $types) !== false;
    }

    /**
     * Get services by category
     * 
     * @param int $categoryId Category ID
     * @return array Array of services
     */
    public function getByCategory($categoryId) {
        $sql = "SELECT s.*, COALESCE(r.avg_rating, 0) AS rating 
                FROM {$this->table} s
                LEFT JOIN (
                    SELECT service_id, AVG(rating) as avg_rating 
                    FROM reviews 
                    WHERE service_id IS NOT NULL 
                    GROUP BY service_id
                ) r ON s.id = r.service_id
                WHERE s.category = ?";
        return $this->select($sql, [$categoryId], 'i');
    }

    /**
     * Get services by seller (user)
     * 
     * @param int $userId User ID
     * @return array Array of services
     */
    public function getBySeller($userId) {
        $sql = "SELECT s.*, COALESCE(r.avg_rating, 0) AS rating 
                FROM {$this->table} s
                LEFT JOIN (
                    SELECT service_id, AVG(rating) as avg_rating 
                    FROM reviews 
                    WHERE service_id IS NOT NULL 
                    GROUP BY service_id
                ) r ON s.id = r.service_id
                WHERE s.user_id = ?";
        return $this->select($sql, [$userId], 'i');
    }

    /**
     * Search services by name or description
     * 
     * @param string $query Search query
     * @return array Array of services
     */
    public function search($query) {
        $sql = "SELECT s.*, COALESCE(r.avg_rating, 0) AS rating 
                FROM {$this->table} s
                LEFT JOIN (
                    SELECT service_id, AVG(rating) as avg_rating 
                    FROM reviews 
                    WHERE service_id IS NOT NULL 
                    GROUP BY service_id
                ) r ON s.id = r.service_id
                WHERE s.name LIKE ? OR s.description LIKE ?";
        $searchTerm = "%{$query}%";
        return $this->select($sql, [$searchTerm, $searchTerm], 'ss');
    }

    /**
     * Get featured services (limited number of services)
     * 
     * @param int $limit Number of services to return
     * @return array Array of services
     */
    public function getFeatured($limit = 6) {
        $sql = "SELECT s.*, COALESCE(r.avg_rating, 0) AS rating 
                FROM {$this->table} s
                LEFT JOIN (
                    SELECT service_id, AVG(rating) as avg_rating 
                    FROM reviews 
                    WHERE service_id IS NOT NULL 
                    GROUP BY service_id
                ) r ON s.id = r.service_id
                ORDER BY s.id DESC
                LIMIT ?";
        return $this->select($sql, [$limit], 'i');
    }

    /**
     * Check if a user owns a service
     * 
     * @param int $serviceId Service ID
     * @param int $userId User ID
     * @return bool True if user owns the service, false otherwise
     */
    public function isOwner($serviceId, $userId) {
        $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE id = ? AND user_id = ?";
        $result = $this->select($sql, [$serviceId, $userId], 'ii');
        return ($result[0]['count'] ?? 0) > 0;
    }

    /**
     * Get services with pagination and optional filtering
     * 
     * @param int $page Page number
     * @param int $perPage Items per page
     * @param int|null $categoryId Optional category filter
     * @param int|null $userId Optional seller filter
     * @param string|null $search Optional search term
     * @return array Array with services and pagination info
     */
    public function getWithPagination($page = 1, $perPage = 10, $categoryId = null, $userId = null, $search = null) {
        $offset = ($page - 1) * $perPage;
        $whereClause = [];
        $params = [];
        $types = '';
        
        if ($categoryId !== null) {
            $whereClause[] = "s.category = ?";
            $params[] = $categoryId;
            $types .= 'i';
        }
        
        if ($userId !== null) {
            $whereClause[] = "s.user_id = ?";
            $params[] = $userId;
            $types .= 'i';
        }
        
        if ($search !== null) {
            $whereClause[] = "(s.name LIKE ? OR s.description LIKE ?)";
            $searchTerm = "%{$search}%";
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $types .= 'ss';
        }
        
        // Modified query to use LEFT JOIN with a subquery for ratings
        $sql = "SELECT s.*, u.username as seller_name, COALESCE(r.avg_rating, 0) AS rating
                FROM {$this->table} s
                JOIN users u ON s.user_id = u.id
                LEFT JOIN (
                    SELECT service_id, AVG(rating) as avg_rating 
                    FROM reviews 
                    WHERE service_id IS NOT NULL 
                    GROUP BY service_id
                ) r ON s.id = r.service_id";
                
        $countSql = "SELECT COUNT(*) as count FROM {$this->table} s";
        
        if (!empty($whereClause)) {
            $whereString = implode(' AND ', $whereClause);
            $sql .= " WHERE {$whereString}";
            $countSql .= " WHERE {$whereString}";
        }
        
        $sql .= " ORDER BY s.id DESC LIMIT ? OFFSET ?";
        $params[] = $perPage;
        $params[] = $offset;
        $types .= 'ii';
        
        $services = $this->select($sql, $params, $types);
        
        // Get total count for pagination
        $countResult = $this->select($countSql, array_slice($params, 0, -2), substr($types, 0, -2));
        $totalCount = $countResult[0]['count'] ?? 0;
        $totalPages = ceil($totalCount / $perPage);
        
        return [
            'services' => $services,
            'pagination' => [
                'total' => $totalCount,
                'per_page' => $perPage,
                'current_page' => $page,
                'last_page' => $totalPages,
                'from' => $offset + 1,
                'to' => min($offset + $perPage, $totalCount)
            ]
        ];
    }
} 