<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username_skrg = $_SESSION['username'];
$query = $koneksi->query("SELECT * FROM users WHERE username='$username_skrg'");
$user = $query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Akun - Kedaiku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #c7b7a3; color: #333; }
        .bg-velvet { background-color: #561c24 !important; color: white !important; }
        .text-velvet { color: #561c24 !important; }
        .list-group-item { font-weight: 600; border: 1px solid #e8d8c4; padding: 15px 20px; color: #561c24; }
        .list-group-item:hover { background-color: #e8d8c4; }
        .list-group-item.active { background-color: #561c24 !important; border-color: #561c24 !important; color: white; }
        .card-profil { background: #fff; border: none; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .btn-main { background-color: #6d2932; color: white; font-weight: 600; border: none; padding: 10px 25px; border-radius: 5px; transition: 0.3s; }
        .btn-main:hover { background-color: #561c24; color: white; transform: translateY(-2px); }
        .preview-foto { width: 120px; height: 120px; object-fit: cover; border-radius: 50%; border: 4px solid #e8d8c4; margin-bottom: 10px; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include 'layout/header.php'; ?>
    <div class="container my-5 flex-grow-1">
        <h2 class="fw-bold text-velvet mb-4">Hi, <?php echo $user['username']; ?></h2>
        <div class="row mt-4">
            <div class="col-md-3 mb-4">
                <div class="list-group shadow-sm">
                    <a href="profil.php" class="list-group-item list-group-item-action active"><i class="fa-solid fa-user me-2"></i> Profil Akun</a>
                    <a href="pesanan.php" class="list-group-item list-group-item-action"><i class="fa-solid fa-bag-shopping me-2"></i> Riwayat Pesanan</a>
                    <a href="logout.php" class="list-group-item list-group-item-action text-danger fw-bold"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a>
                </div>
            </div>
            <div class="col-md-9">
                <?php if(isset($_GET['status'])): ?>
                    <?php if($_GET['status'] == 'success'): ?>
                        <div class="alert alert-success alert-dismissible fade show"><strong>Berhasil!</strong> Data profil telah diperbarui.<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
                    <?php elseif($_GET['status'] == 'pass_success'): ?>
                        <div class="alert alert-success alert-dismissible fade show"><strong>Berhasil!</strong> Password telah diubah.<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
                    <?php elseif($_GET['status'] == 'pass_mismatch'): ?>
                        <div class="alert alert-danger alert-dismissible fade show"><strong>Gagal!</strong> Konfirmasi password tidak cocok.<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
                    <?php elseif($_GET['status'] == 'old_wrong'): ?>
                        <div class="alert alert-danger alert-dismissible fade show"><strong>Gagal!</strong> Password lama salah.<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="card card-profil p-4">
                    <h5 class="fw-bold mb-4 text-velvet border-bottom pb-2">EDIT PROFILE</h5>
                    <form action="proses_edit_profil.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-4 text-center">
                            <?php $fotoProfil = !empty($user['foto']) ? "assets/foto/" . $user['foto'] : "assets/foto/default.png"; ?>
                            <img src="<?php echo $fotoProfil; ?>" class="preview-foto shadow-sm">
                            <br>
                            <label class="form-label text-muted small fw-bold">Ubah Foto Profil</label>
                            <input type="file" class="form-control form-control-sm w-50 mx-auto" name="foto" accept="image/*">
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $user['username']; ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Nomor Telepon</label>
                            <input type="text" class="form-control" name="telp" value="<?php echo $user['telp'] ?? ''; ?>" placeholder="+62 8xx xxxx xxxx">
                        </div>
                        <button type="submit" class="btn btn-main w-100">Simpan Perubahan</button>
                    </form>
                </div>

                <div class="card card-profil p-4">
                    <h5 class="fw-bold mb-3 text-velvet border-bottom pb-2">GANTI PASSWORD</h5>
                    <form action="proses_ubah_password.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Password Lama</label>
                            <input type="password" class="form-control" name="old_password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Password Baru</label>
                            <input type="password" class="form-control" name="new_password" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-main w-100">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'layout/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>