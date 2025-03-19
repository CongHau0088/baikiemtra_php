

<div class="container">
    <h2>Thêm Ngành Học</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label for="tenNganh">Tên Ngành:</label>
            <input type="text" name="tenNganh" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
        <a href="index.php?controller=nganhhoc&action=index" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

