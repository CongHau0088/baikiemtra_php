<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<div class="container mt-4">
    <h2 class="text-center text-primary">Danh Sách Học Phần</h2>

    <?php if (!empty($_GET['success'])): ?>
        <div class="alert alert-success">Đăng ký học phần thành công!</div>
    <?php endif; ?>

    <table class="table table-bordered table-hover text-center align-middle shadow">
        <thead class="table-dark">
            <tr>
                <th>Mã HP</th>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hocPhans as $hocPhan): ?>
                <tr>
                    <td><?php echo htmlspecialchars($hocPhan->MaHP); ?></td>
                    <td><?php echo htmlspecialchars($hocPhan->TenHP); ?></td>
                    <td><?php echo htmlspecialchars($hocPhan->SoTinChi); ?></td>
                    <td>
                        <a href="index.php?controller=hocphan&action=dangKy&maHP=<?php echo $hocPhan->MaHP; ?>" class="btn btn-success">Đăng Ký</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
