<?php
    require_once __DIR__ . '/../libs/DBConnection.php';

    class News {
        public function getAllNews() {
            $dbConnection = new DBConnection();
            $conn = $dbConnection->getConnection();

            if ($conn === null) {
                throw new Exception("Kết nối cơ sở dữ liệu thất bại.");
            }

            try {
                $sql = "SELECT id, title, content, image, DATE(created_at) AS created_at, category_id FROM news";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Lỗi khi truy vấn cơ sở dữ liệu: " . $e->getMessage());
            }
        }

        public function getNewsById($id) {
            $dbConnection = new DBConnection();
            $conn = $dbConnection->getConnection();
    
            if ($conn === null) {
                throw new Exception("Kết nối cơ sở dữ liệu thất bại.");
            }
    
            try {
                $sql = "SELECT id, title, content, image, DATE(created_at) AS created_at, category_id FROM news WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
    
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Lỗi khi truy vấn cơ sở dữ liệu: " . $e->getMessage());
            }
        }

        public function addNews($title, $content, $image, $created_date, $category_id) {
            $dbConnection = new DBConnection();
            $conn = $dbConnection->getConnection();

            if ($conn === null) {
                throw new Exception("Kết nối cơ sở dữ liệu thất bại.");
            }

            try {
                $sql = "INSERT INTO news (title, content, image, created_at, category_id) VALUES (:title, :content, :image, :created_at, :category_id)";
                $stmt = $conn->prepare($sql);
                
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':content', $content);
                $stmt->bindParam(':image', $image);

                if ($image === '') {
                    $stmt->bindValue(':image', null, PDO::PARAM_NULL);
                } else {
                    $stmt->bindParam(':image', $image);
                }

                if ($created_date === '') {
                    $stmt->bindValue(':created_at', null, PDO::PARAM_NULL);
                } else {
                    $stmt->bindParam(':created_at', $created_date);
                }

                if ($category_id === null) {
                    $stmt->bindValue(':category_id', null, PDO::PARAM_NULL);
                } else {
                    $stmt->bindParam(':category_id', $category_id);
                }

                $stmt->execute();
            } catch (PDOException $e) {
                throw new Exception("Lỗi khi thêm sản phẩm: " . $e->getMessage());
            }
        }

        public function updateNews($id, $title, $content, $dateCreated, $categoryId, $image = null) {
            $dbConnection = new DBConnection();
            $conn = $dbConnection->getConnection();
            if ($conn === null) {
                throw new Exception("Kết nối cơ sở dữ liệu thất bại.");
            }
        
            $sql = "UPDATE news SET title = ?, content = ?, created_at = ?, category_id = ?" . 
                   ($image ? ", image = ?" : "") . " WHERE id = ?";
            
            
            $params = [$title, $content, $dateCreated, $categoryId];
            if ($image) {
                $params[] = $image; 
            }
            $params[] = $id; 
        
            
            $stmt = $conn->prepare($sql);
            if ($stmt->execute($params)) {
                return true; 
            } else {
                return false;
            }
        }

        public function deleteNews($id) {
            $dbConnection = new DBConnection();
            $conn = $dbConnection->getConnection();
        
            if ($conn === null) {
                throw new Exception("Kết nối cơ sở dữ liệu thất bại.");
            }
        
            try {
                $sql = "DELETE FROM news WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
            } catch (PDOException $e) {
                throw new Exception("Lỗi khi xóa bản ghi: " . $e->getMessage());
            }
        }

        public function searchNews($query) {
            $dbConnection = new DBConnection();
            $conn = $dbConnection->getConnection();
        
            if ($conn === null) {
                throw new Exception("Kết nối cơ sở dữ liệu thất bại.");
            }
        
            try {
                $sql = "SELECT id, title, content, image, created_at, category_id 
                        FROM news 
                        WHERE title LIKE :query OR content LIKE :query";
                $stmt = $conn->prepare($sql);
                $searchQuery = '%' . $query . '%';
                $stmt->bindParam(':query', $searchQuery, PDO::PARAM_STR);
                $stmt->execute();
        
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Lỗi khi tìm kiếm dữ liệu: " . $e->getMessage());
            }
        }
    }
?>