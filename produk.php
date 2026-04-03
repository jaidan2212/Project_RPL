<?php
session_start();
include 'koneksi.php'; // Koneksi ke database diaktifkan kembali
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Katalog Produk - Kedaiku Jombang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background: #c7b7a3; min-height: 100vh; display: flex; flex-direction: column; }
        h1 { font-family: 'Playfair Display', serif; color: #561c24; }
        
        .product-card { 
            background: #fff; 
            border: none; 
            transition: all 0.3s ease; 
            border-radius: 15px;
            overflow: hidden;
        }
        .product-card:hover { 
            box-shadow: 0 15px 30px rgba(86, 28, 36, 0.2); 
            transform: translateY(-10px); 
        }
        
        .btn-main { background: #6d2932; color: white; border: none; font-weight: 600; border-radius: 12px; padding: 12px; transition: 0.3s; }
        .btn-main:hover { background: #561c24; color: white; }
        
        .qty-input { width: 75px; text-align: center; border-radius: 8px; border: 2px solid #6d2932; font-weight: bold; }
        .custom-check { transform: scale(1.3); cursor: pointer; }
        
        .card-body { background: #ffffff; padding: 20px; }
        
        /* Banner Promo Style */
        .promo-banner {
            background: linear-gradient(rgba(86, 28, 36, 0.9), rgba(86, 28, 36, 0.9)), url('assets/gambar/Index.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 60px 0;
            margin-bottom: 50px;
        }
    </style>
</head>

<body>

    <?php include 'layout/header.php'; ?>

    <div class="promo-banner text-center shadow">
        <div class="container">
            <h1 class="text-white text-uppercase fw-bold mb-3">Koleksi Biji Kopi Premium</h1>
            <p class="lead mb-0">Pesan online, ambil langsung di toko Jl. Bulurejo Jombang.</p>
        </div>
    </div>

    <div class="container mb-5 flex-grow-1">
        <form method="post" action="checkout.php">
            <div class="row justify-content-center g-4">
                <?php
                // Menarik 6 data produk dari database
                $result = $koneksi->query("SELECT * FROM produk");
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) :
                ?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card product-card h-100 shadow-sm d-flex flex-column">
                            <img src="assets/gambar/<?php echo $row['gambar']; ?>" class="card-img-top" style="height:250px; object-fit:cover;" alt="<?php echo $row['nama']; ?>">
                            
                            <div class="card-body text-center d-flex flex-column">
                                <h5 class="fw-bold mb-2"><?php echo $row['nama']; ?></h5>
                                <p class="fw-bold fs-5 mb-4" style="color: #6d2932;">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>

                                <div class="mt-auto">
                                    <div class="d-flex justify-content-center align-items-center mb-3 py-2 border rounded-3 bg-light shadow-sm">
                                        <input class="form-check-input custom-check me-2" type="checkbox" name="produk_id[]" value="<?php echo $row['id']; ?>" id="check_<?php echo $row['id']; ?>">
                                        <label class="form-check-label fw-bold" for="check_<?php echo $row['id']; ?>" style="cursor: pointer;">PILIH PRODUK</label>
                                    </div>

                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <span class="fw-bold text-muted">Jumlah:</span>
                                        <input type="number" name="jumlah[<?php echo $row['id']; ?>]" class="form-control qty-input" min="1" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                    endwhile; 
                } else {
                    echo "<div class='text-center py-5'><p class='text-muted'>Belum ada produk di database.</p></div>";
                }
                ?>
            </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn btn-main btn-lg px-5 shadow-lg text-uppercase">
                    <i class="fa-solid fa-basket-shopping me-2"></i> Lanjut Ke Checkout
                </button>
            </div>
        </form>
    </div>

    <div class="py-4 text-center text-white mt-auto" style="background:#561c24;">
        <div class="container">
            <p class="mb-0 fw-bold"><i class="fa-solid fa-location-dot me-2"></i> Pengambilan di Store: Jl. Bulurejo jalan 12 Jombang</p>
        </div>
    </div>

    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>