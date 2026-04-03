<?php
session_start();
include 'koneksi.php';

// Proteksi Admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Logika untuk Hapus Produk
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    $hapus = $koneksi->query("DELETE FROM produk WHERE id='$id_hapus'");
    if ($hapus) {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            background: #cbb79c;
            font-family: 'Poppins', sans-serif;
        }

        /* Navbar */
        .navbar-custom {
            background: #561c24;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand img {
            height: 40px;
            border-radius: 4px;
        }

        /* Card */
        .card {
            background: #e8d8c4;
            border-radius: 12px;
        }

        h2 {
            color: #561c24;
            font-weight: 600;
        }

        /* Produk Card */
        .produk-card {
            background: #f1e4d3;
            border-radius: 14px;
            transition: 0.3s;
        }

        .produk-card:hover {
            background: #dcc8ad;
            transform: translateY(-5px);
        }

        .produk-img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 10px;
        }

        .produk-card h6 {
            color: #561c24;
        }

        /* Icon Button */
        .icon-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #e8d8c4;
            text-decoration: none;
            transition: 0.2s;
        }

        .icon-btn i {
            font-size: 18px;
            color: #561c24;
        }

        .icon-btn:hover {
            background: #dcc8ad;
            transform: scale(1.1);
        }

        .edit-btn i {
            font-weight: bold;
        }

        .delete-btn i {
            font-weight: bold;
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
                <li class="nav-item"><a class="nav-link active" href="kelola_produk.php">Daftar Produk</a></li>
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
    </div>

    <div class="card p-4 shadow-sm border-0">
        <div class="row">

            <?php
            $query = $koneksi->query("SELECT * FROM produk ORDER BY id DESC");
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) {
            ?>

            <div class="col-md-4 col-sm-6 mb-4">
                <div class="produk-card p-3 h-100 text-center">

                    <img src="assets/gambar/<?php echo $row['gambar']; ?>" class="produk-img mb-3">

                    <h6 class="fw-bold"><?php echo $row['nama']; ?></h6>

                    <p class="mb-1">
                        Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?>
                    </p>

                    <?php if ($row['stok'] > 0) { ?>
                        <span class="badge bg-success mb-2">
                            <?php echo $row['stok']; ?> Item
                        </span>
                    <?php } else { ?>
                        <span class="badge bg-danger mb-2">Habis</span>
                    <?php } ?>

                    <div class="d-flex justify-content-center gap-2 mt-2">

                        <a href="edit_produk.php?id=<?php echo $row['id']; ?>" 
                           class="btn icon-btn edit-btn">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <a href="kelola_produk.php?hapus=<?php echo $row['id']; ?>" 
                           class="btn icon-btn delete-btn"
                           onclick="return confirm('Yakin ingin menghapus kopi ini?');">
                            <i class="bi bi-trash"></i>
                        </a>

                    </div>

                </div>
            </div>

            <?php
                }
            } else {
                echo "<div class='text-center'>Belum ada produk</div>";
            }
            ?>

        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>