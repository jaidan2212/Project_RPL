<?php include 'koneksi.php'; ?>
<?php
$produkDipilih = isset($_POST['produk_id']) ? $_POST['produk_id'] : [];
$jumlahDipilih = isset($_POST['jumlah']) ? $_POST['jumlah'] : [];

$daftarProduk = [];
$total = 0;

foreach($produkDipilih as $id){
    $produk = $koneksi->query("SELECT * FROM produk WHERE id='$id'")->fetch_assoc();
    if($produk){
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
<title>Checkout Produk</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{
font-family:'Poppins',sans-serif;
background:linear-gradient(135deg,#f5f0e1,#e0c097);
min-height:100vh;
display:flex;
flex-direction:column;
}

.checkout-card{
background:#fff8f0;
border:none;
box-shadow:0 4px 15px rgba(0,0,0,0.2);
}

footer{
background:#3e2723;
margin-top:auto;
}

.bank-option{
cursor:pointer;
}

</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
<a class="navbar-brand fw-bold" href="index.php">☕ Toko Kopi</a>
</div>
</nav>

<div class="container my-5">

<h1 class="text-center mb-4">Checkout Produk</h1>

<?php if(empty($daftarProduk)){ ?>

<div class="alert alert-danger text-center">
Tidak ada produk dipilih. Silakan kembali ke halaman produk.
</div>

<?php } else { ?>

<div class="row justify-content-center">
<div class="col-md-8">

<div class="card checkout-card p-4">

<h4 class="mb-3">Produk yang Anda pilih:</h4>

<ul class="list-group mb-3">

<?php foreach($daftarProduk as $p){ ?>

<li class="list-group-item d-flex justify-content-between align-items-center">
<?php echo $p['nama']; ?> (x<?php echo $p['jumlah']; ?>)
<span>Rp <?php echo number_format($p['subtotal'],0,',','.'); ?></span>
</li>

<?php } ?>

</ul>

<h5>Total: Rp <?php echo number_format($total,0,',','.'); ?></h5>

<form method="post" action="proses_pesanan.php" enctype="multipart/form-data">

<?php foreach($daftarProduk as $p){ ?>

<input type="hidden" name="produk_id[]" value="<?php echo $p['id']; ?>">
<input type="hidden" name="jumlah[<?php echo $p['id']; ?>]" value="<?php echo $p['jumlah']; ?>">

<?php } ?>

<div class="mb-3">
<label class="form-label">Nama Pembeli</label>
<input type="text" name="nama" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Metode Pembayaran</label>

<select name="pembayaran" id="metode_pembayaran" class="form-select" onchange="tampilMetode()" required>

<option value="">Pilih Metode Pembayaran</option>
<option value="Transfer Bank">Transfer Bank</option>
<option value="E-Wallet">E-Wallet (QRIS)</option>

</select>
</div>


<<<<<<< HEAD
<<<<<<< HEAD
<!-- transfer bank -->
=======
<!-- BANK -->
>>>>>>> ac962ed (update payment terbaru)
=======
<!-- transfer bank -->
>>>>>>> 574138b (update payment sementara)

<div id="bank_section" style="display:none;" class="mt-3">

<h5>Pilih Bank</h5>

<div class="card p-3 mb-2 bank-option" onclick="pilihBank('BCA')">
🏦 Bank BCA
</div>

<div class="card p-3 mb-2 bank-option" onclick="pilihBank('BRI')">
🏦 Bank BRI
</div>

<div class="card p-3 mb-2 bank-option" onclick="pilihBank('Mandiri')">
🏦 Bank Mandiri
</div>

</div>


<!-- DETAIL REKENING -->

<div id="detail_rekening" style="display:none;" class="alert alert-info mt-3">

<h5 id="nama_bank"></h5>

<p>No Rekening : <span id="no_rek"></span></p>

<p>a.n Toko Kopi</p>

<label class="form-label">Upload Bukti Transfer</label>

<input type="file" name="bukti" id="bukti_transfer" class="form-control">

</div>


<!-- QRIS -->

<div id="ewallet_section" style="display:none;" class="alert alert-success mt-3">

<h5>Pembayaran E-Wallet (QRIS)</h5>

<p>Silakan scan QRIS berikut:</p>

<img src="assets/gambar/qris.png" width="250" class="img-fluid mb-3">

<label class="form-label">Upload Bukti Pembayaran QRIS</label>

<input type="file" name="bukti" id="bukti_qris" class="form-control">

</div>


<button type="submit" class="btn btn-success w-100 mt-3">
Pesan Sekarang
</button>

</form>

</div>
</div>
</div>

<?php } ?>

</div>

<footer class="text-white text-center py-3">
<p>&copy; <?php echo date("Y"); ?> Toko Biji Kopi</p>
</footer>

<script>

function tampilMetode(){

var metode=document.getElementById("metode_pembayaran").value;

document.getElementById("bank_section").style.display="none";
document.getElementById("detail_rekening").style.display="none";
document.getElementById("ewallet_section").style.display="none";

if(metode=="Transfer Bank"){
document.getElementById("bank_section").style.display="block";
}

if(metode=="E-Wallet"){
document.getElementById("ewallet_section").style.display="block";
}

}

function pilihBank(bank){

document.getElementById("detail_rekening").style.display="block";

if(bank=="BCA"){
document.getElementById("nama_bank").innerText="Bank BCA";
document.getElementById("no_rek").innerText="1234567890";
}

if(bank=="BRI"){
document.getElementById("nama_bank").innerText="Bank BRI";
document.getElementById("no_rek").innerText="9876543210";
}

if(bank=="Mandiri"){
document.getElementById("nama_bank").innerText="Bank Mandiri";
document.getElementById("no_rek").innerText="1122334455";
}

}

document.querySelector("form").addEventListener("submit",function(e){

var metode=document.getElementById("metode_pembayaran").value;

var buktiTransfer=document.getElementById("bukti_transfer").files.length;
var buktiQris=document.getElementById("bukti_qris").files.length;

if(metode=="Transfer Bank" && buktiTransfer==0){
alert("Silakan upload bukti transfer terlebih dahulu.");
e.preventDefault();
}

if(metode=="E-Wallet" && buktiQris==0){
alert("Silakan upload bukti pembayaran QRIS terlebih dahulu.");
e.preventDefault();
}

});

</script>

</body>
</html>