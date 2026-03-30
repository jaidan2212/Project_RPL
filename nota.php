<?php include 'koneksi.php';
$id_pesanan = $_GET['id'];

$header = $koneksi->query("SELECT * FROM pesanan_header WHERE id='$id_pesanan'")->fetch_assoc();

$detail = $koneksi->query("SELECT * FROM pesanan_detail WHERE id_pesanan='$id_pesanan'");
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Nota Pesanan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f5f0e1, #e0c097);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    h1,
    h2,
    h3 {
      font-family: 'Playfair Display', serif;
    }

    .card-custom {
      background: #fff8f0;
      border: none;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .btn-anim:hover {
      transform: scale(1.05);
      transition: 0.3s;
    }

    footer {
      background: #3e2723;
      margin-top: auto;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">☕ Toko Kopi</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="produk.php">Produk</a></li>
          <li class="nav-item"><a class="nav-link active" href="#">Nota</a></li>
          <li class="nav-item"><a class="nav-link text-warning fw-bold" href="produk.php">← Kembali</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-5">
    <h1 class="text-center mb-4">Nota Pesanan</h1>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card card-custom p-4">
          <h4 class="mb-3">Data Pembeli</h4>
          <p><strong>Nama:</strong> <?php echo $header['nama']; ?></p>
          <p><strong>Email:</strong> <?php echo $header['email']; ?></p>
          <p><strong>Metode Pembayaran:</strong> <?php echo $header['pembayaran']; ?></p>
          <p><strong>Tanggal:</strong> <?php echo $header['tanggal']; ?></p>

          <h4 class="mt-4 mb-3">Produk Dipesan</h4>
          <ul class="list-group mb-3">
            <?php while ($row = $detail->fetch_assoc()) {
              $produk = $koneksi->query("SELECT * FROM produk WHERE id='" . $row['produk_id'] . "'")->fetch_assoc();
            ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo $produk['nama']; ?> (x<?php echo $row['jumlah']; ?>)
                <span>Rp <?php echo number_format($row['subtotal'], 0, ',', '.'); ?></span>
              </li>
            <?php } ?>
          </ul>
          <h5>Total Bayar: Rp <?php echo number_format($header['total'], 0, ',', '.'); ?></h5>

          <div class="alert alert-success text-center mt-4">
            <h4 class="fw-bold">Terima Kasih!</h4>
            <p>Pesanan Anda sudah kami terima. Kami akan segera memproses dan mengirimkan kopi terbaik untuk Anda ☕</p>
          </div>

          <div class="text-center mt-3">
            <a href="cetak_pdf.php?id=<?php echo $id_pesanan; ?>" target="_blank" class="btn btn-danger btn-lg btn-anim">Cetak PDF</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="text-white text-center py-3">
    <p>&copy; <?php echo date("Y"); ?> Toko Biji Kopi. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>