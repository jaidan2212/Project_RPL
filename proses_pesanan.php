<?php
session_start();
include 'koneksi.php';

// Pastikan ada data yang dikirim
if (!isset($_POST['produk_id']) || !isset($_POST['nama'])) {
    header("Location: produk.php");
    exit();
}

$produkDipilih = $_POST['produk_id'];
$jumlahDipilih = $_POST['jumlah'];
$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$email = mysqli_real_escape_string($koneksi, $_POST['email']);
$pembayaran = mysqli_real_escape_string($koneksi, $_POST['pembayaran']);

$total = 0;

// ==========================================================
// 1. VALIDASI STOK & HITUNG TOTAL (Pagar Keamanan)
// ==========================================================
foreach ($produkDipilih as $id) {
    $produk = $koneksi->query("SELECT * FROM produk WHERE id='$id'")->fetch_assoc();
    if ($produk) {
        $qty = isset($jumlahDipilih[$id]) ? (int)$jumlahDipilih[$id] : 1;
        
        // Cek apakah stok di database mencukupi
        if ($qty > $produk['stok']) {
            echo "<script>
                alert('Gagal! Stok " . $produk['nama'] . " tidak mencukupi. Sisa stok: " . $produk['stok'] . "');
                window.location='produk.php'; 
            </script>";
            exit(); 
        }
        
        $total += ($produk['harga'] * $qty);
    }
}

// ==========================================================
// 2. PROSES UPLOAD BUKTI (Tetap Sama)
// ==========================================================
$buktiName = "";
$fileSource = null;

if (isset($_FILES['bukti_transfer']) && $_FILES['bukti_transfer']['error'] == 0) {
    $fileSource = $_FILES['bukti_transfer'];
} elseif (isset($_FILES['bukti_qris']) && $_FILES['bukti_qris']['error'] == 0) {
    $fileSource = $_FILES['bukti_qris'];
}

if ($fileSource) {
    $uploadDir = "assets/gambar/";
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $extension = pathinfo($fileSource['name'], PATHINFO_EXTENSION);
    $buktiName = "BUKTI_" . time() . "_" . uniqid() . "." . $extension;
    move_uploaded_file($fileSource['tmp_name'], $uploadDir . $buktiName);
}

// ==========================================================
// 3. SIMPAN KE pesanan_header (Tetap Sama)
// ==========================================================
$sql = "INSERT INTO pesanan_header (nama, email, pembayaran, tanggal, total, status, bukti) 
        VALUES ('$nama', '$email', '$pembayaran', NOW(), '$total', 'Menunggu Verifikasi', '$buktiName')";
$koneksi->query($sql);
$id_pesanan = $koneksi->insert_id;

// ==========================================================
// 4. SIMPAN KE pesanan_detail & UPDATE STOK (Tetap Sama)
// ==========================================================
foreach ($produkDipilih as $id) {
    $produk = $koneksi->query("SELECT * FROM produk WHERE id='$id'")->fetch_assoc();
    if ($produk) {
        $qty = isset($jumlahDipilih[$id]) ? (int)$jumlahDipilih[$id] : 1;
        $subtotal = $produk['harga'] * $qty;

        $sqlDetail = "INSERT INTO pesanan_detail (id_pesanan, produk_id, jumlah, harga, subtotal) 
                      VALUES ('$id_pesanan', '$id', '$qty', '" . $produk['harga'] . "', '$subtotal')";
        $koneksi->query($sqlDetail);

        // Kurangi Stok di Database
        $stokBaru = $produk['stok'] - $qty;
        $koneksi->query("UPDATE produk SET stok='$stokBaru' WHERE id='$id'");
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pesanan Berhasil - Kedaiku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        body {
            background: #c7b7a3; 
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }

        .success-card {
            background: #ffffff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .success-icon {
            font-size: 80px;
            color: #198754;
            animation: bounceIn 1s;
        }

        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); opacity: 1; }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); }
        }

        .btn-print {
            background: #561c24;
            color: white;
            border: none;
            transition: 0.3s;
        }

        .btn-print:hover {
            background: #6d2932;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(86, 28, 36, 0.3);
        }

        .pick-up-box {
            background: #fdf5e6;
            border-left: 5px solid #561c24;
            border-radius: 10px;
        }

        h2 { font-family: 'Playfair Display', serif; color: #561c24; }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include 'layout/header.php'; ?>

    <div class="container my-auto py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card success-card p-5 text-center">
                    <div class="success-icon mb-4">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    
                    <h2 class="fw-bold mb-2 text-uppercase">Pesanan Berhasil!</h2>
                    <p class="text-muted mb-4 fs-5">Terima kasih, <strong><?php echo htmlspecialchars($nama); ?></strong>. Pesanan Anda telah tercatat dalam sistem kami.</p>

                    <div class="pick-up-box p-3 mb-4 text-start">
                        <h6 class="fw-bold text-dark mb-1"><i class="fa-solid fa-location-dot me-2"></i> Langkah Selanjutnya:</h6>
                        <p class="small mb-0 text-dark">
                            Silakan datang ke toko kami di <strong>Jl. Bulurejo Jalan 12 Jombang</strong> untuk mengambil pesanan Anda dengan menunjukkan Nota Digital yang bisa Anda unduh di bawah ini.
                        </p>
                    </div>

                    <div class="d-grid gap-3">
                        <a href="cetak_pdf.php?id=<?php echo $id_pesanan; ?>" target="_blank" class="btn btn-print btn-lg fw-bold py-3 rounded-pill">
                            <i class="fa-solid fa-file-pdf me-2"></i> Download Nota Digital (PDF)
                        </a>
                        <a href="index.php" class="btn btn-outline-secondary btn-lg rounded-pill">
                            <i class="fa-solid fa-house me-2"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
                
                <p class="text-center mt-4 text-dark opacity-75 small">
                    Butuh bantuan? Hubungi WhatsApp kami di 0812-xxxx-xxxx
                </p>
            </div>
        </div>
    </div>

    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>