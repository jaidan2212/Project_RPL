<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = (int) $_GET['id'];

// ambil data status
$cek = $koneksi->query("SELECT status FROM pesanan_header WHERE id='$id'")->fetch_assoc();

if (!$cek) {
    die("Pesanan tidak ditemukan");
}

$status = strtolower(trim($cek['status']));

// hanya boleh dari pending / dibatalkan
if ($status == 'lunas') {
    echo "<script>alert('Sudah lunas'); window.location='admin.php';</script>";
    exit;
}

// UPDATE STATUS
$update = $koneksi->query("UPDATE pesanan_header SET status='lunas' WHERE id='$id'");

// kalau berhasil
if ($update) {

    // kurangi stok
    $detail = $koneksi->query("SELECT * FROM pesanan_detail WHERE id_pesanan='$id'");

    while ($row = $detail->fetch_assoc()) {

        $produk_id = (int) $row['produk_id'];
        $jumlah = (int) $row['jumlah'];

        $koneksi->query("
            UPDATE produk 
            SET stok = stok - $jumlah 
            WHERE id = $produk_id
        ");
    }

    echo "<script>
    alert('Pesanan berhasil diverifikasi');
    window.location='admin.php';
    </script>";

} else {
    echo "<script>
    alert('Gagal verifikasi pesanan');
    window.location='admin.php';
    </script>";
}
?>