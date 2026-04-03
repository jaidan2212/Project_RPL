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
            background: #cbb79c;
            font-family: 'Poppins', sans-serif;
        }

        /* --- NAVBAR CUSTOM --- */
        .navbar-custom {
            background: #561c24; /* Warna Maroon Gelap */
            padding: 12px 0;
        }

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

        /* Navigasi Menu */
        .navbar-nav .nav-item {
            margin: 0 5px;
        }

        .navbar-nav .nav-link {
            color: white !important;
            background: transparent; /* Tetap Merah Maroon mengikuti Navbar */
            padding: 10px 20px !important;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
            border: 1px solid rgba(255, 255, 255, 0.1); /* Garis tepi tipis agar bentuk kotak terlihat sedikit */
        }

        /* EFEK HOVER & ACTIVE: Berubah jadi Krem (Sesuai Foto 3) */
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            background: #e8d8c4 !important; /* Warna Krem */
            color: #561c24 !important;      /* Teks jadi Maroon Gelap */
            border-color: #e8d8c4 !important;
        }

        /* Tombol Logout */
        .nav-logout {
            background: #8d2a36 !important; /* Merah sedikit lebih terang agar beda */
        }
        
        .nav-logout:hover {
            background: #e8d8c4 !important;
            color: #561c24 !important;
        }

        /* --- FORM STYLING --- */
        h2 {
            color: #561c24;
            font-weight: 600;
        }

        .card-custom {
            background: #e8d8c4;
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #cbb79c;
        }

        .btn-custom {
            background: #561c24;
            color: white;
            border: none;
            border-radius: 10px;
        }

        .btn-custom:hover {
            background: #3e141a;
            color: white;
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
                    <li class="nav-item"><a class="nav-link nav-logout" href="logout.php">Logout</a></li>
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
                            <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
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
                            <img src="assets/gambar/<?php echo $data['gambar']; ?>" width="100" class="mb-3 rounded shadow-sm border border-white">
                            <input type="file" name="gambar" class="form-control">
                        </div>
                        <button type="submit" name="update" class="btn btn-custom w-100 fw-bold py-2 mb-2">Update Produk</button>
                        <a href="kelola_produk.php" class="btn btn-outline-secondary w-100 fw-bold py-2" style="border-radius: 10px;">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php 
    if(file_exists('layout/footer.php')) {
        include 'layout/footer.php'; 
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>