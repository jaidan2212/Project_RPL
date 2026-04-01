<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Produk Kopi - Kedaiku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; background: #c7b7a3; }
        h1 { font-family: 'Playfair Display', serif; color: #561c24; }
        .product-card { background: #e8d8c4; border: none; transition: 0.3s; }
        .product-card:hover { box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2); transform: translateY(-5px); }
        .btn-main { background: #6d2932; color: white; border: none; }
    </style>
</head>

<body>

    <?php include 'layout/header.php'; ?>

    <div class="container my-5">
        <h1 class="text-center mb-4 text-uppercase">Daftar Biji Kopi Pilihan</h1>

        <form method="post" action="checkout.php">
            <div class="row justify-content-center">
                <?php
                $result = $koneksi->query("SELECT * FROM produk");
                while ($row = $result->fetch_assoc()) :
                ?>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card product-card h-100 d-flex flex-column shadow-sm">
                            <img src="assets/gambar/<?php echo $row['gambar']; ?>" class="card-img-top" style="height:200px;object-fit:cover;">
                            <div class="card-body text-center d-flex flex-column">
                                <h5 class="card-title fw-bold"><?php echo $row['nama']; ?></h5>
                                <p class="card-text fw-bold mb-auto">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>

                                <div class="d-flex justify-content-center align-items-center mb-2 mt-3">
                                    <input class="form-check-input" type="checkbox" name="produk_id[]" value="<?php echo $row['id']; ?>" id="check_<?php echo $row['id']; ?>">
                                    <label class="form-check-label fw-bold ms-2" for="check_<?php echo $row['id']; ?>">Pilih Produk</label>
                                </div>

                                <input type="number" name="jumlah[<?php echo $row['id']; ?>]" class="form-control mx-auto" style="width:80px; text-align:center;" min="1" value="1">
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-main btn-lg px-5 shadow">Pesan Sekarang</button>
            </div>
        </form>
    </div>

    <div class="py-5 text-center text-white" style="background:#6d2932;">
        <h2 class="text-white">Promo Member Kedaiku!</h2>
        <p class="lead fw-bold">Diskon 20% khusus pemesanan via Web 🎉</p>
        <p class="mb-0">Lokasi Toko: Jl. Bulurejo jalan 12 Jombang.</p>
    </div>

    <?php include 'layout/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>