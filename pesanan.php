<?php
session_start();
include 'koneksi.php';

// Jika belum login, paksa kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil nama user yang sedang login untuk memfilter pesanan
$username_login = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan - Kedaiku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #c7b7a3;
        }

        .text-velvet { color: #561c24 !important; }
        .bg-velvet { background-color: #561c24 !important; color: white; }

        .list-group-item {
            font-weight: 600;
            border: 1px solid #e8d8c4;
            padding: 15px 20px;
            color: #561c24;
            background: #fff;
        }
        .list-group-item:hover { background-color: #e8d8c4; }
        .list-group-item.active {
            background-color: #561c24 !important;
            border-color: #561c24 !important;
            color: white;
        }

        .card-pesanan {
            background: #fff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            overflow: hidden;
        }
        .card-pesanan-header {
            background: #e8d8c4;
            padding: 10px 20px;
            font-weight: bold;
            color: #561c24;
            border-bottom: 2px solid #c7b7a3;
        }
        .img-pesanan {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .btn-main { background: #6d2932; color: white; border: none; font-weight: 600; }
        .btn-main:hover { background: #561c24; color: white; }
        .btn-outline-main { border: 2px solid #6d2932; color: #6d2932; font-weight: 600; background: white; }
        .btn-outline-main:hover { background: #6d2932; color: white; }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include 'layout/header.php'; ?>

    <div class="container my-5 flex-grow-1">
        
        <h2 class="fw-bold text-velvet mb-4">Hi, <?php echo $_SESSION['username']; ?></h2>

        <div class="row mt-4">
            <div class="col-md-3 mb-4">
                <div class="list-group shadow-sm">
                    <a href="profil.php" class="list-group-item list-group-item-action">👤 Profil Akun</a>
                    <a href="pesanan.php" class="list-group-item list-group-item-action active">🛍️ Riwayat Pesanan</a>
                    <a href="logout.php" class="list-group-item list-group-item-action text-danger fw-bold">🚪 Logout</a>
                </div>
            </div>

            <div class="col-md-9">
                <h4 class="fw-bold text-velvet mb-4">RIWAYAT PESANAN SAYA</h4>
                
                <?php
                // Mengambil data dari tabel pesanan_header milik user yang login
                // (Menggunakan filter 'nama' sesuai dengan kode nota.php sebelumnya)
                $query_pesanan = $koneksi->query("SELECT * FROM pesanan_header WHERE nama='$username_login' ORDER BY id DESC");

                if ($query_pesanan->num_rows > 0) {
                    while ($row = $query_pesanan->fetch_assoc()) {
                        $id_pesanan = $row['id'];
                        
                        // Ambil 1 produk dari detail pesanan untuk dijadikan gambar thumbnail di riwayat
                        $query_detail = $koneksi->query("SELECT p.nama as nama_produk, p.gambar 
                                                         FROM pesanan_detail pd 
                                                         JOIN produk p ON pd.produk_id = p.id 
                                                         WHERE pd.id_pesanan='$id_pesanan' LIMIT 1");
                        $detail = $query_detail->fetch_assoc();
                        
                        // Cek status pesanan (default 'Diproses' jika belum ada field status)
                        $status = isset($row['status']) ? $row['status'] : 'Diproses';
                        $warna_status = (strtolower($status) == 'selesai') ? 'text-success' : 'text-warning';
                ?>
                    <div class="card card-pesanan">
                        <div class="card-pesanan-header d-flex justify-content-between align-items-center">
                            <span>Status: <span class="<?php echo $warna_status; ?> fw-bold"><?php echo $status; ?></span></span>
                            <span class="small text-muted">Tanggal: <?php echo date('d M Y, H:i', strtotime($row['tanggal'])); ?></span>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-2 text-center mb-3 mb-md-0">
                                    <?php if($detail && !empty($detail['gambar'])) { ?>
                                        <img src="assets/gambar/<?php echo $detail['gambar']; ?>" class="img-pesanan shadow-sm">
                                    <?php } else { ?>
                                        <div class="img-pesanan bg-light d-flex align-items-center justify-content-center shadow-sm fs-1 text-muted">☕</div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-7">
                                    <h5 class="fw-bold mb-1">
                                        <?php echo $detail ? $detail['nama_produk'] : 'Pesanan Kopi'; ?>
                                        <?php 
                                        // Cek apakah ada lebih dari 1 macam produk dalam 1 nomor pesanan
                                        $cek_jumlah = $koneksi->query("SELECT COUNT(id) as jml FROM pesanan_detail WHERE id_pesanan='$id_pesanan'")->fetch_assoc();
                                        if($cek_jumlah['jml'] > 1) {
                                            echo "<span class='text-muted small fs-6 fw-normal'> (+ " . ($cek_jumlah['jml'] - 1) . " produk lainnya)</span>";
                                        }
                                        ?>
                                    </h5>
                                    <p class="text-muted small mb-1">Metode: <span class="badge bg-secondary"><?php echo $row['pembayaran']; ?></span></p>
                                    <p class="text-muted small mb-2">ID Transaksi: #<?php echo str_pad($id_pesanan, 5, '0', STR_PAD_LEFT); ?></p>
                                    <h6 class="fw-bold text-velvet">Total: Rp <?php echo number_format($row['total'], 0, ',', '.'); ?></h6>
                                </div>
                                
                                <div class="col-md-3 text-md-end text-center mt-3 mt-md-0 d-flex flex-column gap-2">
                                    <a href="nota.php?id=<?php echo $id_pesanan; ?>" class="btn btn-outline-secondary w-100 fw-bold">
                                        <i class="fa-solid fa-receipt me-1"></i> Lihat Nota
                                    </a>
                                    <a href="produk.php" class="btn btn-outline-main w-100">Beli Lagi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                    } // Tutup while
                } else { 
                ?>
                    <div class="alert text-center py-5 border-0 shadow-sm" style="background-color: #fff; color: #561c24;">
                        <i class="fa-solid fa-basket-shopping fs-1 mb-3 text-muted"></i>
                        <h5 class="fw-bold">Belum Ada Pesanan</h5>
                        <p class="text-muted mb-3">Wah, riwayat pesananmu masih kosong. Yuk, pesan kopi favoritmu!</p>
                        <a href="produk.php" class="btn btn-main px-4">Belanja Sekarang</a>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

    <footer class="text-white text-center py-3 mt-auto" style="background: #561c24;">
        <p class="mb-0">&copy; <?php echo date("Y"); ?> Toko Biji Kopi. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>