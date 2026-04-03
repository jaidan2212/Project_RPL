<?php
session_start();
include 'koneksi.php';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "user";

    $uploadDir = "assets/foto/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fotoName = time() . "_" . preg_replace("/\s+/", "_", $_FILES['foto']['name']);
    $tmp = $_FILES['foto']['tmp_name'];

    if (move_uploaded_file($tmp, $uploadDir . $fotoName)) {
        $sql = "INSERT INTO users (username, password, role, foto) 
                VALUES ('$username', '$password', '$role', '$fotoName')";
        if ($koneksi->query($sql)) {
            $success = "Akun berhasil dibuat! Silakan login.";
        } else {
            $error = "Gagal mendaftar: " . $koneksi->error;
        }
    } else {
        $error = "Upload foto profil gagal!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - Kedaiku Coffee Shop</title>

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

        .back-btn {
            background: transparent;
            color: #561c24;
            border: 2px solid #561c24;
            border-radius: 10px;
            padding: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
        }

        .back-btn:hover {
            background: #561c24;
            color: white;
            text-decoration: none;
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
                        <h3 class="register-title">Daftar Akun</h3>
                        <p class="text-muted small">Bergabung menjadi member Kedaiku</p>
                    </div>

                    <?php if (isset($success)) : ?>
                        <div class='alert alert-success text-center small rounded-3 fw-bold mb-4'>
                            <i class='fa-solid fa-circle-check me-2'></i> <?php echo $success; ?>
                            <br><a href='login.php' class='text-success text-decoration-underline'>Login di sini</a>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($error)) : ?>
                        <div class='alert alert-danger text-center small rounded-3 fw-bold mb-4'>
                            <i class='fa-solid fa-triangle-exclamation me-2'></i> <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Pilih username" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Buat password" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Foto Profil</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-image"></i></span>
                                <input type="file" name="foto" class="form-control" accept="image/*" required>
                            </div>
                            <div class="form-text small">Gunakan foto terbaikmu untuk profil member.</div>
                        </div>

                        <button type="submit" name="register" class="btn btn-register w-100 mb-4 shadow-sm">
                            <i class="fa-solid fa-user-plus me-2"></i> Daftar Sekarang
                        </button>
                    </form>

                    <div class="text-center">
                        <hr style="border-color: #d1c1af;">
                        <a href="login.php" class="back-btn mt-3">
                            <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Login
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>