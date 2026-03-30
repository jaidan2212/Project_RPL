<?php
session_start();
include 'koneksi.php';

$produkDipilih = isset($_POST['produk_id']) ? $_POST['produk_id'] : [];
$jumlahDipilih = isset($_POST['jumlah']) ? $_POST['jumlah'] : [];
$nama = $_POST['nama'];
$email = $_POST['email'];
$pembayaran = $_POST['pembayaran'];

$total = 0;

// Hitung Total
foreach ($produkDipilih as $id) {
  $produk = $koneksi->query("SELECT * FROM produk WHERE id='$id'")->fetch_assoc();
  if ($produk) {
    $qty = isset($jumlahDipilih[$id]) ? (int)$jumlahDipilih[$id] : 1;
    $total += ($produk['harga'] * $qty);
  }
}

// Proses Upload Bukti Pembayaran
$buktiName = "";
if (isset($_FILES['bukti']) && $_FILES['bukti']['error'] == 0) {
  $uploadDir = "assets/gambar/";
  if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

  $buktiName = time() . "_" . preg_replace("/\s+/", "_", $_FILES['bukti']['name']);
  move_uploaded_file($_FILES['bukti']['tmp_name'], $uploadDir . $buktiName);
}

// Simpan Header Pesanan & Nama File Bukti
$sql = "INSERT INTO pesanan_header (nama,email,pembayaran,tanggal,total, status, bukti) 
        VALUES ('$nama','$email','$pembayaran',NOW(),'$total', 'Menunggu Pembayaran', '$buktiName')";
$koneksi->query($sql);
$id_pesanan = $koneksi->insert_id;

// Simpan Detail & Kurangi Stok
foreach ($produkDipilih as $id) {
  $produk = $koneksi->query("SELECT * FROM produk WHERE id='$id'")->fetch_assoc();
  if ($produk) {
    $qty = isset($jumlahDipilih[$id]) ? (int)$jumlahDipilih[$id] : 1;
    $subtotal = $produk['harga'] * $qty;

    $sqlDetail = "INSERT INTO pesanan_detail (id_pesanan,produk_id,jumlah,harga,subtotal) 
                      VALUES ('$id_pesanan','$id','$qty','" . $produk['harga'] . "','$subtotal')";
    $koneksi->query($sqlDetail);

    // Logika Pengurangan Stok Otomatis
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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #fff0f0, #ffcccc);
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .navbar-custom {
      background-color: #8B0000;
    }

    .card-custom {
      background: #ffffff;
      border: none;
      box-shadow: 0 4px 15px rgba(139, 0, 0, 0.1);
    }

    footer {
      background: #5c0000;
      margin-top: auto;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">☕ Kedaiku</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link text-warning fw-bold" href="index.php">← Kembali ke Home</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-5">
    <h1 class="text-center mb-4 text-success fw-bold">Pesanan Berhasil!</h1>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card card-custom p-4 text-center">
          <h4 class="fw-bold mb-3">Terima Kasih, <?php echo htmlspecialchars($nama); ?>!</h4>
          <p>Pesanan dan bukti pembayaran Anda sudah kami terima. Admin kami akan segera memverifikasi pembayaran Anda.</p>

          <div class="mt-4">
            <a href="cetak_pdf.php?id=<?php echo $id_pesanan; ?>" target="_blank" class="btn btn-danger btn-lg fw-bold px-4">🖨️ Cetak Nota (PDF)</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="text-white text-center py-3">
    <p>&copy; <?php echo date("Y"); ?> Kedaiku. All rights reserved.</p>
  </footer>

</body>

</html>