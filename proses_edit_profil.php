<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_lama = $_SESSION['username'];
    $username_baru = mysqli_real_escape_string($koneksi, $_POST['username']);
    $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);
    
    // Ambil data lama untuk foto
    $query_lama = $koneksi->query("SELECT foto FROM users WHERE username='$username_lama'");
    $data_lama = $query_lama->fetch_assoc();
    $nama_foto = $data_lama['foto'];

    // Cek jika ada upload foto baru
    if (!empty($_FILES['foto']['name'])) {
        $nama_foto = time() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "assets/foto/" . $nama_foto);
    }

    $query = "UPDATE users SET username='$username_baru', telp='$telp', foto='$nama_foto' WHERE username='$username_lama'";
    
    if ($koneksi->query($query)) {
        $_SESSION['username'] = $username_baru;
        header("Location: profil.php?status=success");
    } else {
        echo "Error: " . $koneksi->error;
    }
}
?>