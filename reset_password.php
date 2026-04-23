<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['email_reset'])) {
    header("Location: lupa_password.php");
    exit;
}

if (isset($_POST['reset'])) {
    $pass_baru = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_SESSION['email_reset'];

    $update = $koneksi->query("UPDATE users SET password='$pass_baru', otp_code=NULL, otp_expiry=NULL WHERE email='$email'");
    if ($update) {
        session_destroy();
        echo "<script>alert('Password berhasil diubah! Silakan login kembali.'); window.location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Reset Password - Kedaiku Coffee Shop</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            background: #c7b7a3;
            font-family: 'Poppins', sans-serif;
        }

        .register-card {
            background: #fdf5e6;
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(86, 28, 36, 0.15);
            padding: 40px 35px;
        }

        .register-title {
            font-family: 'Playfair Display', serif;
            color: #561c24;
            font-weight: 700;
            font-size: 1.8rem;
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
            padding: 10px 15px;
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

        .btn-register {
            background: #561c24;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background: #6d2932;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(86, 28, 36, 0.3);
        }

        .login-logo {
            width: 70px;
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

                <div class="card register-card">
                    <div class="text-center mb-4">
                        <img src="assets/gambar/logo.jpeg" alt="Logo Kedaiku" class="login-logo">
                        <h3 class="register-title">Password Baru</h3>
                        <p class="text-muted small">Silakan buat password baru yang aman untuk akun Anda.</p>
                    </div>

                    <form method="post">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Password Baru</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required minlength="6">
                            </div>
                            <div class="form-text small">Pastikan password sulit ditebak orang lain.</div>
                        </div>

                        <button type="submit" name="reset" class="btn btn-register w-100 mb-2 shadow-sm">
                            <i class="fa-solid fa-circle-check me-2"></i> Update Password
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>