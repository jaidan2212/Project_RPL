<?php
session_start();
include 'koneksi.php';

if (isset($_POST['telp'])) {
    $username = $_SESSION['username'];
    $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);

    // Query hanya update telp
    $sql = "UPDATE users SET telp='$telp' WHERE username='$username'";

    if ($koneksi->query($sql)) {
        header("Location: profil.php?status=success");
    } else {
        header("Location: profil.php?status=error");
    }
} else {
    header("Location: profil.php");
}
?>