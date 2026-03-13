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
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #f5f0e1, #e0c097);
      font-family: 'Poppins', sans-serif;
    }
    .card-custom { 
      background:#fff8f0; 
      border:none; 
      box-shadow:0 4px 15px rgba(0,0,0,0.2); 
    }
    .foto-user { 
      width:80px; 
      height:80px; 
      border-radius:50%; 
      object-fit:cover; 
    }
  </style>
</head>
<body class="container mt-5">
  <h2 class="text-center mb-4">Login</h2>
  <?php if(isset($error)) echo "<div class='alert alert-danger text-center'>$error</div>"; ?>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card card-custom p-4">
        <form method="post">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-center mt-3">
          <p>Belum punya akun? <a href="register.php">Buat akun di sini!</a></p>
          <a href="index.php" class="btn btn-secondary mt-2">← Kembali</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>