<?php
session_start();
include 'koneksi.php';

if (isset($_POST['old_password'])) {
    $username = $_SESSION['username'];
    $old_pass = $_POST['old_password'];
    $new_pass = $_POST['new_password'];
    $conf_pass = $_POST['confirm_password'];

    $query = $koneksi->query("SELECT password FROM users WHERE username='$username'");
    $user = $query->fetch_assoc();

    // Verifikasi password lama menggunakan password_verify
    if (password_verify($old_pass, $user['password'])) {
        if ($new_pass === $conf_pass) {
            $hash_baru = password_hash($new_pass, PASSWORD_DEFAULT);
            $koneksi->query("UPDATE users SET password='$hash_baru' WHERE username='$username'");
            header("Location: profil.php?status=pass_success");
        } else {
            header("Location: profil.php?status=pass_mismatch");
        }
    } else {
        header("Location: profil.php?status=old_wrong");
    }
} else {
    header("Location: profil.php");
}
?>