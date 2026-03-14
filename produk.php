<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Produk Kopi</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/css/style.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<style>

body{
font-family:'Poppins',sans-serif;
background:#c7b7a3;
}

.container{
background:#e8d8c4;
padding:40px;
border-radius:10px;
}

h1{
font-family:'Playfair Display',serif;
color:#561c24;
}

.product-card{
background:white;
border:none;
transition:0.3s;
box-shadow:0 4px 10px rgba(0,0,0,0.15);
}

.product-card:hover{
box-shadow:0 8px 20px rgba(0,0,0,0.25);
transform:translateY(-5px);
}

.big-check{
transform:scale(1.4);
margin-right:10px;
}

.qty-input{
width:80px;
text-align:center;
font-weight:bold;
border:2px solid #6d2932;
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

.promo-section{
background:#6d2932;
color:white;
}

</style>

</head>
<body>

<?php include 'layout/header.php'; ?>


<div class="container my-5">

<h1 class="text-center mb-4">Daftar Produk Kopi</h1>

<form method="post" action="checkout.php">

<div class="row">

<?php
$result=$koneksi->query("SELECT * FROM produk");

if($result->num_rows>0){

while($row=$result->fetch_assoc()){
?>

<div class="col-md-3 col-sm-6 mb-4">

<div class="card product-card h-100">

<img src="assets/gambar/<?php echo $row['gambar']; ?>"
class="card-img-top"
style="height:200px;object-fit:cover;">

<div class="card-body text-center">

<h5 class="card-title fw-bold"><?php echo $row['nama']; ?></h5>

<p class="card-text fw-bold">
Rp <?php echo number_format($row['harga'],0,',','.'); ?>
</p>

<div class="d-flex justify-content-center align-items-center mb-2">

<input class="form-check-input big-check"
type="checkbox"
name="produk_id[]"
value="<?php echo $row['id']; ?>">

<label class="form-check-label fw-bold">
Pilih Produk
</label>

</div>

<input type="number"
name="jumlah[<?php echo $row['id']; ?>]"
class="form-control qty-input mx-auto"
min="1"
value="1">

</div>

</div>

</div>

<?php
}
}else{
echo "<p class='text-center'>Belum ada produk tersedia.</p>";
}
?>

</div>

<div class="text-center mt-4">

<button type="submit" class="btn btn-main btn-lg">
Pesan Sekarang
</button>

</div>

</form>

</div>


<div class="promo-section py-5 text-center">

<h2 class="mb-3">Promo Spesial!</h2>

<p class="lead fw-bold">
Diskon 20% untuk pembelian pertama 🎉
</p>

<p>Gratis ongkir untuk wilayah Jawa Timur</p>

</div>


<?php include 'layout/footer.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>