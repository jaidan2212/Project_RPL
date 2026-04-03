<?php 
session_start();
include 'koneksi.php'; 

// Jika belum login, arahkan ke login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$produkDipilih = isset($_POST['produk_id']) ? $_POST['produk_id'] : [];
$jumlahDipilih = isset($_POST['jumlah']) ? $_POST['jumlah'] : [];

$daftarProduk = [];
$total = 0;

foreach ($produkDipilih as $id) {
    // Tetap pakai query database asli kamu
    $produk = $koneksi->query("SELECT * FROM produk WHERE id='$id'")->fetch_assoc();
    if ($produk) {
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
    <title>Checkout - Kedaiku Biji Kopi</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #c7b7a3;
            min-height: 100vh;
        }

        h1, h4, h5 {
            font-family: 'Playfair Display', serif;
            color: #561c24;
            font-weight: 700;
        }

        .checkout-card {
            background: #fff;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .form-label { font-weight: 600; color: #561c24; }

        .btn-main {
            background: #6d2932;
            color: white;
            border: none;
            font-weight: 600;
            border-radius: 8px;
            padding: 12px;
            transition: 0.3s;
        }

        .btn-main:hover {
            background: #561c24;
            color: white;
            transform: translateY(-2px);
        }

        /* Style Tombol Kembali */
        .btn-back {
            border: 2px solid #6d2932;
            color: #6d2932;
            background: transparent;
            font-weight: 600;
            border-radius: 8px;
            padding: 12px;
            transition: 0.3s;
            display: block;
            text-align: center;
            text-decoration: none;
        }

        .btn-back:hover {
            background: #f8f1e9;
            color: #561c24;
            border-color: #561c24;
        }

        .bank-option {
            border-radius: 10px;
            border: 2px solid #e8d8c4;
            cursor: pointer;
            transition: 0.3s;
            font-weight: 600;
        }

        .bank-option.active {
            background: #561c24;
            color: white;
            border-color: #561c24;
        }

        .box-pembayaran {
            border-radius: 10px;
            padding: 20px;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include 'layout/header.php'; ?>

    <div class="container my-5 flex-grow-1">
        <h1 class="text-center mb-4">Proses Checkout</h1>

        <?php if (empty($daftarProduk)) { ?>
            <div class="alert alert-danger text-center shadow-sm border-0 py-5 rounded-4">
                <i class="fa-solid fa-cart-arrow-down fs-1 mb-3 text-danger"></i><br>
                <h5 class="fw-bold text-danger">Keranjang Kosong</h5>
                <p>Silakan pilih kopi terlebih dahulu.</p>
                <a href="produk.php" class="btn btn-main px-5 rounded-pill mt-3 text-decoration-none">Kembali ke Katalog</a>
            </div>
        <?php } else { ?>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card checkout-card p-4 p-md-5">

                        <h4 class="mb-4 border-bottom pb-2 text-uppercase"><i class="fa-solid fa-receipt me-2"></i> Ringkasan Pesanan</h4>
                        <ul class="list-group mb-4">
                            <?php foreach ($daftarProduk as $p) { ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom py-3">
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark"><?php echo $p['nama']; ?></h6>
                                        <small class="text-muted">Kuantitas: <?php echo $p['jumlah']; ?>x</small>
                                    </div>
                                    <span class="fw-bold" style="color: #561c24;">Rp <?php echo number_format($p['subtotal'], 0, ',', '.'); ?></span>
                                </li>
                            <?php } ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 pt-3">
                                <h5 class="mb-0 text-dark">Total Pembayaran</h5>
                                <h4 class="mb-0 fw-bold" style="color: #561c24;">Rp <?php echo number_format($total, 0, ',', '.'); ?></h4>
                            </li>
                        </ul>

                        <div class="alert border-0 shadow-sm mb-4" style="background-color: #fdf5e6; color: #561c24; border-radius: 10px;">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-location-dot fs-3 me-3 text-danger"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Lokasi Toko Jombang:</h6>
                                    <p class="mb-0 small">Jl. Bulurejo Jalan 12 Jombang, Jawa Timur.</p>
                                </div>
                            </div>
                        </div>

                        <form method="post" action="proses_pesanan.php" enctype="multipart/form-data">
                            <?php foreach ($daftarProduk as $p) { ?>
                                <input type="hidden" name="produk_id[]" value="<?php echo $p['id']; ?>">
                                <input type="hidden" name="jumlah[<?php echo $p['id']; ?>]" value="<?php echo $p['jumlah']; ?>">
                            <?php } ?>
                            <input type="hidden" name="total_harga" value="<?php echo $total; ?>">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Pengambil</label>
                                    <input type="text" name="nama" class="form-control" value="<?php echo $_SESSION['username']; ?>" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Email Konfirmasi</label>
                                    <input type="email" name="email" class="form-control" placeholder="email@gmail.com" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Pilih Metode Pembayaran</label>
                                <select name="pembayaran" id="metode_pembayaran" class="form-select fw-bold" onchange="tampilMetode()" required>
                                    <option value="">-- Silakan Pilih Metode --</option>
                                    <option value="Transfer Bank">🏦 Transfer Bank</option>
                                    <option value="QRIS">📱 E-Wallet (QRIS)</option> 
                                </select>
                            </div>

                            <div id="bank_section" style="display:none;" class="mb-4 text-center">
                                <label class="form-label d-block text-start">Pilih Bank</label>
                                <div class="row g-2">
                                    <div class="col-4"><div id="bank_bca" class="card p-3 bank-option" onclick="pilihBank('BCA')">BCA</div></div>
                                    <div class="col-4"><div id="bank_bri" class="card p-3 bank-option" onclick="pilihBank('BRI')">BRI</div></div>
                                    <div class="col-4"><div id="bank_mandiri" class="card p-3 bank-option" onclick="pilihBank('Mandiri')">Mandiri</div></div>
                                </div>
                            </div>

                            <div id="detail_rekening" style="display:none;" class="box-pembayaran border border-info mb-4 shadow-sm">
                                <h5 id="nama_bank" class="text-info mb-1"></h5>
                                <h4 id="no_rek" class="fw-bold mb-3"></h4>
                                <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" accept="image/*">
                            </div>

                            <div id="ewallet_section" style="display:none;" class="box-pembayaran border border-success mb-4 shadow-sm text-center">
                                <h5 class="text-success fw-bold mb-3">Scan QRIS Kedaiku</h5>
                                <img src="assets/gambar/qris.png" width="180" class="img-fluid mb-3 border">
                                <input type="file" name="bukti_qris" id="bukti_qris" class="form-control" accept="image/*">
                            </div>

<<<<<<< HEAD

                            <a href="produk.php" class="btn btn-success mt-3">Kembali</a>
                            <button type="submit" class="btn btn-success mt-3">
                                Pesan Sekarang
=======
                            <button type="submit" class="btn btn-main w-100 btn-lg shadow mt-3 text-uppercase">
                                <i class="fa-solid fa-circle-check me-2"></i> Selesaikan Pesanan
>>>>>>> 5a1dd3822f92c8c8634761eef7022918198bb052
                            </button>

                            <a href="produk.php" class="btn btn-back w-100 btn-lg mt-3 text-uppercase">
                                <i class="fa-solid fa-arrow-left me-2"></i> Kembali Pilih Kopi
                            </a>

                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function tampilMetode() {
            var metode = document.getElementById("metode_pembayaran").value;
            document.getElementById("bank_section").style.display = (metode == "Transfer Bank") ? "block" : "none";
            document.getElementById("ewallet_section").style.display = (metode == "QRIS") ? "block" : "none";
            document.getElementById("detail_rekening").style.display = "none";
        }

        function pilihBank(bank) {
            document.getElementById("detail_rekening").style.display = "block";
            var options = document.getElementsByClassName("bank-option");
            for (var i = 0; i < options.length; i++) options[i].classList.remove("active");

            if (bank == "BCA") {
                document.getElementById("nama_bank").innerText = "Bank BCA";
                document.getElementById("no_rek").innerText = "1234 5678 90";
                document.getElementById("bank_bca").classList.add("active");
            } else if (bank == "BRI") {
                document.getElementById("nama_bank").innerText = "Bank BRI";
                document.getElementById("no_rek").innerText = "9876 5432 10";
                document.getElementById("bank_bri").classList.add("active");
            } else if (bank == "Mandiri") {
                document.getElementById("nama_bank").innerText = "Bank Mandiri";
                document.getElementById("no_rek").innerText = "1122 3344 55";
                document.getElementById("bank_mandiri").classList.add("active");
            }
        }
    </script>
</body>
</html>