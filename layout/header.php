<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-dark shadow sticky-top" style="background-color: #561c24;">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center fw-bold text-uppercase text-white" href="index.php">
            <img src="assets/gambar/logo.jpeg" alt="Logo Kedaiku" height="50" class="d-inline-block align-text-top me-2">
            KEDAIKU
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="produk.php">Produk</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto align-items-center">
                <?php if (isset($_SESSION['username'])) : ?>
                    
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") : ?>
                        <li class="nav-item me-3">
                            <a class="nav-link text-warning fw-bold" href="admin.php">⚙️ Dashboard Admin</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white d-flex align-items-center fw-bold" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            $fotoPath = "assets/foto/" . $_SESSION['foto'];
                            if (!empty($_SESSION['foto']) && file_exists($fotoPath)) {
                                echo '<img src="' . $fotoPath . '" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover; border: 2px solid #e8d8c4;">';
                            } else {
                                echo '<img src="assets/foto/default.png" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover; border: 2px solid #e8d8c4;">';
                            }
                            ?>
                            <span>Hai, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        </a>
                        
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="profil.php">👤 Profil Akun</a></li>
                            <li><a class="dropdown-item" href="pesanan.php">🛍️ Riwayat Pesanan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger fw-bold" href="logout.php">🚪 Logout</a></li>
                        </ul>
                    </li>

                <?php else : ?>
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm px-4 rounded-pill" href="login.php">Login</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-light btn-sm px-4 rounded-pill text-dark fw-bold" href="register.php">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar-brand:hover {
        color: #e8d8c4 !important;
        transform: scale(1.02);
        transition: 0.2s;
    }
</style>
