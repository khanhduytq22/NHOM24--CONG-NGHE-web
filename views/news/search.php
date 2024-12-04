<?php
    session_start();
    if (isset($_GET['query'])) {
        $query = $_GET['query'];

        require_once(__DIR__ . '/../../models/News.php');
        $news = new News();
        $searchResults = $news->searchNews($query);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="../home/index.php">Trang chủ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <strong><?= $_SESSION['username'] ?></strong>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="userMenu">
                                <li><a class="dropdown-item" href="../admin/logout.php">Đăng xuất</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/login.php">Đăng nhập</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <section class="container mt-5">
        <h2 class="text-center mb-4">Kết quả tìm kiếm</h2>
        <div class="row">
            <?php if (!empty($searchResults)): ?>
                <?php foreach ($searchResults as $item): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-light">
                            <img src="../../<?= $item['image']; ?>" alt="<?= $item['title']; ?>" style="width: 100px; height: auto;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $item['title'] ?></h5>
                                <p class="card-text"><?= substr($item['content'], 0, 100) ?>...</p>
                                <a href="../news/detail.php?id=<?= $item['id'] ?>" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="col-12 text-center">Không tìm thấy kết quả nào!</p>
            <?php endif; ?>
        </div>
    </section>

    <footer class="footer d-flex align-items-center justify-content-center">
        <p class="m-0">&copy; 2024 Trang Tin tức | Designed by 64KTPM2 - Nhóm 9</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
