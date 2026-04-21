<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kedaiku - Biji Kopi Premium Jombang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background: #c7b7a3; }
        h1, h2, h3 { font-family: 'Playfair Display', serif; color: #561c24; }
        .btn-main { background: #6d2932; color: white; border: none; font-weight: 600; }
        .btn-main:hover { background: #561c24; color: white; }
        .feature-card { background: #e8d8c4; border: none; border-radius: 15px; }
        .product-card { border-radius: 15px; overflow: hidden; transition: 0.3s; }
        .product-card:hover { transform: translateY(-10px); box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important; }
        .testi-card { background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 15px; padding: 25px; height: 100%; }
        .carousel-caption { background: rgba(0, 0, 0, 0.5); padding: 30px; border-radius: 20px; }
        footer { background: #561c24; }
    </style>
</head>

<body>

    <?php include 'layout/header.php'; ?>

    <div id="kopiCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/gambar/Index.jpg" class="d-block w-100" style="height:500px;object-fit:cover;">
                <div class="carousel-caption">
                    <h1 class="fw-bold text-white mb-3">Nikmati Kopi Premium</h1>
                    <p class="text-white fs-5">Pesan online via website dan ambil langsung di toko tanpa antre.</p>
                    <a href="produk.php" class="btn btn-main btn-lg px-5 mt-3 rounded-pill shadow">Belanja Sekarang</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/gambar/Index2.jpg" class="d-block w-100" style="height:500px;object-fit:cover;">
                <div class="carousel-caption">
                    <h2 class="fw-bold text-white mb-3">Robusta Jombang Terbaik</h2>
                    <p class="text-white fs-5">Energi murni dari biji kopi pilihan hasil petani lokal terbaik.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/gambar/Index3.jpg" class="d-block w-100" style="height:500px;object-fit:cover;">
                <div class="carousel-caption">
                    <h2 class="fw-bold text-white mb-3">Liberica: Aroma Memikat</h2>
                    <p class="text-white fs-5">Rasakan keunikan cita rasa kopi eksotis yang memanjakan lidah.</p>
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

    <div class="container my-5 pt-4">
        <div class="row text-center g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card feature-card p-4 shadow-sm h-100 border-0">
                    <i class="fa-solid fa-award fs-1 text-velvet mb-3"></i>
                    <h4 class="fw-bold">Kualitas Premium</h4>
                    <p class="text-muted mb-0">Biji kopi pilihan terbaik dari petani lokal Indonesia.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card p-4 shadow-sm h-100 border-0">
                    <i class="fa-solid fa-tags fs-1 text-velvet mb-3"></i>
                    <h4 class="fw-bold">Harga Bersahabat</h4>
                    <p class="text-muted mb-0">Cita rasa kopi kafe mewah dengan harga yang tetap terjangkau.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card p-4 shadow-sm h-100 border-0">
                    <i class="fa-solid fa-store fs-1 text-velvet mb-3"></i>
                    <h4 class="fw-bold">Pengambilan Cepat</h4>
                    <p class="text-muted mb-0">Pesan lewat web, ambil di Jl. Bulurejo Jalan 12 Jombang.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <h2 class="text-center mb-5 fw-bold text-uppercase">Produk Unggulan Kedaiku</h2>
        <div class="row justify-content-center g-4">
            <?php
            $result = $koneksi->query("SELECT * FROM produk LIMIT 4");
            while ($row = $result->fetch_assoc()) :
            ?>
                <div class="col-md-3">
                    <div class="card product-card border-0 shadow-sm h-100">
                        <img src="assets/gambar/<?php echo $row['gambar']; ?>" class="card-img-top" style="height:220px;object-fit:cover;">
                        <div class="card-body text-center d-flex flex-column bg-white">
                            <h5 class="fw-bold mb-2"><?php echo $row['nama']; ?></h5>
                            <p class="text-danger fw-bold fs-5 mb-3">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                            <div class="mt-auto">
                                <a href="produk.php" class="btn btn-main btn-sm w-100 rounded-pill">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="text-white py-5 text-center shadow-lg my-5" style="background:#6d2932;">
        <div class="container">
            <h2 class="mb-3 text-white fw-bold text-uppercase">Jelajahi Koleksi Kami!</h2>
            <p class="lead mb-4">Ingin melihat berbagai pilihan biji kopi premium terbaik dari Kedaiku? <br> Silakan klik tombol katalog di bawah ini untuk mulai menjelajah.</p>
            <a href="produk.php" class="btn btn-light btn-lg px-5 rounded-pill text-dark fw-bold shadow">Lihat Katalog</a>
        </div>
    </div>

    <div class="container my-5">
        <h2 class="text-center mb-5 fw-bold text-uppercase">Galeri Lifestyle Cafe</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-3 col-sm-6">
                <img src="assets/gambar/galeri1.jpg" class="img-fluid rounded-4 shadow-sm w-100" style="height:250px; object-fit:cover;">
            </div>
            <div class="col-md-3 col-sm-6">
                <img src="assets/gambar/galeri2.jpg" class="img-fluid rounded-4 shadow-sm w-100" style="height:250px; object-fit:cover;">
            </div>
            <div class="col-md-3 col-sm-6">
                <img src="assets/gambar/galeri3.jpg" class="img-fluid rounded-4 shadow-sm w-100" style="height:250px; object-fit:cover;">
            </div>
            <div class="col-md-3 col-sm-6">
                <img src="assets/gambar/galeri4.jpg" class="img-fluid rounded-4 shadow-sm w-100" style="height:250px; object-fit:cover;">
            </div>
        </div>
    </div>

    <div class="py-5" style="background:#561c24;">
        <div class="container text-center text-white">
            <h2 class="mb-5 text-white fw-bold">APA KATA PELANGGAN KAMI?</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="testi-card">
                        <i class="fa-solid fa-quote-left fs-2 text-warning mb-3"></i>
                        <p class="fst-italic text-white">"Kopi Arabica Jombang aromanya juara banget! Cocok buat nemenin pagi hari."</p>
                        <hr class="border-light opacity-25">
                        <h6 class="fw-bold mb-0 text-white">Zaidan</h6>
                        <small class="text-light opacity-75">Surabaya</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testi-card">
                        <i class="fa-solid fa-quote-left fs-2 text-warning mb-3"></i>
                        <p class="fst-italic text-white">"Ambil di toko Jombang cepet banget, biji kopinya bener-bener fresh dan nikmat."</p>
                        <hr class="border-light opacity-25">
                        <h6 class="fw-bold mb-0 text-white">Hasbul</h6>
                        <small class="text-light opacity-75">Jombang</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testi-card">
                        <i class="fa-solid fa-quote-left fs-2 text-warning mb-3"></i>
                        <p class="fst-italic text-white">"Harganya bersahabat tapi rasa premium. Sukses terus buat Kedaiku!"</p>
                        <hr class="border-light opacity-25">
                        <h6 class="fw-bold mb-0 text-white">Habiba</h6>
                        <small class="text-light opacity-75">Tuban</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5 text-center">
        <h2 class="fw-bold">
            Dapatkan Info Promo Terbaru</h2>
        <form class="row justify-content-center mt-3" onsubmit="return validateEmail()">
            <div class="col-md-6">
                <input type="email" id="emailInput" class="form-control rounded-pill px-4" placeholder="Masukkan email @gmail.com Anda">
            </div>
            <div class="col-md-2 mt-2 mt-md-0">
                <button type="submit" class="btn btn-main w-100 rounded-pill">Subscribe</button>
            </div>
        </form>
        <p id="emailMessage" class="mt-3 fw-bold"></p>
    </div>

    <div class="py-5" style="background:#e8d8c4;">
        <div class="container text-center">
            <h2 class="mb-4 fw-bold">Tentang Kedaiku</h2>
            <p class="lead text-dark">
                Toko Biji Kopi berdiri dengan misi mendukung petani lokal Indonesia khususnya di wilayah Jombang.
                Kami percaya setiap biji kopi punya cerita dari kebun hingga ke cangkir Anda.
            </p>
        </div>
    </div>

    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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
</body>
</html>