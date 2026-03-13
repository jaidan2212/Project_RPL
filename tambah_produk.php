<?php
session_start();
include 'koneksi.php';

// Proteksi Admin
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok']; // Tambahan input stok

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "assets/gambar/".$gambar);

    // Query di-update untuk memasukkan stok
    $sql = "INSERT INTO produk (nama, harga, stok, gambar) VALUES ('$nama', '$harga', '$stok', '$gambar')";
    if($koneksi->query($sql)){
        echo "<div class='alert alert-success text-center'>Produk berhasil ditambahkan!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error: ".$koneksi->error."</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin - Tambah Produk Kedaiku</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body { background-color: #f4f6f9; font-family: 'Poppins', sans-serif; }
    .navbar-custom { background-color: #8B0000; } /* Tema Merah */
    .card-custom { border:none; box-shadow:0 4px 15px rgba(0,0,0,0.1); }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="admin.php">☕ Admin Kedaiku</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="admin.php">Pesanan</a></li>
        <li class="nav-item"><a class="nav-link" href="kelola_produk.php">Kelola Produk</a></li>
        <li class="nav-item"><a class="nav-link active" href="tambah_produk.php">Tambah Produk</a></li>
        <li class="nav-item"><a class="nav-link" href="tambah_admin.php">Tambah Admin</a></li>
        <li class="nav-item"><a class="nav-link text-warning fw-bold" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-5">
  <h2 class="text-center mb-4">Tambah Produk Kopi</h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card card-custom p-4">
        <form method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label fw-bold">Nama Produk</label>
            <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Harga (Rp)</label>
            <input type="number" name="harga" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Stok Awal</label>
            <input type="number" name="stok" class="form-control" required min="0">
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Gambar Produk</label>
            <input type="file" name="gambar" class="form-control" required>
          </div>
          <button type="submit" name="simpan" class="btn btn-danger w-100 fw-bold">Simpan Produk</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>