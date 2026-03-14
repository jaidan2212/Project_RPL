<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Toko Biji Kopi</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

  <style>

    body{
    font-family:'Poppins',sans-serif;
    background:#c7b7a3;
    }

    h1,h2,h3{
    font-family:'Playfair Display',serif;
    color:#561c24;
    }

    .navbar-custom{
    background:#561c24 !important;
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

    .card-custom{
    background:#e8d8c4;
    border:none;
    transition:0.3s;
    }

    .card-custom:hover{
    transform:translateY(-5px);
    box-shadow:0 6px 18px rgba(0,0,0,0.2);
    }

    .section-dark{
    background:#561c24;
    color:white;
    }

    .section-light{
    background:#e8d8c4;
    }

    .foto-user{
    width:30px;
    height:30px;
    border-radius:50%;
    object-fit:cover;
    }

    footer{
    background:#561c24;
    }

    .carousel-caption{
    background:rgba(0,0,0,0.4);
    padding:20px;
    border-radius:10px;
    }

  </style>

</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
  <div class="container">

  <a class="navbar-brand fw-bold" href="index.php">☕ Kopiku</a>

  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
  <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">

  <ul class="navbar-nav ms-auto">

  <li class="nav-item">
  <a class="nav-link active" href="index.php">Home</a>
  </li>

  <li class="nav-item">
  <a class="nav-link" href="produk.php">Produk</a>
  </li>

  <?php if(isset($_SESSION['username'])){ ?>

  <?php if(isset($_SESSION['role']) && $_SESSION['role']=="admin"){ ?>

  <li class="nav-item">
  <a class="nav-link text-warning fw-bold" href="admin.php">⚙️ Dashboard Admin</a>
  </li>

  <?php } ?>

  <li class="nav-item d-flex align-items-center ms-3">

  <?php
  $fotoPath="assets/foto/".$_SESSION['foto'];

  if(!empty($_SESSION['foto']) && file_exists($fotoPath)){
  ?>

  <img src="<?php echo $fotoPath ?>" class="foto-user me-2">

  <?php } else { ?>

  <img src="assets/foto/default.png" class="foto-user me-2">

  <?php } ?>

  <span class="nav-link">Hai, <?php echo $_SESSION['username']; ?></span>

  </li>

  <li class="nav-item">
  <a class="nav-link" href="logout.php">Logout</a>
  </li>

  <?php } else { ?>

  <li class="nav-item">
  <a class="nav-link" href="login.php">Login</a>
  </li>

  <?php } ?>

  </ul>

  </div>
  </div>
  </nav>


  <div id="kopiCarousel" class="carousel slide" data-bs-ride="carousel">

  <div class="carousel-inner">

  <div class="carousel-item active">

  <img src="assets/gambar/Index.jpg" class="d-block w-100" style="height:450px;object-fit:cover;">

  <div class="carousel-caption">

  <h2 class="fw-bold text-white">Nikmati Kopi Premium Setiap Hari</h2>
  <p class="text-white">Rasakan kebahagiaan di setiap tegukan.</p>

  <?php if(isset($_SESSION['username'])){ ?>

  <a href="produk.php" class="btn btn-main btn-lg">Belanja Sekarang</a>

  <?php } else { ?>

  <a href="login.php" class="btn btn-light btn-lg">Login untuk Belanja</a>

  <?php } ?>

  </div>

  </div>


  <div class="carousel-item">

  <img src="assets/gambar/Index2.jpg" class="d-block w-100" style="height:450px;object-fit:cover;">

  <div class="carousel-caption">

  <h2 class="fw-bold text-white">Robusta: Energi untuk Aktivitasmu</h2>
  <p class="text-white">Kopi pekat yang bikin fokus sepanjang hari.</p>

  </div>

  </div>


  <div class="carousel-item">

  <img src="assets/gambar/Index3.jpg" class="d-block w-100" style="height:450px;object-fit:cover;">

  <div class="carousel-caption">

  <h2 class="fw-bold text-white">Liberica: Aroma yang Memikat</h2>
  <p class="text-white">Unik, eksotis, dan bikin penasaran.</p>

  </div>

  </div>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#kopiCarousel" data-bs-slide="prev">
  <span class="carousel-control-prev-icon"></span>
  </button>

  <button class="carousel-control-next" type="button" data-bs-target="#kopiCarousel" data-bs-slide="next">
  <span class="carousel-control-next-icon"></span>
  </button>

  </div>



  <div class="container my-5">

  <div class="row text-center">

  <div class="col-md-4">
  <div class="card card-custom p-3 shadow-sm">
  <h3>Kualitas Premium</h3>
  <p>Biji kopi pilihan dengan cita rasa khas Indonesia.</p>
  </div>
  </div>

  <div class="col-md-4">
  <div class="card card-custom p-3 shadow-sm">
  <h3>Harga Terjangkau</h3>
  <p>Kopi berkualitas dengan harga bersahabat.</p>
  </div>
  </div>

  <div class="col-md-4">
  <div class="card card-custom p-3 shadow-sm">
  <h3>Pengiriman Cepat</h3>
  <p>Pesanan dikirim langsung ke rumah Anda.</p>
  </div>
  </div>

  </div>

  </div>



  <div class="container my-5">

  <h2 class="text-center mb-4">Produk Unggulan</h2>

  <div class="row">

  <?php
  $result=$koneksi->query("SELECT * FROM produk LIMIT 4");

  while($row=$result->fetch_assoc()){
  ?>

  <div class="col-md-3 mb-4">

  <div class="card card-custom h-100">

  <img src="assets/gambar/<?php echo $row['gambar']; ?>" class="card-img-top" style="height:200px;object-fit:cover;">

  <div class="card-body text-center">

  <h5 class="card-title fw-bold"><?php echo $row['nama']; ?></h5>

  <p class="fw-bold">Rp <?php echo number_format($row['harga'],0,',','.'); ?></p>

  <?php if(isset($_SESSION['username'])){ ?>

  <a href="produk.php?id=<?php echo $row['id']; ?>" class="btn btn-main btn-sm w-100">Pesan</a>

  <?php } else { ?>

  <a href="login.php" class="btn btn-main btn-sm w-100">Login untuk Pesan</a>

  <?php } ?>

  </div>

  </div>

  </div>

  <?php } ?>

  </div>

  </div>



  <div class="section-dark py-5 text-center">

  <h2 class="mb-3">Promo Spesial!</h2>
  <p class="lead fw-bold">Diskon 20% untuk pembelian pertama 🎉</p>
  <p>Gratis ongkir untuk wilayah Jawa Timur</p>

  <?php if(isset($_SESSION['username'])){ ?>

  <a href="produk.php" class="btn btn-light btn-lg">Belanja Sekarang</a>

  <?php } else { ?>

  <a href="login.php" class="btn btn-light btn-lg">Login untuk Belanja</a>

  <?php } ?>

  </div>



  <div class="section-light py-5">

  <div class="container text-center">

  <h2 class="mb-4">Tentang Kami</h2>

  <p class="lead">

  Toko Biji Kopi berdiri dengan misi mendukung petani lokal Indonesia.  
  Kami percaya setiap biji kopi punya cerita, dari kebun hingga cangkir Anda.

  </p>

  </div>

  </div>



  <footer class="text-white text-center py-3">

  <p>&copy; <?php echo date("Y"); ?> Toko Biji Kopi. All rights reserved.</p>

  </footer>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>