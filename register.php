<?php
include 'koneksi.php';

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "user";

    $uploadDir = "assets/foto/";
    if(!is_dir($uploadDir)){
        mkdir($uploadDir, 0777, true);
    }

    $fotoName = time() . "_" . preg_replace("/\s+/", "_", $_FILES['foto']['name']);
    $tmp = $_FILES['foto']['tmp_name'];

    if(move_uploaded_file($tmp, $uploadDir.$fotoName)){
        $sql = "INSERT INTO users (username,password,role,foto) 
                VALUES ('$username','$password','$role','$fotoName')";
        if($koneksi->query($sql)){
            echo "<div class='alert alert-success text-center'>
                    Akun berhasil dibuat! <a href='login.php'>Login sekarang</a>
                  </div>";
        } else {
            echo "<div class='alert alert-danger text-center'>
                    Error: ".$koneksi->error."
                  </div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>
                Upload foto gagal! Pastikan folder assets/foto ada dan bisa ditulis.
              </div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h2 class="text-center mb-4">Buat Akun Baru</h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card p-4">
        <form method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Foto Profil</label>
            <input type="file" name="foto" class="form-control" required>
          </div>
          <button type="submit" name="register" class="btn btn-success">Register</button>
        </form>
        <div class="text-center mt-3">
          <a href="login.php" class="btn btn-secondary">← Kembali ke Login</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>