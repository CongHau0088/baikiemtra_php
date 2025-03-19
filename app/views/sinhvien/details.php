<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<div class="container mt-4">
    <h2 class="text-center text-primary">Thông Tin Sinh Viên</h2>

    <table class="table table-bordered table-striped text-center align-middle shadow">
        <thead class="table-dark">
            <tr>
                <th>Mã SV</th>
                <th>Họ Tên</th>
                <th>Giới Tính</th>
                <th>Ngày Sinh</th>
                <th>Mã Ngành</th>
                <th>Hình Ảnh</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($sinhVien)): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($sinhVien->MaSV); ?></strong></td>
                    <td><?php echo htmlspecialchars($sinhVien->HoTen); ?></td>
                    <td>
                        <?php if ($sinhVien->GioiTinh == "Nam"): ?>
                            <span class="badge bg-primary">Nam</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Nữ</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo date("d/m/Y", strtotime($sinhVien->NgaySinh)); ?></td>
                    <td><?php echo htmlspecialchars($sinhVien->MaNganh); ?></td>
                    <td>
                        <?php if (!empty($sinhVien->Hinh)): ?>
                            <img src="uploads/<?php echo htmlspecialchars($sinhVien->Hinh); ?>" 
                                 class="rounded img-thumbnail shadow-sm" width="60" 
                                 style="transition: 0.3s; cursor: pointer;"
                                 onmouseover="this.style.transform='scale(1.2)'" 
                                 onmouseout="this.style.transform='scale(1)'">
                        <?php else: ?>
                            <span class="text-muted fst-italic">Không có ảnh</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-danger fw-bold">Không tìm thấy sinh viên</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="text-center mt-3">
        <a href="index.php?controller=sinhvien&action=index" class="btn btn-secondary">Quay lại</a>
    </div>
</div>
