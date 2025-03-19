<?php
require_once 'app/models/SinhVienModel.php';
require_once 'app/models/NganhHocModel.php';

class SinhVienController {
    private $sinhVienModel;
    private $nganhHocModel;

    public function __construct($db) {
        $this->sinhVienModel = new SinhVienModel($db);
        $this->nganhHocModel = new NganhHocModel($db);
    }

    public function index() {
        $sinhViens = $this->sinhVienModel->getSinhViens();
        $view = 'app/views/sinhvien/index.php';
        include 'app/views/layout.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maSV = isset($_POST['MaSV']) ? trim($_POST['MaSV']) : null;
            $hoTen = isset($_POST['HoTen']) ? trim($_POST['HoTen']) : null;
            $gioiTinh = isset($_POST['GioiTinh']) ? trim($_POST['GioiTinh']) : null;
            $ngaySinh = isset($_POST['NgaySinh']) ? trim($_POST['NgaySinh']) : null;
            $maNganh = isset($_POST['MaNganh']) ? trim($_POST['MaNganh']) : null;

            // Xử lý ảnh upload
            $hinh = null;
            if (!empty($_FILES['Hinh']['name'])) {
                $targetDir = "uploads/";
                $fileName = time() . "_" . basename($_FILES["Hinh"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

                $allowTypes = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $targetFilePath)) {
                        $hinh = $fileName;
                    } else {
                        $error = "Lỗi khi tải ảnh lên.";
                    }
                } else {
                    $error = "Chỉ chấp nhận file JPG, JPEG, PNG, GIF.";
                }
            }

            if ($maSV && $hoTen && $gioiTinh && $ngaySinh && $maNganh) {
                $result = $this->sinhVienModel->addSinhVien($maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh);
                if ($result) {
                    header('Location: index.php?controller=sinhvien&action=index');
                    exit;
                } else {
                    $error = "Thêm sinh viên thất bại.";
                }
            } else {
                $error = "Vui lòng điền đầy đủ thông tin.";
            }
        }

        $nganhHocs = $this->nganhHocModel->getNganhHocs();
        $view = 'app/views/sinhvien/add.php';
        include 'app/views/layout.php';
    }


    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form và kiểm tra
            $hoTen = isset($_POST['HoTen']) ? trim($_POST['HoTen']) : null;
            $gioiTinh = isset($_POST['GioiTinh']) ? trim($_POST['GioiTinh']) : null;
            $ngaySinh = isset($_POST['NgaySinh']) ? trim($_POST['NgaySinh']) : null;
            $hinh = isset($_POST['Hinh']) ? trim($_POST['Hinh']) : null;
            $maNganh = isset($_POST['MaNganh']) ? trim($_POST['MaNganh']) : null;

            // Kiểm tra dữ liệu đầu vào
            if ($hoTen && $gioiTinh && $ngaySinh && $hinh && $maNganh) {
                $result = $this->sinhVienModel->updateSinhVien($id, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh);

                if ($result === true) {
                    header('Location: index.php?controller=sinhvien&action=index');
                    exit;
                } else {
                    $error = "Cập nhật sinh viên thất bại. Vui lòng thử lại.";
                }
            } else {
                $error = "Vui lòng điền đầy đủ thông tin.";
            }
        }

        // Lấy thông tin sinh viên và danh sách ngành học để hiển thị trong form
        $sinhVien = $this->sinhVienModel->getSinhVienById($id);
        $nganhHocs = $this->nganhHocModel->getNganhHocs();
        $view = 'app/views/sinhvien/edit.php';
        include 'app/views/layout.php';
    }
    public function details($id) {
        $sinhVien = $this->sinhVienModel->getSinhVienById($id);
    
        if ($sinhVien) {
            $view = 'app/views/sinhvien/details.php';
            include 'app/views/layout.php';
        } else {
            echo "<script>alert('Không tìm thấy sinh viên!'); window.location='index.php?controller=sinhvien';</script>";
        }
    }
    
    
   
    public function delete($id) {
        $result = $this->sinhVienModel->deleteSinhVien($id);

        if ($result === true) {
            header('Location: index.php?controller=sinhvien&action=index');
            exit;
        } else {
            $error = "Xóa sinh viên thất bại. Vui lòng thử lại.";
            $sinhViens = $this->sinhVienModel->getSinhViens();
            $view = 'app/views/sinhvien/index.php';
            include 'app/views/layout.php';
        }
    }
}
?>