<?php
class NganhHocModel {
    private $conn;
    private $table_name = "nganhhoc";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getNganhHocs() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY MaNganh DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getNganhHocById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaNganh = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function addNganhHoc($tenNganh) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (TenNganh) VALUES (:tenNganh)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':tenNganh', $tenNganh, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false; // Trả về false nếu có lỗi
        }
    }

    public function updateNganhHoc($maNganh, $tenNganh) {
        try {
            $query = "UPDATE nganhhoc SET TenNganh = :tenNganh WHERE MaNganh = :maNganh";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':maNganh', $maNganh, PDO::PARAM_INT);
            $stmt->bindParam(':tenNganh', $tenNganh, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteNganhHoc($maNganh) {
        try {
            $query = "DELETE FROM nganhhoc WHERE MaNganh = :maNganh";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':maNganh', $maNganh, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    
    
}
?>
