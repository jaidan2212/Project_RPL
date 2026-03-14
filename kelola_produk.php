<?php
session_start();
include 'koneksi.php';

// Proteksi Admin
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

// Logika untuk Hapus Produk
if(isset($_GET['hapus'])){
    $id_hapus = $_GET['hapus'];
    // Hapus dari database
    $hapus = $koneksi->query("DELETE FROM produk WHERE id='$id_hapus'");
    if($hapus){
        echo "<script>alert('Produk berhasil dihapus!'); window.location='kelola_produk.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Produk - Admin Kedaiku</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body{
            background:#cbb79c;
            font-family:'Poppins',sans-serif;
        }

        /* Navbar */
        .navbar-custom{
            background:#561c24;
        }

        /* Card container */
        .card{
            background:#e8d8c4;
            border-radius:12px;
        }

        /* Tabel */
        .table{
            background:#e8d8c4;
        }

        .table thead{
            background:#561c24;
            color:white;
        }

        .table tbody tr{
            background:#f1e4d3;
        }

        .table tbody tr:hover{
            background:#dcc8ad;
        }

        .table td, .table th{
            border:none;
        }

        /* Foto produk */
        .foto-produk{
            width:60px;
            height:60px;
            object-fit:cover;
            border-radius:8px;
        }
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
        <li class="nav-item"><a class="nav-link active" href="kelola_produk.php">Kelola Produk</a></li>
        <li class="nav-item"><a class="nav-link" href="tambah_produk.php">Tambah Produk</a></li>
        <li class="nav-item"><a class="nav-link" href="tambah_admin.php">Tambah Admin</a></li>
        <li class="nav-item"><a class="nav-link text-warning fw-bold" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Produk & Stok</h2>
        <a href="tambah_produk.php" class="btn btn-danger fw-bold">+ Tambah Kopi Baru</a>
    </div>

    <div class="card p-4 shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = $koneksi->query("SELECT * FROM produk ORDER BY id DESC");
                    if($query->num_rows > 0) {
                        while($row = $query->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><img src="assets/gambar/<?php echo $row['gambar']; ?>" class="foto-produk"></td>
                        <td class="fw-bold"><?php echo $row['nama']; ?></td>
                        <td>Rp <?php echo number_format($row['harga'],0,',','.'); ?></td>
                        <td>
                            <?php if(isset($row['stok']) && $row['stok'] > 0){ ?>
                                <span class="badge bg-success"><?php echo $row['stok']; ?> Item</span>
                            <?php } else { ?>
                                <span class="badge bg-danger">Habis</span>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="edit_produk.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm fw-bold">Edit</a>
                            <a href="kelola_produk.php?hapus=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm fw-bold" onclick="return confirm('Yakin ingin menghapus kopi ini?');">Hapus</a>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>Belum ada produk. Silakan tambah produk baru.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>