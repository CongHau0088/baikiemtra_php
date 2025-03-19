<?php
class SinhVienModel {
    private $conn;
    private $table_name = "sinhvien";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getSinhViens() {
        $query = "SELECT sv.MaSV, sv.HoTen, sv.GioiTinh, sv.NgaySinh, sv.Hinh, nh.TenNganh AS nganh_name
                  FROM " . $this->table_name . " sv
                  LEFT JOIN nganhhoc nh ON sv.MaNganh = nh.MaNganh";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getSinhVienById($id) {
        $query = "SELECT sv.*, nh.TenNganh AS nganh_name 
                  FROM sinhvien sv 
                  JOIN nganhhoc nh ON sv.MaNganh = nh.MaNganh
                  WHERE sv.MaSV = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    public function addSinhVien($maSV, $hoTen, $gioiTinh, $ngaySinh, $file, $maNganh) {
        // Kiểm tra xem có file được tải lên không
        $hinh = "";
        if (!empty($file['name'])) {
            $targetDir = "uploads/"; // Thư mục lưu ảnh
            $fileName = time() . "_" . basename($file["name"]); // Tạo tên file duy nhất
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    
            // Kiểm tra định dạng ảnh hợp lệ
            $allowTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                    $hinh = $fileName; // Lưu tên file vào DB
                }
            }
        }
    
        // Thực hiện câu lệnh INSERT vào DB
        $query = "INSERT INTO sinhvien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                  VALUES (:maSV, :hoTen, :gioiTinh, :ngaySinh, :hinh, :maNganh)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->bindParam(':hoTen', $hoTen);
        $stmt->bindParam(':gioiTinh', $gioiTinh);
        $stmt->bindParam(':ngaySinh', $ngaySinh);
        $stmt->bindParam(':hinh', $hinh);
        $stmt->bindParam(':maNganh', $maNganh);
    
        return $stmt->execute();
    }
    public function getSinhVien() {
        $query = "SELECT sv.MaSV, sv.HoTen, sv.GioiTinh, sv.NgaySinh, sv.Hinh, nh.TenNganh AS nganh_name
                  FROM " . $this->table_name . " sv
                  LEFT JOIN nganhhoc nh ON sv.MaNganh = nh.MaNganh";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateSinhVien($maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh) {
        $query = "UPDATE " . $this->table_name . " SET HoTen = :hoTen, GioiTinh = :gioiTinh, NgaySinh = :ngaySinh, Hinh = :hinh, MaNganh = :maNganh WHERE MaSV = :maSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->bindParam(':hoTen', $hoTen);
        $stmt->bindParam(':gioiTinh', $gioiTinh);
        $stmt->bindParam(':ngaySinh', $ngaySinh);
        $stmt->bindParam(':hinh', $hinh);
        $stmt->bindParam(':maNganh', $maNganh);
        
        return $stmt->execute();
    }

    public function deleteSinhVien($maSV) {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaSV = :maSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':maSV', $maSV);
        return $stmt->execute();
    }
}
?>
