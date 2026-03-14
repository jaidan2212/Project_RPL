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
        body {
            font-family: 'Poppins', sans-serif;
            /* Tema Merah: Gradasi soft red/peach */
            background: linear-gradient(135deg, #fff0f0, #ffcccc); 
        }
        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
        }
        .btn-anim:hover {
            transform: scale(1.05);
            transition: 0.3s;
        }
        .feature-card {
            background-color: #ffffff;
            border: 1px solid #ffe5e5;
        }
        .feature-card:hover {
            box-shadow: 0 4px 15px rgba(139, 0, 0, 0.2); /* Shadow kemerahan */
            transform: translateY(-5px);
            transition: 0.3s;
        }
        .navbar-custom {
            background-color: #8B0000 !important; /* Merah Marun */
        }
        footer {
            background: #5c0000; /* Merah Gelap */
        }
        .foto-user {
            width:30px;
            height:30px;
            border-radius:50%;
            object-fit:cover;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">☕ Kopiku</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarNav" aria-controls="navbarNav" 
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="produk.php">Produk</a></li>

        <?php if(isset($_SESSION['username'])){ ?>
          
          <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){ ?>
            <li class="nav-item"><a class="nav-link text-warning fw-bold" href="admin.php">⚙️ Dashboard Admin</a></li>
          <?php } ?>

          <li class="nav-item d-flex align-items-center ms-3">
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


<div id="kopiCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/gambar/Index.jpg" class="d-block w-100" style="height:450px; object-fit:cover;">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="fw-bold text-white">Nikmati Kopi Premium Setiap Hari</h2>
        <p class="text-white">Rasakan kebahagiaan di setiap tegukan.</p>
        <?php if(isset($_SESSION['username'])){ ?>
          <a href="produk.php" class="btn btn-danger btn-lg btn-anim">Belanja Sekarang</a>
        <?php } else { ?>
          <a href="login.php" class="btn btn-light text-danger fw-bold btn-lg btn-anim">Login untuk Belanja</a>
        <?php } ?>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/gambar/Index2.jpg" class="d-block w-100" style="height:450px; object-fit:cover;">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="fw-bold">Robusta: Energi untuk Aktivitasmu</h2>
        <p>Kopi pekat yang bikin fokus sepanjang hari.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/gambar/Index3.jpg" class="d-block w-100" style="height:450px; object-fit:cover;">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="fw-bold">Liberica: Aroma yang Memikat</h2>
        <p>Unik, eksotis, dan bikin penasaran.</p>
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
      <div class="card feature-card p-3 shadow-sm">
        <h3 class="text-danger">Kualitas Premium</h3>
        <p>Biji kopi pilihan dengan cita rasa khas Indonesia.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card feature-card p-3 shadow-sm">
        <h3 class="text-danger">Harga Terjangkau</h3>
        <p>Kopi berkualitas dengan harga bersahabat.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card feature-card p-3 shadow-sm">
        <h3 class="text-danger">Pengiriman Cepat</h3>
        <p>Pesanan dikirim langsung ke rumah Anda.</p>
      </div>
    </div>
  </div>
</div>

<div class="container my-5">
  <h2 class="text-center mb-4" style="color: #8B0000;">Produk Unggulan</h2>
  <div class="row">
    <?php
    $result = $koneksi->query("SELECT * FROM produk LIMIT 4");
    while($row = $result->fetch_assoc()){
    ?>
    <div class="col-md-3 mb-4">
      <div class="card h-100 shadow-sm border-0">
        <img src="assets/gambar/<?php echo $row['gambar']; ?>" class="card-img-top" style="height:200px; object-fit:cover;">
        <div class="card-body text-center">
          <h5 class="card-title fw-bold"><?php echo $row['nama']; ?></h5>
          <p class="card-text text-danger fw-bold">Rp <?php echo number_format($row['harga'],0,',','.'); ?></p>
          <?php if(isset($_SESSION['username'])){ ?>
            <a href="produk.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger btn-sm w-100 btn-anim">Pesan</a>
          <?php } else { ?>
            <a href="login.php" class="btn btn-warning btn-sm w-100 btn-anim">Login untuk Pesan</a>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

<div class="bg-danger text-white py-5 text-center shadow-lg">
  <h2 class="mb-3">Promo Spesial!</h2>
  <p class="lead fw-bold">Diskon 20% untuk pembelian pertama Anda 🎉</p>
  <p>Gratis ongkir untuk wilayah Jawa Timur</p>
<?php if(isset($_SESSION['username'])){ ?>
  <a href="produk.php" class="btn btn-light text-danger fw-bold btn-lg btn-anim">Belanja Sekarang</a>
<?php } else { ?>
  <a href="login.php" class="btn btn-warning text-dark fw-bold btn-lg btn-anim">Login untuk Belanja</a>
<?php } ?>
</div>

<div class="container my-5">
  <h2 class="text-center mb-4" style="color: #8B0000;">Galeri Lifestyle</h2>
  <div class="row">
    <div class="col-md-3 mb-4">
      <img src="assets/gambar/arabica.jpg" class="img-fluid rounded shadow-sm border border-danger border-2" alt="Ngopi pagi">
    </div>
    <div class="col-md-3 mb-4">
      <img src="assets/gambar/robusta.jpg" class="img-fluid rounded shadow-sm border border-danger border-2" alt="Proses roasting">
    </div>
    <div class="col-md-3 mb-4">
      <img src="assets/gambar/liberica.jpg" class="img-fluid rounded shadow-sm border border-danger border-2" alt="Suasana coffee shop">
    </div>
    <div class="col-md-3 mb-4">
      <img src="assets/gambar/arabica.jpg" class="img-fluid rounded shadow-sm border border-danger border-2" alt="Biji kopi premium">
    </div>
  </div>
</div>

<div class="py-5" style="background-color: #2b0000;">
  <div class="container text-center text-white">
    <h2 class="mb-4 animate__animated animate__fadeInDown">Apa Kata Pelanggan Kami</h2>
    <div class="row">
      <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-1s">
        <blockquote class="blockquote">
          <p>"Kopi Arabica nya wangi banget, bikin pagi lebih semangat!"</p>
          <footer class="blockquote-footer text-light mt-2">Zaidan, Surabaya</footer>
        </blockquote>
      </div>
      <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-2s">
        <blockquote class="blockquote">
          <p>"Harga bersahabat tapi kualitas premium. Recommended!"</p>
          <footer class="blockquote-footer text-light mt-2">Habiba, Tuban</footer>
        </blockquote>
      </div>
      <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-3s">
        <blockquote class="blockquote">
          <p>"Pengiriman cepat, kemasan rapi. Pasti repeat order."</p>
          <footer class="blockquote-footer text-light mt-2">Hasbul, Bangkalan</footer>
        </blockquote>
      </div>
    </div>
  </div>
</div>

<div class="container my-5 text-center">
  <h2 style="color: #8B0000;">Dapatkan Promo & Info Terbaru</h2>
  <form class="row justify-content-center mt-3" onsubmit="return validateEmail()">
    <div class="col-md-6">
      <input type="email" id="emailInput" class="form-control border-danger" placeholder="Masukkan email Anda">
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-danger btn-anim w-100">Subscribe</button>
    </div>
  </form>
  <p id="emailMessage" class="mt-3 fw-bold"></p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<script>
function validateEmail() {
  const email = document.getElementById("emailInput").value;
  const message = document.getElementById("emailMessage");
  if (!email.includes("@gmail.com")) {
    message.textContent = "Email harus menggunakan @gmail.com";
    message.style.color = "red";
    return false; 
  } else {
    message.textContent = "Terimakasih, info terbaru akan segera datang!";
    message.style.color = "green";
    return false; 
  }
}
</script>

<div class="py-5" style="background-color: #ffe5e5;">
  <div class="container text-center">
    <h2 class="mb-4" style="color: #8B0000;">Tentang Kami</h2>
    <p class="lead" style="color: #5c0000;">Toko Biji Kopi berdiri dengan misi mendukung petani lokal Indonesia. 
    Kami percaya setiap biji kopi punya cerita, dari kebun hingga cangkir Anda. 
    Filosofi kami sederhana: menghadirkan rasa otentik, menjaga kualitas, dan 
    menyebarkan kebahagiaan lewat secangkir kopi.</p>
  </div>
</div>

<footer class="text-white text-center py-3">
    <p>&copy; <?php echo date("Y"); ?> Toko Biji Kopi. All rights reserved.</p>
</footer>

</body>
</html>