<?php 
session_start();
include 'koneksi.php';
$id_pesanan = $_GET['id'];

$header = $koneksi->query("SELECT * FROM pesanan_header WHERE id='$id_pesanan'")->fetch_assoc();

$detail = $koneksi->query("SELECT * FROM pesanan_detail WHERE id_pesanan='$id_pesanan'");
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Nota Pesanan - Kedaiku</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #c7b7a3; /* Background Krem Kedaiku */
    }

    h1, h2, h3, h4, h5 {
      font-family: 'Playfair Display', serif;
      color: #561c24; /* Merah Velvet */
    }

    .text-velvet { color: #561c24 !important; }
    
    .card-custom {
      background: #fff;
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-main {
      background: #6d2932;
      color: white;
      border: none;
      font-weight: 600;
    }

    .btn-main:hover {
      background: #561c24;
      color: white;
    }

    .btn-anim:hover {
      transform: scale(1.05);
      transition: 0.3s;
    }

    /* CSS Khusus Saat Halaman Di-Print */
    @media print {
      nav, footer, .no-print {
        display: none !important;
      }
      body {
        background: #fff !important;
      }
      .card-custom {
        box-shadow: none !important;
        border: 1px solid #000;
      }
    }
  </style>
</head>

<body class="d-flex flex-column min-vh-100">

  <?php include 'layout/header.php'; ?>

  <div class="container my-5 flex-grow-1">
    
    <div class="mb-4 no-print text-center">
        <a href="produk.php" class="btn btn-outline-secondary fw-bold rounded-pill px-4">← Kembali Belanja</a>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card card-custom p-4 p-md-5">
          
          <div class="text-center border-bottom pb-4 mb-4">
              <h2 class="fw-bold text-velvet mb-1">☕ Kedaiku</h2>
              <p class="text-muted mb-0">Jl. Telang Raya, Kamal, Bangkalan</p>
              <h5 class="mt-3 fw-bold text-dark">NOTA PESANAN</h5>
              <p class="text-muted small mb-0">ID Pesanan: #<?php echo str_pad($id_pesanan, 5, '0', STR_PAD_LEFT); ?></p>
          </div>

          <div class="row mb-4">
              <div class="col-sm-7 mb-3 mb-sm-0">
                  <h6 class="fw-bold text-muted mb-2">Informasi Pembeli:</h6>
                  <p class="mb-1"><strong>Nama:</strong> <?php echo $header['nama']; ?></p>
                  <p class="mb-1"><strong>Email:</strong> <?php echo $header['email']; ?></p>
              </div>
              <div class="col-sm-5 text-sm-end">
                  <h6 class="fw-bold text-muted mb-2">Detail Transaksi:</h6>
                  <p class="mb-1"><strong>Tanggal:</strong> <?php echo date('d M Y', strtotime($header['tanggal'])); ?></p>
                  <p class="mb-1"><strong>Metode:</strong> <span class="badge bg-success"><?php echo $header['pembayaran']; ?></span></p>
              </div>
          </div>

          <h6 class="fw-bold text-muted mb-3">Produk Dipesan:</h6>
          <ul class="list-group mb-4">
            <?php 
            if ($detail->num_rows > 0) {
                while ($row = $detail->fetch_assoc()) {
                  $produk = $koneksi->query("SELECT * FROM produk WHERE id='" . $row['produk_id'] . "'")->fetch_assoc();
            ?>
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-2">
                <div>
                    <span class="fw-bold text-dark"><?php echo $produk['nama']; ?></span><br>
                    <small class="text-muted">Jumlah: <?php echo $row['jumlah']; ?> x</small>
                </div>
                <span class="fw-bold text-dark">Rp <?php echo number_format($row['subtotal'], 0, ',', '.'); ?></span>
              </li>
            <?php 
                } 
            } else {
                echo "<li class='list-group-item text-center border-0'>Tidak ada detail produk.</li>";
            }
            ?>
            
            <li class="list-group-item d-flex justify-content-between align-items-center border-top border-dark px-0 mt-3 pt-3">
                <h5 class="fw-bold text-dark mb-0">Total Bayar</h5>
                <h4 class="fw-bold text-velvet mb-0">Rp <?php echo number_format($header['total'], 0, ',', '.'); ?></h4>
            </li>
          </ul>

          <div class="alert text-center mt-2 border-0" style="background-color: #e8d8c4; color: #561c24;">
            <h5 class="fw-bold mb-1">Terima Kasih!</h5>
            <p class="mb-0 small">Pesanan Anda telah kami terima dan akan segera kami proses. Nikmati kopi terbaik dari Kedaiku ☕</p>
          </div>

          <div class="text-center mt-4 no-print">
            <button onclick="window.print()" class="btn btn-main btn-lg btn-anim px-5 rounded-pill shadow">
                <i class="fa-solid fa-print me-2"></i> Cetak Nota
            </button>
          </div>

        </div>
      </div>
    </div>
  </div>

  <footer class="text-white text-center py-3 mt-auto no-print" style="background: #561c24;">
    <p class="mb-0">&copy; <?php echo date("Y"); ?> Toko Biji Kopi. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>