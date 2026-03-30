<?php
session_start();
include 'koneksi.php';

// Proteksi: Cuma admin yang boleh masuk
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id_pesanan = $_GET['id'];

    // Update status di database
    $sql = "UPDATE pesanan_header SET status='Terverifikasi' WHERE id='$id_pesanan'";

    if ($koneksi->query($sql)) {
        echo "<script>alert('Pesanan berhasil diverifikasi!'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('Gagal memverifikasi pesanan.'); window.location='admin.php';</script>";
    }
} else {
    header("Location: admin.php");
}
