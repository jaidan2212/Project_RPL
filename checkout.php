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
  <title>Checkout Produk</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f5f0e1, #e0c097);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    h1,h2,h3 { font-family: 'Playfair Display', serif; }
    .checkout-card { background:#fff8f0; border:none; box-shadow:0 4px 15px rgba(0,0,0,0.2); }
    .btn-anim:hover { transform:scale(1.05); transition:0.3s; }
    footer { background:#3e2723; margin-top:auto; }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">☕ Toko Kopi</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="produk.php">Produk</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">Checkout</a></li>
        <li class="nav-item"><a class="nav-link text-warning fw-bold" href="produk.php">← Kembali</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-5">
  <h1 class="text-center mb-4">Checkout Produk</h1>

  <?php if(empty($daftarProduk)){ ?>
    <div class="alert alert-danger text-center">Tidak ada produk dipilih. Silakan kembali ke halaman produk.</div>
  <?php } else { ?>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card checkout-card p-4">
          <h4 class="mb-3">Produk yang Anda pilih:</h4>
          <ul class="list-group mb-3">
            <?php foreach($daftarProduk as $p){ ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo htmlspecialchars($p['nama']); ?> (x<?php echo $p['jumlah']; ?>)
                <span>Rp <?php echo number_format($p['subtotal'],0,',','.'); ?></span>
              </li>
            <?php } ?>
          </ul>
          <h5>Total: Rp <?php echo number_format($total,0,',','.'); ?></h5>

          <form method="post" action="proses_pesanan.php">
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
              <select name="pembayaran" class="form-select" required>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="COD">Cash on Delivery</option>
                <option value="E-Wallet">E-Wallet</option>
              </select>
            </div>
            <button type="submit" class="btn btn-success w-100 btn-anim">Pesan Sekarang</button>
          </form>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<footer class="text-white text-center py-3">
  <p>&copy; <?php echo date("Y"); ?> Toko Biji Kopi. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>