<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = (int)$_GET['id'];

$cek = $koneksi->query("
    SELECT status
    FROM pesanan_header
    WHERE id='$id'
")->fetch_assoc();

if ($cek && strtolower($cek['status']) == 'lunas') {

    $koneksi->query("
        UPDATE pesanan_header
        SET pengambilan='diambil'
        WHERE id='$id'
    ");
}

header("Location: admin.php");
exit;
?>