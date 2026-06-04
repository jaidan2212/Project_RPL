<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = (int) $_GET['id'];

$cek = $koneksi->query("SELECT pengambilan FROM pesanan_header WHERE id='$id'")->fetch_assoc();

if ($cek['pengambilan'] == 'diambil') {
    $koneksi->query("UPDATE pesanan_header SET pengambilan='belum' WHERE id='$id'");
} else {
    $koneksi->query("UPDATE pesanan_header SET pengambilan='diambil' WHERE id='$id'");
}

header("Location: admin.php");
exit;
?>