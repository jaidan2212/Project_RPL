<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "admin" && $password == "admin123"){
        $_SESSION['username'] = "admin";
        $_SESSION['role'] = "admin";
        $_SESSION['foto'] = "default_admin.png"; 
        header("Location: admin.php");
        exit;
    }

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $koneksi->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])){
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
<title>Login - Kopiku</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<style>

body{
background:#c7b7a3;
font-family:'Poppins',sans-serif;
min-height:100vh;
display:flex;
align-items:center;
justify-content:center;
}

.login-card{
background:#e8d8c4;
border:none;
border-radius:12px;
box-shadow:0 8px 20px rgba(0,0,0,0.2);
padding:35px;
}

.login-title{
font-family:'Playfair Display',serif;
color:#561c24;
font-weight:bold;
}

.btn-login{
background:#561c24;
border:none;
}

.btn-login:hover{
background:#6d2932;
}

.back-btn{
background:#6d2932;
border:none;
}

.back-btn:hover{
background:#561c24;
}

</style>

</head>
<body>

<div class="container">
<div class="row justify-content-center">
<div class="col-md-5">

<div class="card login-card">

<h3 class="text-center login-title mb-4">☕ Login Kopiku</h3>

<?php if(isset($error)) echo "<div class='alert alert-danger text-center'>$error</div>"; ?>

<form method="post">

<div class="mb-3">
<label class="form-label fw-bold">Username</label>
<input type="text" name="username" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label fw-bold">Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" name="login" class="btn btn-login text-white w-100 mb-3">
Login
</button>

</form>

<div class="text-center">

<p>Belum punya akun? 
<a href="register.php" class="fw-bold" style="color:#561c24;">Daftar di sini</a>
</p>

<a href="index.php" class="btn back-btn text-white w-100">
← Kembali ke Home
</a>

</div>

</div>
</div>
</div>
</div>

</body>
</html>