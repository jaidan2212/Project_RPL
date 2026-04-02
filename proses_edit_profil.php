<?php
session_start();
include 'koneksi.php';

if (isset($_POST['nama'])) {
    $username = $_SESSION['username'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jk = $_POST['jenis_kelamin'];

    // Cek apakah ada foto baru yang diupload
    if ($_FILES['foto']['name'] != "") {
        $uploadDir = "assets/foto/";
        $fotoName = time() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], $uploadDir . $fotoName);
        
        $sql = "UPDATE users SET nama_lengkap='$nama', jenis_kelamin='$jk', foto='$fotoName' WHERE username='$username'";
        $_SESSION['foto'] = $fotoName; // Update session foto
    } else {
        $sql = "UPDATE users SET nama_lengkap='$nama', jenis_kelamin='$jk' WHERE username='$username'";
    }

    if ($koneksi->query($sql)) {
        header("Location: profil.php?status=success");
    } else {
        header("Location: profil.php?status=error");
    }
}