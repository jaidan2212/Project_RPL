<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php'; 

$produkDipilih = isset($_POST['produk_id']) ? $_POST['produk_id'] : [];
$jumlahDipilih = isset($_POST['jumlah']) ? $_POST['jumlah'] : [];

$daftarProduk = [];
$total = 0;

foreach($produkDipilih as $id){
    $id = (int)$id;
    $result = $koneksi->query("SELECT * FROM produk WHERE id='$id'");
    if($result && $result->num_rows > 0){
        $produk = $result->fetch_assoc();
        $qty = isset($jumlahDipilih[$id]) ? (int)$jumlahDipilih[$id] : 1;
        $subtotal = $produk['harga'] * $qty;
        $daftarProduk[] = [
            'id' => $produk['id'],
            'nama' => $produk['nama'],
            'harga' => $produk['harga'],
            'jumlah' => $qty,
            'subtotal' => $subtotal
        ];
        $total += $subtotal;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Checkout - Toko Biji Kopi</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<style>

body{
background:#c7b7a3;
font-family:'Poppins',sans-serif;
min-height:100vh;
display:flex;
flex-direction:column;
}

h2{
font-family:'Playfair Display',serif;
color:#561c24;
}

.navbar-custom{
background:#561c24;
}

.checkout-card{
background:#e8d8c4;
border:none;
box-shadow:0 6px 18px rgba(0,0,0,0.2);
}

.btn-main{
background:#6d2932;
color:white;
border:none;
}

.btn-main:hover{
background:#561c24;
color:white;
}

footer{
background:#561c24;
margin-top:auto;
}

</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
<div class="container">

<a class="navbar-brand fw-bold" href="index.php">☕ Kopiku</a>

<div class="collapse navbar-collapse">
<ul class="navbar-nav ms-auto">
<li class="nav-item">
<a class="nav-link text-warning fw-bold" href="produk.php">← Batal & Kembali</a>
</li>
</ul>
</div>

</div>
</nav>


<div class="container my-5">

<h2 class="text-center mb-4">Selesaikan Pembayaran</h2>

<?php if(empty($daftarProduk)){ ?>

<div class="alert alert-danger text-center">
Tidak ada produk dipilih. Silakan kembali ke halaman produk.
</div>

<?php } else { ?>

<div class="row justify-content-center">

<div class="col-md-8">

<div class="card checkout-card p-4">

<h4 class="mb-3 fw-bold">Ringkasan Pesanan</h4>

<ul class="list-group mb-3">

<?php foreach($daftarProduk as $p){ ?>

<li class="list-group-item d-flex justify-content-between align-items-center">

<?php echo htmlspecialchars($p['nama']); ?> (x<?php echo $p['jumlah']; ?>)

<span>
Rp <?php echo number_format($p['subtotal'],0,',','.'); ?>
</span>

</li>

<?php } ?>

</ul>

<h5 class="fw-bold mb-4">

Total Tagihan:  
Rp <?php echo number_format($total,0,',','.'); ?>

</h5>


<div class="alert alert-warning">

<strong>Instruksi Pembayaran:</strong><br>

Silakan transfer tepat sejumlah  
<b>Rp <?php echo number_format($total,0,',','.'); ?></b>  
ke salah satu rekening berikut:

<br><br>

💳 <b>BCA:</b> 1234567890 a.n Toko Biji Kopi<br>
📱 <b>DANA:</b> 081234567890 a.n Toko Biji Kopi

</div>


<form method="post" action="proses_pesanan.php" enctype="multipart/form-data">

<?php foreach($daftarProduk as $p){ ?>

<input type="hidden" name="produk_id[]" value="<?php echo $p['id']; ?>">

<input type="hidden" name="jumlah[<?php echo $p['id']; ?>]" value="<?php echo $p['jumlah']; ?>">

<?php } ?>


<div class="mb-3">

<label class="form-label fw-bold">Nama Lengkap</label>

<input type="text" name="nama" class="form-control"
value="<?php echo $_SESSION['username']; ?>" required>

</div>


<div class="mb-3">

<label class="form-label fw-bold">Email</label>

<input type="email" name="email" class="form-control" required>

</div>


<div class="mb-3">

<label class="form-label fw-bold">Metode Pembayaran</label>

<select name="pembayaran" class="form-select" required>

<option value="Transfer BCA">Transfer Bank (BCA)</option>

<option value="E-Wallet DANA">E-Wallet (DANA)</option>

</select>

</div>


<div class="mb-4">

<label class="form-label fw-bold text-danger">

Upload Bukti Transfer (Wajib)

</label>

<input type="file"
name="bukti"
class="form-control border-danger"
accept="image/*"
required>

</div>


<button type="submit" class="btn btn-main w-100 fw-bold py-2">

Kirim Pesanan & Bukti Bayar

</button>

</form>

</div>
</div>
</div>

<?php } ?>

</div>


<footer class="text-white text-center py-3">

<p>&copy; <?php echo date("Y"); ?> Toko Biji Kopi. All rights reserved.</p>

</footer>

</body>
</html>