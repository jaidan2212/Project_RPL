<?php
session_start();
include 'koneksi.php';

// Proteksi: Cuma admin yang boleh masuk
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_POST['tambah_admin'])) {
    $username = $_POST['username'];
    // Enkripsi password biar aman
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'admin';
    $foto = 'default.png'; // Foto default untuk admin baru

    // Cek apakah username sudah ada
    $cek = $koneksi->query("SELECT * FROM users WHERE username='$username'");
    if ($cek->num_rows > 0) {
        $pesan = "<div class='alert alert-danger text-center'>Username sudah dipakai, pilih yang lain!</div>";
    } else {
        $sql = "INSERT INTO users (username, password, role, foto) VALUES ('$username', '$password', '$role', '$foto')";
        if ($koneksi->query($sql)) {
            $pesan = "<div class='alert alert-success text-center'>Akun Admin baru berhasil ditambahkan!</div>";
        } else {
            $pesan = "<div class='alert alert-danger text-center'>Gagal menambahkan admin: " . $koneksi->error . "</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Admin - Kedaiku</title>
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

        /* Card form */
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
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="admin.php">Pesanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="kelola_produk.php">Daftar Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="tambah_produk.php">Tambah Produk</a></li>
                    <li class="nav-item"><a class="nav-link active" href="tambah_admin.php">Tambah Admin</a></li>
                    <li class="nav-item"><a class="nav-link text-warning fw-bold" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="text-center mb-4">Buat Akun Admin Baru</h2>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card card-custom p-4">
                    <?php if (isset($pesan)) echo $pesan; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Username Admin Baru</label>
                            <input type="text" name="username" class="form-control" required placeholder="Contoh: admin_habiba">
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" name="tambah_admin" class="btn btn-danger w-100 fw-bold">Simpan Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'layout/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>