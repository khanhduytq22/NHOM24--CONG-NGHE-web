<?php
require_once __DIR__ . '/../libs/DBConnection.php';

class User {
    public function validateLogin($username, $password) {
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        if ($conn === null) {
            throw new Exception("Kết nối cơ sở dữ liệu thất bại.");
        }

        try {
            session_start();
            
            $sql = "SELECT id, username, role FROM users WHERE username = :username AND password = :password";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                return ['success' => true, 'role' => $user['role']];
            }

            return ['success' => false, 'role' => null];

        } catch (PDOException $e) {
            throw new Exception("Lỗi khi truy vấn cơ sở dữ liệu: " . $e->getMessage());
        }
    }
}
