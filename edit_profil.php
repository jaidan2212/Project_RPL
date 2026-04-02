<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username_session = $_SESSION['username'];
$query = $koneksi->query("SELECT * FROM users WHERE username = '$username_session'");
$user = $query->fetch_assoc();

if (isset($_POST['update_profil'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $jk = $_POST['jenis_kelamin'];

    $sql = "UPDATE users SET nama_lengkap='$nama', email='$email', telp='$telp', alamat='$alamat', jenis_kelamin='$jk' WHERE username='$username_session'";
    
    if ($koneksi->query($sql)) {
        $success = "Profil berhasil diperbarui!";
        // Refresh data di variabel user
        $query = $koneksi->query("SELECT * FROM users WHERE username = '$username_session'");
        $user = $query->fetch_assoc();
    } else {
        $error = "Gagal memperbarui profil: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil - Kedaiku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background: #c7b7a3; font-family: 'Poppins', sans-serif; }
        .profile-card { background: #fdf5e6; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); padding: 30px; }
        .btn-main { background: #561c24; color: white; border-radius: 10px; transition: 0.3s; }
        .btn-main:hover { background: #6d2932; color: white; transform: translateY(-2px); }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <?php include 'layout/header.php'; ?>

    <div class="container my-5 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card profile-card">
                    <h3 class="fw-bold mb-4" style="color: #561c24;"><i class="fa-solid fa-user-gear me-2"></i> Pengaturan Profil</h3>

                    <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

                    <form method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Username (Tetap)</label>
                                <input type="text" class="form-control bg-light" value="<?php echo $user['username']; ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $user['nama_lengkap']; ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Nomor Telepon</label>
                                <input type="text" name="telp" class="form-control" value="<?php echo $user['telp']; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select">
                                    <option value="Laki-laki" <?php if($user['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                    <option value="Perempuan" <?php if($user['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3"><?php echo $user['alamat']; ?></textarea>
                        </div>

                        <button type="submit" name="update_profil" class="btn btn-main w-100 py-2 fw-bold">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'layout/footer.php'; ?>

</body>
</html>