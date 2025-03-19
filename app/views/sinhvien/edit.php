<?php
// Khởi tạo Database và Model
require_once 'app/config/database.php';
require_once 'app/models/SinhVienModel.php';
require_once 'app/models/NganhHocModel.php';

$db = (new Database())->getConnection();
$sinhVienModel = new SinhVienModel($db);
$nganhHocModel = new NganhHocModel($db);

// Kiểm tra ID sinh viên
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("❌ Không tìm thấy sinh viên!");
}

$id = $_GET['id'];
$sinhVien = $sinhVienModel->getSinhVienById($id);
$nganhHocs = $nganhHocModel->getNganhHocs();

if (!$sinhVien) {
    die("❌ Sinh viên không tồn tại!");
}

// Xử lý cập nhật
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoTen = $_POST['hoTen'];
    $gioiTinh = $_POST['gioiTinh'];
    $ngaySinh = $_POST['ngaySinh'];
    $maNganh = $_POST['maNganh'];
    
    // Xử lý ảnh
    $hinh = $sinhVien->Hinh;
    if (!empty($_FILES['hinh']['name'])) {
        $targetDir = "uploads/";
        $fileName = time() . "_" . basename($_FILES["hinh"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $targetFilePath)) {
                $hinh = $fileName;
            }
        }
    }

    if ($sinhVienModel->updateSinhVien($id, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh)) {
        header("Location: index.php?controller=sinhvien&action=index");
        exit();
    } else {
        $error = "❌ Cập nhật thất bại!";
    }
}
?>

<h2 class="mb-4">✏️ Chỉnh Sửa Sinh Viên</h2>
<div class="card shadow p-4">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger text-center">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    <form action="index.php?controller=sinhvien&action=edit&id=<?php echo htmlspecialchars($sinhVien->MaSV); ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">📛 Mã Sinh Viên:</label>
            <input type="text" name="maSV" class="form-control" value="<?php echo htmlspecialchars($sinhVien->MaSV); ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">📝 Họ Tên:</label>
            <input type="text" name="hoTen" class="form-control" value="<?php echo htmlspecialchars($sinhVien->HoTen); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">⚧️ Giới Tính:</label>
            <select name="gioiTinh" class="form-select" required>
                <option value="Nam" <?php echo ($sinhVien->GioiTinh == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                <option value="Nữ" <?php echo ($sinhVien->GioiTinh == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">📅 Ngày Sinh:</label>
            <input type="date" name="ngaySinh" class="form-control" value="<?php echo htmlspecialchars($sinhVien->NgaySinh); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">🖼️ Hình Ảnh:</label>
            <input type="file" name="hinh" class="form-control">
            <?php if (!empty($sinhVien->Hinh) && file_exists("uploads/" . $sinhVien->Hinh)): ?>
                <img src="uploads/<?php echo htmlspecialchars($sinhVien->Hinh); ?>" alt="Ảnh Sinh Viên" class="mt-2" width="100">
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">📂 Ngành Học:</label>
            <select name="maNganh" class="form-select" required>
                <option value="">-- Chọn Ngành Học --</option>
                <?php foreach ($nganhHocs as $nganhHoc): ?>
                    <option value="<?php echo htmlspecialchars($nganhHoc->MaNganh); ?>" <?php echo ($nganhHoc->MaNganh == $sinhVien->MaNganh) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($nganhHoc->TenNganh); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">✅ Cập Nhật Sinh Viên</button>
            <a href="index.php?controller=sinhvien&action=index" class="btn btn-secondary">🔙 Quay Lại</a>
        </div>
    </form>
</div>
