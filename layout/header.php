<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Toko Biji Kopi</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
<div class="container">

<a class="navbar-brand fw-bold" href="index.php">☕ Kopiku</a>

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

<?php if(isset($_SESSION['username'])){ ?>

<?php if(isset($_SESSION['role']) && $_SESSION['role']=="admin"){ ?>
<li class="nav-item">
<a class="nav-link text-warning fw-bold" href="admin.php">⚙️ Admin</a>
</li>
<?php } ?>

<li class="nav-item d-flex align-items-center ms-3">

<?php
$fotoPath="assets/foto/".$_SESSION['foto'];

if(!empty($_SESSION['foto']) && file_exists($fotoPath)){
?>

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