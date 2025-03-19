<?php
require_once 'app/models/HocPhanModel.php';

class HocPhanController {
    private $hocPhanModel;

    public function __construct($db) {
        $this->hocPhanModel = new HocPhanModel($db);
    }

    // Hiển thị danh sách học phần
    public function index() {
        $hocPhans = $this->hocPhanModel->getHocPhans();
        $view = 'app/views/hocphan/index.php';
        include 'app/views/layout.php';
    }

    // Xử lý đăng ký học phần
    public function dangKy() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maSV = isset($_POST['MaSV']) ? trim($_POST['MaSV']) : null;
            $maHP = isset($_POST['MaHP']) ? trim($_POST['MaHP']) : null;

            if ($maSV && $maHP) {
                $result = $this->hocPhanModel->dangKyHocPhan($maSV, $maHP);
                if ($result) {
                    header('Location: index.php?controller=hocphan&action=index&success=1');
                    exit;
                } else {
                    $error = "Đăng ký học phần thất bại.";
                }
            } else {
                $error = "Vui lòng điền đầy đủ thông tin.";
            }
        }

        $hocPhans = $this->hocPhanModel->getHocPhans();
        $view = 'app/views/hocphan/dangky.php';
        include 'app/views/layout.php';
    }
}
?>
