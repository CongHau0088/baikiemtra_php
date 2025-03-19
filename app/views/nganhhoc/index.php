

<div class="container">
    <h2>Danh Sách Ngành Học</h2>
    <a href="index.php?controller=nganhhoc&action=add" class="btn btn-primary">Thêm Ngành Học</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Ngành</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nganhHocs as $nganhHoc): ?>
                <tr>
                    <td><?= htmlspecialchars($nganhHoc->MaNganh) ?></td>
                    <td><?= htmlspecialchars($nganhHoc->TenNganh) ?></td>
                    <td>
                        <a href="index.php?controller=nganhhoc&action=edit&id=<?= $nganhHoc->MaNganh ?>" class="btn btn-warning">Sửa</a>
                        <a href="index.php?controller=nganhhoc&action=delete&id=<?= $nganhHoc->MaNganh ?>" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa?');"
                           class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

