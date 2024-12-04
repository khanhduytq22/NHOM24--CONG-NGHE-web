<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        /* Tùy chỉnh giao diện cho form đăng nhập */
        body {
            background-color: #f8f9fa; /* Màu nền nhạt */
            font-family: Arial, sans-serif;
        }
        
        .container {
            max-width: 400px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
        }

        h2 {
            color: #198754; /* Màu xanh Bootstrap */
            text-align: center;
        }

        .btn-success {
            width: 100%; /* Nút đăng nhập rộng */
        }

        .btn-secondary {
            width: 100%;
            margin-top: 10px;
        }

        .form-label {
            color: #495057; /* Màu chữ xám đậm */
            font-weight: 600;
        }

        input {
            border-radius: 5px;
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .alert {
            font-size: 0.9rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 fw-bold">Đăng nhập</h2>

        <?php
            session_start();
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
        ?>

        <form action="../../index.php?controller=admin&action=login" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label fw-semibold">Tài khoản:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Mật khẩu:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="showPassword">
                <label class="form-check-label" for="showPassword">Hiển thị mật khẩu</label>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-success">Đăng nhập</button>
                <a href="../../index.php?controller=admin&action=index" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script>
        document.getElementById('showPassword').addEventListener('change', function () {
            var passwordField = document.getElementById('password');

            if (this.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>
</body>
</html>
