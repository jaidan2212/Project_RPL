<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "admin123") {
        $_SESSION['username'] = "admin";
        $_SESSION['role'] = "admin";
        $_SESSION['foto'] = "default_admin.png";
        header("Location: admin.php");
        exit;
    }

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['foto'] = $row['foto'];

            header("Location: index.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Masuk - Kedaiku Coffee Shop</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            background: #c7b7a3;
            font-family: 'Poppins', sans-serif;
        }

        .login-card {
            background: #fdf5e6;
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(86, 28, 36, 0.15);
            padding: 40px 35px;
        }

        .login-title {
            font-family: 'Playfair Display', serif;
            color: #561c24;
            font-weight: 700;
            font-size: 2rem;
        }

        .form-label {
            color: #561c24;
            font-size: 0.9rem;
        }

        .input-group-text {
            background-color: transparent;
            border-right: none;
            color: #561c24;
            border-radius: 10px 0 0 10px;
        }

        .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
            padding: 12px 15px;
            background-color: transparent;
        }

        .form-control:focus {
            border-color: #dee2e6;
            box-shadow: none;
        }

        .input-group {
            border: 1px solid #ced4da;
            border-radius: 10px;
            background-color: #fff;
        }

        .input-group:focus-within {
            box-shadow: 0 0 0 0.25rem rgba(86, 28, 36, 0.25);
            border-color: #561c24;
        }

        .btn-login {
            background: #561c24;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #6d2932;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(86, 28, 36, 0.3);
        }

        .register-link {
            color: #6d2932;
            text-decoration: none;
            transition: 0.3s;
        }

        .register-link:hover {
            color: #561c24;
            text-decoration: underline;
        }

        /* Style khusus untuk Logo agar proporsional */
        .login-logo {
            width: 80px; /* Atur ukuran logo di sini */
            height: auto;
            margin-bottom: 15px;
        }
    </style>

</head>

<body class="d-flex flex-column min-vh-100">

    <?php include 'layout/header.php'; ?>

    <div class="container flex-grow-1 d-flex align-items-center justify-content-center my-5">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6 col-lg-5">

                <div class="card login-card">
                    <div class="text-center mb-4">
                        <img src="assets/gambar/logo.jpeg" alt="Logo Kedaiku" class="login-logo">
                        
                        <p class="text-muted small">Silakan masuk ke akun Anda</p>
                    </div>

                    <?php if (isset($error)) echo "<div class='alert alert-danger text-center small rounded-3 fw-bold'> <i class='fa-solid fa-triangle-exclamation me-2'></i> $error</div>"; ?>

                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            </div>
                        </div>

                        <button type="submit" name="login" class="btn btn-login w-100 mb-4 shadow-sm">
                            <i class="fa-solid fa-right-to-bracket me-2"></i> Masuk Sekarang
                        </button>
                    </form>

                    <div class="text-center mt-2">
                        <p class="small text-muted mb-0">Belum punya akun?
                            <a href="register.php" class="fw-bold register-link">Daftar di sini</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>