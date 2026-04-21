<?php
session_start();
include 'koneksi.php';

// Cek login admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // 1. Ambil detail barang dari pesanan_detail (Pakai nama kolom 'produk_id')
    $ambil_detail = $koneksi->query("SELECT produk_id, jumlah FROM pesanan_detail WHERE id_pesanan = '$id'");

    // 2. Balikin stok ke tabel produk
    while ($pecah = $ambil_detail->fetch_assoc()) {
        $id_produk = $pecah['produk_id']; // Sesuaikan dengan SELECT di atas
        $jumlah = $pecah['jumlah'];
        
        // Update stok di tabel produk (ditambah balik)
        $koneksi->query("UPDATE produk SET stok = stok + $jumlah WHERE id = '$id_produk'");
    }

    // 3. Update status di pesanan_header menjadi 'Dibatalkan'
    $query = $koneksi->query("UPDATE pesanan_header SET status = 'Dibatalkan' WHERE id = '$id'");

    if ($query) {
        echo "<script>alert('Pesanan #$id berhasil dibatalkan dan stok telah dikembalikan!'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('Gagal memproses pembatalan.'); window.location='admin.php';</script>";
    }
} else {
    header("Location: admin.php");
}
?>