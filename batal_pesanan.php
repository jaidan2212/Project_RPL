<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = (int) $_GET['id'];

$cek = $koneksi->query("
    SELECT status 
    FROM pesanan_header
    WHERE id='$id'
")->fetch_assoc();

if (!$cek) {
    die("Pesanan tidak ditemukan");
}

$status = strtolower(trim($cek['status']));

// hanya boleh membatalkan pesanan yang sudah lunas
if ($status != 'lunas') {
    echo "<script>
    alert('Pesanan belum lunas');
    window.location='admin.php';
    </script>";
    exit;
}

// kembalikan stok
$detail = $koneksi->query("
    SELECT * 
    FROM pesanan_detail
    WHERE id_pesanan='$id'
");

while ($row = $detail->fetch_assoc()) {

    $produk_id = (int)$row['produk_id'];
    $jumlah = (int)$row['jumlah'];

    $koneksi->query("
        UPDATE produk
        SET stok = stok + $jumlah
        WHERE id = $produk_id
    ");
}

// ubah status jadi dibatalkan
$koneksi->query("
    UPDATE pesanan_header
    SET status='dibatalkan',
        pengambilan=NULL
    WHERE id='$id'
");

echo "<script>
alert('Pesanan berhasil dibatalkan');
window.location='admin.php';
</script>";
?>