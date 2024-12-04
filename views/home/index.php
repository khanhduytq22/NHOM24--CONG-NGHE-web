<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Tin tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        /* Reset body */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #eef2f7;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        .navbar {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: #007bff;
        }
        .navbar .nav-link {
            font-weight: 500;
            color: #495057;
        }
        .navbar .nav-link:hover {
            color: #007bff;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
            text-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
        }
        .hero h1 {
            font-size: 2.5rem;
        }
        .search-bar input {
            border-radius: 20px;
            padding: 12px 20px;
            border: none;
            margin-right: -5px;
            flex-grow: 1;
        }
        .search-bar button {
            border-radius: 20px;
            padding: 12px 20px;
        }

        /* Tin tức */
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
        }
        .card-text {
            font-size: 0.95rem;
            color: #6c757d;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Footer */
        .footer {
            background: #343a40;
            color: #ffffff;
            padding: 15px 0;
            text-align: center;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="index.php">TLU News</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Xin chào, <strong><?= $_SESSION['username'] ?></strong>
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

    <!-- Hero Section -->
    <section class="hero py-5">
        <div class="container text-center">
            <h1 class="display-4 fw-medium">Chào mừng đến với Trang Tin tức TLU</h1>
            <div class="search-bar d-flex justify-content-center mt-4">
                <form action="../../index.php?controller=home&action=search" method="POST" class="d-flex w-100" style="max-width: 600px;">
                    <input type="text" class="form-control" placeholder="Tìm kiếm tin tức..." name="query">
                    <button class="btn btn-light ms-2" type="submit">Tìm</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Tin tức -->
    <section class="container mt-5">
        <h2 class="text-center mb-4">Tin tức mới nhất</h2>
        <div class="row">
            <?php if (!empty($allNews)): ?>
                <?php foreach ($allNews as $item): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <img src="../../<?= $item['image']; ?>" alt="<?= $item['title']; ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?= $item['title'] ?></h5>
                                <p class="card-text"><?= substr($item['content'], 0, 100) ?>...</p>
                                <a href="../news/detail.php?id=<?= $item['id'] ?>" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="col-12 text-center">Không có tin tức nào!</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p class="m-0">&copy; TLU News. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
