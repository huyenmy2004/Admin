<?php
require_once "../connect-db.php";

class Account extends Connection {
    public function getData() {
        $sql = "SELECT c.cusId, a.username, a.role
                FROM customer c
                JOIN account a ON c.userName = a.username
                ORDER BY c.cusId ASC";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }
    public function deleteAccount($cusId) {
        $sql = "DELETE a, c
        FROM account a
        JOIN customer c ON a.username = c.userName
        WHERE c.cusId = :cusId";

        try {
            $stmt = $this->prepareSQL($sql);
            $stmt->bindParam(':cusId', $cusId);
            $stmt->execute();
        } catch (PDOException $e) {
            // Handle the exception if needed
        }
    }
    public function updatePassword($accountId, $newPassword) {
        $sql = "UPDATE account SET password = :newPassword WHERE username = :username";

        try {
            $stmt = $this->prepareSQL($sql);
            $stmt->bindParam(':newPassword', $newPassword);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function addAccount($username, $password) {
        $sql = "INSERT INTO account (username, password) VALUES (:username, :password)";
        
        try {
            $stmt = $this->prepareSQL($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            
            // Thêm tài khoản thành công, bạn có thể thực hiện chuyển hướng hoặc hiển thị thông báo thành công
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function searchBrandByContent($searchKeyword) {
        $sql = "SELECT * FROM account WHERE username LIKE '%{$searchKeyword}%'";
        $select = $this->prepareSQL($sql);
        $select->execute(['searchKeyword' => '%' . $searchKeyword . '%']);
        return $select->fetchAll();
    }
    
}

class Customer extends Connection {
    // ... (other methods)

    public function getData() {
        $sql = "SELECT cusId FROM customer ORDER BY cusId ASC";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }
}
?>