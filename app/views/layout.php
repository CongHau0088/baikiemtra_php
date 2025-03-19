<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link:hover {
            color: #ff9800 !important;
        }
        .search-bar {
            max-width: 400px;
        }
        .content-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<!-- Header -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">🎓 Quản Lý Sinh Viên</a>

            <!-- Search Bar -->
            <form class="d-flex search-bar mx-auto">
                <input class="form-control me-2" type="search" placeholder="Tìm kiếm sinh viên..." aria-label="Search">
                <button class="btn btn-warning" type="submit">🔍</button>
            </form>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Menu -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
    <li class="nav-item">
        <a class="nav-link" href="index.php?controller=home">🏠 Trang chủ</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php?controller=sinhvien&action=index">👨‍🎓 Sinh Viên</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php?controller=nganhhoc&action=index">📂 Ngành Học</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php?controller=hocphan&action=index">📚 Học Phần</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown">
            👤 Tài khoản
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?controller=user&action=profile">Thông tin cá nhân</a></li>
            <li><a class="dropdown-item" href="index.php?controller=user&action=logout">Đăng xuất</a></li>
        </ul>
    </li>
</ul>


            </div>
        </div>
    </nav>
</header>

<!-- Main Content -->
<main class="container mt-4">
    <div class="content-container">
        <?php include $view; ?>
    </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

</body>
</html>