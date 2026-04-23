<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/vendor/PHPMailer/src/Exception.php';
require 'assets/vendor/PHPMailer/src/PHPMailer.php';
require 'assets/vendor/PHPMailer/src/SMTP.php';
include 'koneksi.php';
session_start();

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $cek = $koneksi->query("SELECT * FROM users WHERE email='$email'");

    if ($cek->num_rows > 0) {
        $otp = rand(100000, 999999);
        $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));
        
        // Simpan OTP ke Database
        $koneksi->query("UPDATE users SET otp_code='$otp', otp_expiry='$expiry' WHERE email='$email'");
        $_SESSION['email_reset'] = $email;

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'fahdimas42@gmail.com'; // ISI EMAIL GMAILMU DI SINI
            $mail->Password = 'unubgvazeynvzkwd';    // App Password Dimas
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('no-reply@kedaiku.com', 'Kedaiku Coffee Shop');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Kode OTP Lupa Password - Kedaiku';
            $mail->Body    = "<h3>Halo!</h3><p>Kode OTP Anda adalah: <b style='font-size:24px;'>$otp</b></p><p>Kode ini berlaku selama 5 menit. Jangan berikan kode ini kepada siapapun.</p>";

            $mail->send();
            header("Location: verifikasi_otp.php");
        } catch (Exception $e) {
            echo "Gagal kirim email. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan!'); window.location='lupa_password.php';</script>";
    }
}
?>