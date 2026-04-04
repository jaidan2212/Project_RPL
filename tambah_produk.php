<?php
session_start();
include 'koneksi.php';

// Proteksi Admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
  header("Location: login.php");
  exit;
}

if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok']; // Tambahan input stok

  $gambar = $_FILES['gambar']['name'];
  $tmp = $_FILES['gambar']['tmp_name'];

  move_uploaded_file($tmp, "assets/gambar/" . $gambar);

  // Query di-update untuk memasukkan stok
  $sql = "INSERT INTO produk (nama, harga, stok, gambar) VALUES ('$nama', '$harga', '$stok', '$gambar')";
  if ($koneksi->query($sql)) {
    echo "<div class='alert alert-success text-center'>Produk berhasil ditambahkan!</div>";
  } else {
    echo "<div class='alert alert-danger text-center'>Error: " . $koneksi->error . "</div>";
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Admin - Tambah Produk Kedaiku</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      background: #cbb79c;
      font-family: 'Poppins', sans-serif;
    }

    /* Navbar */
    .navbar-custom {
      background: #561c24;
    }

    /* CSS Tambahan untuk Logo agar rapi */
    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .navbar-brand img {
        height: 40px;
        width: auto;
        border-radius: 4px;
    }

    /* Judul */
    h2 {
      color: #561c24;
      font-weight: 600;
    }

    /* Card Form */
    .card-custom {
      background: #e8d8c4;
      border: none;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    /* Input */
    .form-control {
      border-radius: 8px;
    }

    /* Button */
    .btn-danger {
      background: #561c24;
      border: none;
    }

    .btn-danger:hover {
      background: #3e141a;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top shadow">
    <div class="container">
      <a class="navbar-brand fw-bold" href="admin.php">
          <img src="assets/gambar/Logo_Project.jpeg" alt="Logo Kedaiku">
          Admin Kedaiku
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="admin.php">Pesanan</a></li>
          <li class="nav-item"><a class="nav-link" href="kelola_produk.php">Daftar Produk</a></li>
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
              <label class="form-label fw-bold">Harga /kg (Rp)</label>
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

  <?php include 'layout/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>