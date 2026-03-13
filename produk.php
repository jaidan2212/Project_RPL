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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f0e1, #e0c097);
        }
        h1 { font-family: 'Playfair Display', serif; }
        .product-card {
            background-color: #fff8f0;
            border: none;
            transition: 0.3s;
        }
        .product-card:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transform: translateY(-5px);
        }
        .big-check {
            transform: scale(1.5); 
            margin-right: 10px;
        }
        .qty-input {
            width: 80px;
            text-align: center;
            font-weight: bold;
        }
        footer { background: #3e2723; }
        .foto-user {
            width:30px;
            height:30px;
            border-radius:50%;
            object-fit:cover;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">☕ Toko Kopi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarNav" aria-controls="navbarNav" 
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link active" href="produk.php">Produk</a></li>
        <?php if(isset($_SESSION['username'])){ ?>
          <li class="nav-item d-flex align-items-center">
            <?php 
            $fotoPath = "assets/foto/".$_SESSION['foto'];
            if(!empty($_SESSION['foto']) && file_exists($fotoPath)){ ?>
                <img src="<?php echo $fotoPath; ?>" class="foto-user me-2">
            <?php } else { ?>
                <img src="assets/foto/default.png" class="foto-user me-2">
            <?php } ?>
            <span class="nav-link">Hai, <?php echo $_SESSION['username']; ?></span>
          </li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php } else { ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-5">
  <h1 class="text-center mb-4">Daftar Produk Kopi</h1>
  <form method="post" action="checkout.php">
    <div class="row">
      <?php
      $result = $koneksi->query("SELECT * FROM produk");
      if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
      ?>
      <div class="col-md-3 mb-4">
        <div class="card product-card h-100">
          <img src="assets/gambar/<?php echo $row['gambar']; ?>" 
               class="card-img-top" 
               alt="<?php echo $row['nama']; ?>" 
               style="height:200px; object-fit:cover;">
          <div class="card-body text-center">
            <h5 class="card-title"><?php echo $row['nama']; ?></h5>
            <p class="card-text">Rp <?php echo number_format($row['harga'],0,',','.'); ?></p>
            
            <div class="d-flex justify-content-center align-items-center mb-2">
              <input class="form-check-input big-check" type="checkbox" 
                     name="produk_id[]" value="<?php echo $row['id']; ?>">
              <label class="form-check-label fw-bold">Pilih Produk</label>
            </div>
            <input type="number" name="jumlah[<?php echo $row['id']; ?>]" 
                   class="form-control qty-input mx-auto" min="1" value="1">
          </div>
        </div>
      </div>
      <?php
          }
      } else {
          echo "<p class='text-center'>Belum ada produk tersedia.</p>";
      }
      ?>
    </div>
    <div class="text-center mt-4">
      <button type="submit" class="btn btn-success btn-lg">Pesan Sekarang</button>
    </div>
  </form>
</div>

<div class="bg-warning py-5 text-center">
  <h2 class="mb-3">Promo Spesial!</h2>
  <p class="lead fw-bold">Diskon 20% untuk pembelian pertama 🎉</p>
  <p>Gratis ongkir untuk wilayah Jawa Timur</p>
  <a href="produk.php" class="btn btn-dark btn-lg">Belanja Sekarang</a>
</div>

<footer class="text-white text-center py-3">
    <p>&copy; <?php echo date("Y"); ?> Toko Biji Kopi. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>