<?php
session_start();
include 'koneksi.php';

// Proteksi Admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
  header("Location: login.php");
  exit;
}

// Ambil data produk yang mau diedit
$id = $_GET['id'];
$query = $koneksi->query("SELECT * FROM produk WHERE id='$id'");
$data = $query->fetch_assoc();

// Logika Update Produk
if (isset($_POST['update'])) {
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];

  // Cek apakah admin upload gambar baru
  if ($_FILES['gambar']['name'] != "") {
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "assets/gambar/" . $gambar);

    $sql = "UPDATE produk SET nama='$nama', harga='$harga', stok='$stok', gambar='$gambar' WHERE id='$id'";
  } else {
    // Kalau gambar nggak diganti
    $sql = "UPDATE produk SET nama='$nama', harga='$harga', stok='$stok' WHERE id='$id'";
  }

  if ($koneksi->query($sql)) {
    echo "<script>alert('Produk berhasil diupdate!'); window.location='kelola_produk.php';</script>";
  } else {
    echo "<script>alert('Gagal update produk!');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Edit Produk - Admin Kedaiku</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Poppins', sans-serif;
    }

    .navbar-custom {
      background-color: #8B0000;
    }

    .card-custom {
      border: none;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="admin.php">☕ Admin Kedaiku</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="admin.php">Pesanan</a></li>
          <li class="nav-item"><a class="nav-link active" href="kelola_produk.php">Kelola Produk</a></li>
          <li class="nav-item"><a class="nav-link" href="tambah_produk.php">Tambah Produk</a></li>
          <li class="nav-item"><a class="nav-link text-warning" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-5">
    <h2 class="text-center mb-4">Edit Produk Kopi</h2>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card card-custom p-4">
          <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label class="form-label fw-bold">Nama Produk</label>
              <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Harga (Rp)</label>
              <input type="number" name="harga" class="form-control" value="<?php echo $data['harga']; ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Stok Barang</label>
              <input type="number" name="stok" class="form-control" value="<?php echo isset($data['stok']) ? $data['stok'] : 0; ?>" required min="0">
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Gambar Produk (Biarkan kosong jika tidak diganti)</label><br>
              <img src="assets/gambar/<?php echo $data['gambar']; ?>" width="100" class="mb-2 rounded">
              <input type="file" name="gambar" class="form-control">
            </div>
            <button type="submit" name="update" class="btn btn-warning w-100 fw-bold">Update Produk</button>
            <a href="kelola_produk.php" class="btn btn-secondary w-100 mt-2">Batal</a>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>