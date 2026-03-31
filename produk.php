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
        body { font-family: 'Poppins', sans-serif; background: #c7b7a3; }
        h1 { font-family: 'Playfair Display', serif; color: #561c24; }
        .product-card { background: #e8d8c4; border: none; transition: 0.3s; }
        .product-card:hover { box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2); transform: translateY(-5px); }
        .big-check { transform: scale(1.4); margin-right: 10px; cursor: pointer; }
        .qty-input { width: 80px; text-align: center; font-weight: bold; border: 2px solid #6d2932; }
        .btn-main { background: #6d2932; color: white; border: none; }
        .btn-main:hover { background: #561c24; color: white; }
        .promo-section { background: #6d2932; color: white; }
    </style>
</head>

<body>

    <?php include 'layout/header.php'; ?>

    <div class="container my-5">
        <h1 class="text-center mb-4">Daftar Produk Kopi</h1>

        <form method="post" action="checkout.php">
            <div class="row">
                <?php
                $result = $koneksi->query("SELECT * FROM produk");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card product-card h-100 d-flex flex-column">
                                <img src="assets/gambar/<?php echo $row['gambar']; ?>" class="card-img-top" style="height:200px;object-fit:cover;">
                                <div class="card-body text-center d-flex flex-column">
                                    <h5 class="card-title fw-bold"><?php echo $row['nama']; ?></h5>
                                    <p class="card-text fw-bold mb-auto">
                                        Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?>
                                    </p>

                                    <div class="d-flex justify-content-center align-items-center mb-2 mt-3">
                                        <input class="form-check-input big-check" type="checkbox" name="produk_id[]" value="<?php echo $row['id']; ?>" id="check_<?php echo $row['id']; ?>">
                                        <label class="form-check-label fw-bold" for="check_<?php echo $row['id']; ?>" style="cursor: pointer;">
                                            Pilih Produk
                                        </label>
                                    </div>

                                    <input type="number" name="jumlah[<?php echo $row['id']; ?>]" class="form-control qty-input mx-auto" min="1" value="1">
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<div class='col-12'><p class='text-center'>Belum ada produk tersedia.</p></div>";
                }
                ?>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-main btn-lg px-5 shadow">Pesan Sekarang</button>
            </div>
        </form>
    </div>

    <div class="promo-section py-5 text-center shadow-lg">
        <h2 class="mb-3" style="color: white !important;">Promo Spesial!</h2>
        <p class="lead fw-bold">Diskon 20% untuk pembelian pertama 🎉</p>
        <p class="mb-0">Gratis ongkir untuk wilayah Jawa Timur</p>
    </div>

    <footer class="text-white text-center py-3" style="background: #561c24;">
        <p class="mb-0">&copy; <?php echo date("Y"); ?> Toko Biji Kopi. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>