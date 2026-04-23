<?php 
session_start();
if(!isset($_SESSION['email_reset'])) { header("Location: lupa_password.php"); }
include 'layout/header.php'; 
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Verifikasi OTP - Kedaiku Coffee Shop</title>

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

        .otp-input {
            letter-spacing: 15px;
            font-size: 2rem;
            text-align: center;
            font-weight: bold;
            border-radius: 10px;
            background-color: #fff;
            border: 1px solid #ced4da;
            padding: 10px;
        }

        .otp-input:focus {
            border-color: #561c24;
            box-shadow: 0 0 0 0.25rem rgba(86, 28, 36, 0.25);
            outline: none;
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

    <div class="container flex-grow-1 d-flex align-items-center justify-content-center my-5">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6 col-lg-5">

                <div class="card register-card">
                    <div class="text-center mb-4">
                        <img src="assets/gambar/logo.jpeg" alt="Logo Kedaiku" class="login-logo">
                        <h3 class="register-title">Verifikasi OTP</h3>
                        <p class="text-muted small">Masukkan 6 digit kode yang dikirim ke:<br>
                           <strong style="color: #561c24;"><?php echo $_SESSION['email_reset']; ?></strong>
                        </p>
                    </div>

                    <form action="proses_verifikasi_otp.php" method="POST">
                        <div class="mb-4">
                            <input type="text" name="otp" class="form-control otp-input" maxlength="6" placeholder="000000" required autofocus>
                            <div class="form-text text-center mt-2 small">Periksa folder Inbox atau Spam email Anda.</div>
                        </div>

                        <button type="submit" class="btn btn-register w-100 mb-2 shadow-sm">
                            <i class="fa-solid fa-shield-check me-2"></i> Verifikasi Sekarang
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <hr style="border-color: #d1c1af;">
                        <p class="small text-muted">Salah memasukkan email? 
                            <a href="lupa_password.php" style="color: #6d2932; text-decoration: none; font-weight: bold;">Ganti Email</a>
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