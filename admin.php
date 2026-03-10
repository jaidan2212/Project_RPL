<?php include 'koneksi.php'; ?>

<?php
if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "assets/gambar/".$gambar);

    $sql = "INSERT INTO produk (nama,harga,gambar) VALUES ('$nama','$harga','$gambar')";
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
  <title>Admin - Tambah Produk</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f5f0e1, #e0c097);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    h1,h2,h3 { font-family: 'Playfair Display', serif; }
    .card-custom { background:#fff8f0; border:none; box-shadow:0 4px 15px rgba(0,0,0,0.2); }
    .btn-anim:hover { transform:scale(1.05); transition:0.3s; }
    footer { background:#3e2723; margin-top:auto; }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">☕ Toko Kopi Admin</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">Tambah Produk</a></li>
        <li class="nav-item"><a class="nav-link text-warning fw-bold" href="produk.php">← Kembali</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-5">
  <h1 class="text-center mb-4">Tambah Produk Kopi</h1>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card card-custom p-4">
        <form method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Gambar Produk</label>
            <input type="file" name="gambar" class="form-control" required>
          </div>
          <button type="submit" name="simpan" class="btn btn-primary btn-anim">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<footer class="text-white text-center py-3">
  <p>&copy; <?php echo date("Y"); ?> Toko Biji Kopi Admin. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>