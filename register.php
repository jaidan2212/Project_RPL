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
            $success = "Akun berhasil dibuat! Silakan login.";
        } else {
            $error = "Error: ".$koneksi->error;
        }
    } else {
        $error = "Upload foto gagal! Pastikan folder assets/foto ada.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Register - Kedaiku</title>

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

.register-card{
background:#e8d8c4;
border:none;
border-radius:12px;
box-shadow:0 8px 20px rgba(0,0,0,0.2);
padding:35px;
}

.register-title{
font-family:'Playfair Display',serif;
color:#561c24;
font-weight:bold;
}

.btn-register{
background:#561c24;
border:none;
}

.btn-register:hover{
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

<div class="card register-card">

<h3 class="text-center register-title mb-4">☕ Daftar Akun Kedaiku</h3>

<?php if(isset($success)) echo "<div class='alert alert-success text-center'>$success <br><a href='login.php'>Login sekarang</a></div>"; ?>
<?php if(isset($error)) echo "<div class='alert alert-danger text-center'>$error</div>"; ?>

<form method="post" enctype="multipart/form-data">

<div class="mb-3">
<label class="form-label fw-bold">Username</label>
<input type="text" name="username" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label fw-bold">Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label fw-bold">Foto Profil</label>
<input type="file" name="foto" class="form-control" required>
</div>

<button type="submit" name="register" class="btn btn-register text-white w-100 mb-3">
Register
</button>

</form>

<div class="text-center">

<a href="login.php" class="btn back-btn text-white w-100">
← Kembali ke Login
</a>

</div>

</div>
</div>
</div>
</div>

</body>
</html>