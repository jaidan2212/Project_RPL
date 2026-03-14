<?php
session_start();
include 'koneksi.php';

// Proteksi: hanya admin boleh masuk
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin - Kedaiku</title>

<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>

body{
font-family:'Poppins',sans-serif;
background:#c7b7a3;
}

.navbar-custom{
background:#561c24;
}

.admin-title{
color:#561c24;
font-weight:600;
}

.card-admin{
background:#e8d8c4;
border:none;
border-radius:10px;
}

.table thead{
background:#561c24;
color:white;
}

.btn-success{
background:#561c24;
border:none;
}

.btn-success:hover{
background:#6d2932;
}

</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
<div class="container">

<a class="navbar-brand fw-bold" href="admin.php">☕ Admin Kedaiku</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarNav">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link active" href="admin.php">Pesanan</a>
</li>

<li class="nav-item">
<a class="nav-link" href="kelola_produk.php">Kelola Produk</a>
</li>

<li class="nav-item">
<a class="nav-link" href="tambah_produk.php">Tambah Produk</a>
</li>

<li class="nav-item">
<a class="nav-link" href="tambah_admin.php">Tambah Admin</a>
</li>

<li class="nav-item">
<a class="nav-link text-warning fw-bold" href="logout.php">Logout</a>
</li>

</ul>

</div>
</div>
</nav>

<div class="container my-5">

<h2 class="mb-4 admin-title">Daftar Pesanan Masuk</h2>

<div class="card card-admin p-4 shadow-sm">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead>
<tr>
<th>ID</th>
<th>Nama</th>
<th>Pembayaran</th>
<th>Total Tagihan</th>
<th>Tanggal</th>
<th>Bukti Transfer</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

<?php
$query = $koneksi->query("SELECT * FROM pesanan_header ORDER BY id DESC");

if($query->num_rows > 0) {

while($row = $query->fetch_assoc()){

$status = $row['status'] ?? 'Menunggu Pembayaran';
$badgeColor = ($status == 'Terverifikasi') ? 'bg-success' : 'bg-warning text-dark';
?>

<tr>

<td class="fw-bold">#<?php echo $row['id']; ?></td>

<td><?php echo htmlspecialchars($row['nama']); ?></td>

<td><?php echo htmlspecialchars($row['pembayaran']); ?></td>

<td class="fw-bold text-danger">
Rp <?php echo number_format($row['total'],0,',','.'); ?>
</td>

<td>
<?php echo date('d-m-Y H:i', strtotime($row['tanggal'])); ?>
</td>

<td>

<?php if(!empty($row['bukti'])){ ?>

<a href="assets/gambar/<?php echo $row['bukti']; ?>" 
target="_blank" 
class="btn btn-outline-info btn-sm fw-bold">

Lihat Bukti 📄

</a>

<?php } else { ?>

<span class="text-muted small">Tidak Ada</span>

<?php } ?>

</td>

<td>
<span class="badge <?php echo $badgeColor; ?>">
<?php echo $status; ?>
</span>
</td>

<td>

<?php if($status != 'Terverifikasi'){ ?>

<a href="verifikasi_pesanan.php?id=<?php echo $row['id']; ?>" 
class="btn btn-success btn-sm fw-bold"
onclick="return confirm('Verifikasi pembayaran pesanan #<?php echo $row['id']; ?>?');">

Verifikasi ✓

</a>

<?php } else { ?>

<button class="btn btn-secondary btn-sm fw-bold" disabled>
Selesai
</button>

<?php } ?>

</td>

</tr>

<?php 
}

} else {

echo "<tr><td colspan='8' class='text-center py-4'>Belum ada pesanan masuk.</td></tr>";

}
?>

</tbody>

</table>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>