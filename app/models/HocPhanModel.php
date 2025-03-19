<?php
class HocPhanModel {
    private $conn;
    private $table_name = "hocphan";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy danh sách học phần
    public function getHocPhans() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY MaHP ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Lấy thông tin học phần theo mã
    public function getHocPhanById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaHP = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Đăng ký học phần cho sinh viên
    public function dangKyHocPhan($maSV, $maHP) {
        $query = "INSERT INTO dangkyhocphan (MaSV, MaHocPhan) VALUES (:MaSV, :MaHP)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":MaSV", $maSV);
        $stmt->bindParam(":MaHP", $maHP);
        return $stmt->execute();
    }
    
}
?>
