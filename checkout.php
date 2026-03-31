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
    <title>Checkout - Kedaiku</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #c7b7a3; /* Tema Kedaiku */
            min-height: 100vh;
        }

        h1, h4, h5 {
            font-family: 'Playfair Display', serif;
            color: #561c24; /* Merah Velvet */
            font-weight: 700;
        }

        .text-velvet { color: #561c24 !important; }

        .checkout-card {
            background: #fff;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .list-group-item {
            border: none;
            border-bottom: 1px dashed #e8d8c4;
            padding: 15px 0;
            color: #333;
        }

        .form-label {
            font-weight: 600;
            color: #561c24;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e8d8c4;
            padding: 10px 15px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #561c24;
            box-shadow: 0 0 0 0.2rem rgba(86, 28, 36, 0.25);
        }

        /* Bank Option Styling */
        .bank-option {
            border-radius: 10px;
            border: 2px solid #e8d8c4;
            background: #fff;
            font-weight: 600;
            color: #561c24;
            cursor: pointer;
            transition: 0.3s;
        }

        .bank-option:hover, .bank-option.active {
            background: #561c24;
            color: white;
            border-color: #561c24;
            transform: translateY(-2px);
        }

        /* Box Bukti Bayar */
        .box-pembayaran {
            border-radius: 10px;
            border: none;
            padding: 20px;
            background-color: #f8f9fa;
        }

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
            box-shadow: 0 5px 15px rgba(86, 28, 36, 0.3);
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include 'layout/header.php'; ?>

    <div class="container my-5 flex-grow-1">

        <h1 class="text-center mb-4">Proses Checkout</h1>

        <?php if (empty($daftarProduk)) { ?>
            <div class="alert alert-danger text-center shadow-sm border-0 py-4 rounded-3">
                <i class="fa-solid fa-cart-arrow-down fs-1 mb-3 text-danger"></i><br>
                <h5 class="fw-bold text-danger">Keranjang Kosong</h5>
                <p>Tidak ada produk yang dipilih. Silakan kembali ke halaman produk.</p>
                <a href="produk.php" class="btn btn-outline-danger px-4 rounded-pill">Belanja Sekarang</a>
            </div>
        <?php } else { ?>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card checkout-card p-4 p-md-5">

                        <h4 class="mb-4 border-bottom pb-2"><i class="fa-solid fa-basket-shopping me-2"></i> Ringkasan Pesanan</h4>

                        <ul class="list-group mb-4">
                            <?php foreach ($daftarProduk as $p) { ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark"><?php echo $p['nama']; ?></h6>
                                        <small class="text-muted">Kuantitas: <?php echo $p['jumlah']; ?>x</small>
                                    </div>
                                    <span class="fw-bold text-velvet">Rp <?php echo number_format($p['subtotal'], 0, ',', '.'); ?></span>
                                </li>
                            <?php } ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 mt-2 border-top border-dark border-2">
                                <h5 class="mb-0 text-dark">Total Pembayaran</h5>
                                <h4 class="mb-0 text-velvet">Rp <?php echo number_format($total, 0, ',', '.'); ?></h4>
                            </li>
                        </ul>

                        <h4 class="mb-4 mt-5 border-bottom pb-2"><i class="fa-solid fa-truck-fast me-2"></i> Detail Pengiriman & Pembayaran</h4>

                        <form method="post" action="proses_pesanan.php" enctype="multipart/form-data">

                            <?php foreach ($daftarProduk as $p) { ?>
                                <input type="hidden" name="produk_id[]" value="<?php echo $p['id']; ?>">
                                <input type="hidden" name="jumlah[<?php echo $p['id']; ?>]" value="<?php echo $p['jumlah']; ?>">
                            <?php } ?>
                            
                            <input type="hidden" name="total_harga" value="<?php echo $total; ?>">

                            <div class="mb-3">
                                <label class="form-label">Nama Penerima</label>
                                <input type="text" name="nama" class="form-control" value="<?php echo $_SESSION['username']; ?>" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Email Aktif</label>
                                <input type="email" name="email" class="form-control" placeholder="email@gmail.com" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Pilih Metode Pembayaran</label>
                                <select name="pembayaran" id="metode_pembayaran" class="form-select fw-bold" onchange="tampilMetode()" required>
                                    <option value="">-- Silakan Pilih --</option>
                                    <option value="Transfer Bank">🏦 Transfer Bank</option>
                                    <option value="QRIS">📱 E-Wallet (QRIS)</option> 
                                </select>
                            </div>

                            <div id="bank_section" style="display:none;" class="mb-4">
                                <label class="form-label">Pilih Bank Tujuan</label>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card p-3 text-center bank-option" onclick="pilihBank('BCA')">BCA</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card p-3 text-center bank-option" onclick="pilihBank('BRI')">BRI</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card p-3 text-center bank-option" onclick="pilihBank('Mandiri')">Mandiri</div>
                                    </div>
                                </div>
                            </div>

                            <div id="detail_rekening" style="display:none;" class="box-pembayaran border border-info bg-light mb-4 shadow-sm">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fa-solid fa-building-columns fs-2 text-info me-3"></i>
                                    <div>
                                        <h5 id="nama_bank" class="mb-0 text-info"></h5>
                                        <h4 class="fw-bold text-dark mb-0" id="no_rek"></h4>
                                        <small class="text-muted">a.n Kedaiku Biji Kopi</small>
                                    </div>
                                </div>
                                <hr>
                                <label class="form-label text-dark">Upload Bukti Transfer <span class="text-danger">*</span></label>
                                <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" accept="image/*">
                            </div>

                            <div id="ewallet_section" style="display:none;" class="box-pembayaran border border-success bg-light mb-4 shadow-sm text-center">
                                <h5 class="text-success fw-bold mb-3"><i class="fa-solid fa-qrcode me-2"></i>Scan QRIS Kedaiku</h5>
                                <img src="assets/gambar/qris.png" width="220" class="img-fluid mb-4 rounded-3 border shadow-sm">
                                
                                <div class="text-start">
                                    <hr>
                                    <label class="form-label text-dark">Upload Bukti Pembayaran QRIS <span class="text-danger">*</span></label>
                                    <input type="file" name="bukti_qris" id="bukti_qris" class="form-control" accept="image/*">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-main w-100 btn-lg shadow mt-3">
                                <i class="fa-solid fa-check-circle me-2"></i> Konfirmasi Pesanan
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <footer class="text-white text-center py-3 mt-auto" style="background: #561c24;">
        <p class="mb-0">&copy; <?php echo date("Y"); ?> Toko Biji Kopi. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function tampilMetode() {
            var metode = document.getElementById("metode_pembayaran").value;

            document.getElementById("bank_section").style.display = "none";
            document.getElementById("detail_rekening").style.display = "none";
            document.getElementById("ewallet_section").style.display = "none";
            
            // Disable input file agar PHP tidak bingung pas ngirim data
            document.getElementById("bukti_transfer").disabled = true;
            document.getElementById("bukti_qris").disabled = true;

            if (metode == "Transfer Bank") {
                document.getElementById("bank_section").style.display = "block";
                document.getElementById("bukti_transfer").disabled = false;
            } else if (metode == "QRIS") { // Tadi namanya E-Wallet, sekarang disamakan dengan value baru
                document.getElementById("ewallet_section").style.display = "block";
                document.getElementById("bukti_qris").disabled = false;
            }
        }

        function pilihBank(bank) {
            document.getElementById("detail_rekening").style.display = "block";
            document.getElementById("bukti_transfer").disabled = false;

            if (bank == "BCA") {
                document.getElementById("nama_bank").innerText = "Bank BCA";
                document.getElementById("no_rek").innerText = "1234 5678 90";
            } else if (bank == "BRI") {
                document.getElementById("nama_bank").innerText = "Bank BRI";
                document.getElementById("no_rek").innerText = "9876 5432 10";
            } else if (bank == "Mandiri") {
                document.getElementById("nama_bank").innerText = "Bank Mandiri";
                document.getElementById("no_rek").innerText = "1122 3344 55";
            }
        }

        document.querySelector("form").addEventListener("submit", function(e) {
            var metode = document.getElementById("metode_pembayaran").value;
            var buktiTransfer = document.getElementById("bukti_transfer").files.length;
            var buktiQris = document.getElementById("bukti_qris").files.length;

            if (metode == "Transfer Bank" && buktiTransfer == 0) {
                alert("Harap upload bukti transfer Bank terlebih dahulu!");
                e.preventDefault();
            } else if (metode == "QRIS" && buktiQris == 0) {
                alert("Harap upload bukti pembayaran QRIS terlebih dahulu!");
                e.preventDefault();
            }
        });
    </script>
</body>
</html>