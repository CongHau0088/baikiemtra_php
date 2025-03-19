<div class="container">
    <h2>Đăng Ký Học Phần</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label for="maSV">Mã Sinh Viên:</label>
            <input type="text" name="maSV" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="maHocPhan">Chọn Học Phần:</label>
            <select name="maHocPhan" class="form-control">
                <?php foreach ($hocPhanList as $hocPhan): ?>
                    <option value="<?= $hocPhan->MaHocPhan ?>"><?= htmlspecialchars($hocPhan->TenHocPhan) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Xác Nhận Đăng Ký</button>
    </form>
</div>
