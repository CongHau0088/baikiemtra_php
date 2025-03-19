<?php
require_once 'app/models/NganhHocModel.php';

class NganhHocController {
    private $nganhHocModel;

    public function __construct($db) {
        $this->nganhHocModel = new NganhHocModel($db);
    }

    public function index() {
        $nganhHocs = $this->nganhHocModel->getNganhHocs();
        $view = 'app/views/nganhhoc/index.php';
        include 'app/views/layout.php';
    }

    public function add() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenNganh = trim($_POST['tenNganh']); 

            if (!empty($tenNganh)) {
                $result = $this->nganhHocModel->addNganhHoc($tenNganh);

                if ($result) {
                    header('Location: index.php?controller=nganhhoc&action=index');
                    exit;
                } else {
                    $error = "Thêm ngành học thất bại. Vui lòng thử lại.";
                }
            } else {
                $error = "Tên ngành học không được để trống.";
            }
        }

        $view = 'app/views/nganhhoc/add.php';
        include 'app/views/layout.php';
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenNganh = isset($_POST['tenNganh']) ? trim($_POST['tenNganh']) : null;
    
            if ($tenNganh) {
                $result = $this->nganhHocModel->updateNganhHoc($id, $tenNganh);
                if ($result) {
                    header('Location: index.php?controller=nganhhoc&action=index');
                    exit;
                } else {
                    $error = "Cập nhật ngành học thất bại. Vui lòng thử lại.";
                }
            } else {
                $error = "Vui lòng nhập tên ngành.";
            }
        }
    
        // Lấy thông tin ngành học để hiển thị trong form
        $nganhHoc = $this->nganhHocModel->getNganhHocById($id);
        $view = 'app/views/nganhhoc/edit.php';
        include 'app/views/layout.php';
    }
    

    public function delete($id) {
        $result = $this->nganhHocModel->deleteNganhHoc($id);
    
        if ($result) {
            header('Location: index.php?controller=nganhhoc&action=index');
            exit;
        } else {
            $error = "Xóa ngành học thất bại. Có thể ngành học đang được sử dụng.";
        }
    
        $nganhHocs = $this->nganhHocModel->getNganhHocs();
        $view = 'app/views/nganhhoc/index.php';
        include 'app/views/layout.php';
    }
}    
?>
