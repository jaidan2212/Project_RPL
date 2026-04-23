<?php include 'layout/header.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background: #c7b7a3; font-family: 'Poppins', sans-serif; }
        .login-card { background: #fdf5e6; border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(86, 28, 36, 0.15); padding: 40px 35px; }
        .btn-login { background: #561c24; color: white; border: none; border-radius: 10px; padding: 12px; font-weight: 600; transition: 0.3s; }
        .btn-login:hover { background: #6d2932; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(86, 28, 36, 0.3); }
        .form-control { border-radius: 10px; padding: 12px; }
        .register-link { color: #6d2932; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container flex-grow-1 d-flex align-items-center justify-content-center my-5">
        <div class="col-md-5">
            <div class="card login-card text-center">
                <img src="assets/gambar/logo.jpeg" style="width: 80px; margin: 0 auto 15px;">
                <h4 class="fw-bold" style="color: #561c24;">LUPA PASSWORD</h4>
                <p class="text-muted small mb-4">Masukkan email terdaftar untuk menerima kode OTP.</p>
                
                <form action="proses_lupa_password.php" method="POST">
                    <div class="mb-4 text-start">
                        <label class="form-label fw-bold small">Alamat Email</label>
                        <input type="email" name="email" class="form-control" placeholder="contoh@gmail.com" required>
                    </div>
                    <button type="submit" class="btn btn-login w-100">Kirim Kode OTP</button>
                </form>
                <div class="mt-3">
                    <a href="login.php" class="register-link small">Kembali ke Login</a>
                </div>
            </div>
        </div>
    </div>
    <?php include 'layout/footer.php'; ?>
</body>
</html>