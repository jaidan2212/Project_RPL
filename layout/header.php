<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
    <div class="container">

        <a class="navbar-brand fw-bold" href="index.php">☕ Kedaiku</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="produk.php">Produk</a>
                </li>

                <?php if (isset($_SESSION['username'])) { ?>

                    <li class="nav-item d-flex align-items-center">

                        <?php
                        $fotoPath = "assets/foto/" . $_SESSION['foto'];

                        if (!empty($_SESSION['foto']) && file_exists($fotoPath)) { ?>
                            <img src="<?php echo $fotoPath ?>" class="foto-user me-2">
                        <?php } else { ?>
                            <img src="assets/foto/default.png" class="foto-user me-2">
                        <?php } ?>

                        <span class="nav-link">Hai, <?php echo $_SESSION['username']; ?></span>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>

                <?php } else { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>

                <?php } ?>

            </ul>

        </div>
    </div>
</nav>