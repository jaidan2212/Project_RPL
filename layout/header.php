<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #561c24; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">☕ Kedaiku</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-2">
                    <a class="nav-link text-white" href="index.php">Home</a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link text-white" href="produk.php">Produk</a>
                </li>

                <?php if (isset($_SESSION['username'])) { ?>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") { ?>
                        <li class="nav-item me-2">
                            <a class="nav-link text-warning fw-bold" href="admin.php">⚙️ Dashboard Admin</a>
                        </li>
                    <?php } ?>

                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" id="profilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            $fotoPath = "assets/foto/" . $_SESSION['foto'];
                            if (!empty($_SESSION['foto']) && file_exists($fotoPath)) {
                            ?>
                                <img src="<?php echo $fotoPath ?>" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover; border: 2px solid #e8d8c4;">
                            <?php } else { ?>
                                <img src="assets/foto/default.png" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover; border: 2px solid #e8d8c4;">
                            <?php } ?>
                            <span class="fw-bold">Hai, <?php echo $_SESSION['username']; ?></span>
                        </a>
                        
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            <li><a class="dropdown-item" href="profil.php">👤 Profil Akun</a></li>
                            <li><a class="dropdown-item" href="pesanan.php">🛍️ Riwayat Pesanan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger fw-bold" href="logout.php">🚪 Logout</a></li>
                        </ul>
                    </li>

                <?php } else { ?>
                    <li class="nav-item ms-3">
                        <a class="btn btn-light text-dark fw-bold px-4 rounded-pill shadow-sm" href="login.php">Login</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>