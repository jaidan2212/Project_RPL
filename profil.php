<?php
session_start();
include 'koneksi.php';

// Jika belum login, paksa kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Profil Akun - Kedaiku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FFFDF5;
            color: #333;
        }

        .bg-velvet { background-color: #A11C28 !important; color: white !important; }
        .text-velvet { color: #A11C28 !important; }

        /* Kustomisasi Sidebar Menu */
        .list-group-item {
            font-weight: 600;
            border: 1px solid #f0e6d2;
            padding: 15px 20px;
            color: #561c24;
        }
        .list-group-item:hover {
            background-color: #f0e6d2;
        }
        .list-group-item.active {
            background-color: #A11C28 !important;
            border-color: #A11C28 !important;
            color: white;
        }

        /* Kustomisasi Card Form */
        .card-profil {
            background: #fff;
            border: 1px solid #e8d8c4;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .btn-main {
            background-color: #d4af37; /* Emas */
            color: #561c24;
            font-weight: 600;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
        }
        .btn-main:hover {
            background-color: #A11C28;
            color: white;
        }
        
        /* Foto Profil Preview */
        .preview-foto {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #e8d8c4;
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include 'layout/header.php'; ?>

    <div class="container my-5 flex-grow-1">
        <h2 class="fw-bold text-velvet mb-4">Hi, <?php echo $_SESSION['username']; ?></h2>

        <div class="alert alert-warning shadow-sm border-0" role="alert">
            Lengkapi profil Anda dan verifikasi email untuk menyelesaikan pendaftaran.
        </div>

        <div class="row mt-4">
            <div class="col-md-3 mb-4">
                <div class="list-group shadow-sm">
                    <a href="profil.php" class="list-group-item list-group-item-action active">👤 Profil Akun</a>
                    <a href="pesanan.php" class="list-group-item list-group-item-action">🛍️ Riwayat Pesanan</a>
                    <a href="logout.php" class="list-group-item list-group-item-action text-danger fw-bold">🚪 Logout</a>
                </div>
            </div>

            <div class="col-md-9">

                <div class="card card-profil p-4">
                    <h5 class="fw-bold mb-4">EDIT PROFILE</h5>
                    
                    <form action="proses_edit_profil.php" method="POST" enctype="multipart/form-data">
                        
                        <div class="mb-4 text-center">
                            <?php
                            $fotoPath = "assets/foto/" . $_SESSION['foto'];
                            if (!empty($_SESSION['foto']) && file_exists($fotoPath)) {
                                echo '<img src="' . $fotoPath . '" class="preview-foto shadow-sm">';
                            } else {
                                echo '<img src="assets/foto/default.png" class="preview-foto shadow-sm">';
                            }
                            ?>
                            <br>
                            <label class="form-label text-muted small fw-bold">Ubah Foto Profil</label>
                            <input type="file" class="form-control form-control-sm w-50 mx-auto" name="foto" accept="image/*">
                            <small class="text-muted" style="font-size: 0.7rem;">Format yang diizinkan: JPG, PNG, JPEG</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" value="<?php echo $_SESSION['username']; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan alamat lengkap pengiriman..."></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold d-block">Jenis Kelamin</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" checked>
                                <label class="form-check-label">Laki-Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan">
                                <label class="form-check-label">Wanita</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-main">Save Changes</button>
                    </form>
                </div>

                <div class="card card-profil p-4">
                    <h5 class="fw-bold mb-3">ACCOUNT INFO</h5>
                    <form action="proses_edit_kontak.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Mobile Number</label>
                            <input type="text" class="form-control" name="telp" placeholder="+62 8xx xxxx xxxx">
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="email_kamu@gmail.com">
                        </div>
                        <button type="submit" class="btn btn-main">Save Changes</button>
                    </form>
                </div>

                <div class="card card-profil p-4">
                    <h5 class="fw-bold mb-3">CHANGE PASSWORD</h5>
                    <form action="proses_ubah_password.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Old Password</label>
                            <input type="password" class="form-control" name="old_password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">New Password</label>
                            <input type="password" class="form-control" name="new_password">
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password">
                        </div>
                        <button type="submit" class="btn btn-main">Save Changes</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <footer class="text-white text-center py-3 mt-auto" style="background: #561c24;">
        <p class="mb-0">&copy; <?php echo date("Y"); ?> Toko Biji Kopi. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>