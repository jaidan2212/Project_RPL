<?php
session_start();
include 'koneksi.php';

if (isset($_POST['otp'])) {
    $otp = $_POST['otp'];
    $email = $_SESSION['email_reset'];

    $result = $koneksi->query("SELECT * FROM users WHERE email='$email' AND otp_code='$otp'");
    $user = $result->fetch_assoc();

    if ($user && strtotime($user['otp_expiry']) > time()) {
        // OTP Benar dan Belum Expired
        header("Location: reset_password.php");
    } else {
        echo "<script>alert('Kode OTP salah atau sudah kadaluarsa!'); window.location='verifikasi_otp.php';</script>";
    }
}
?>