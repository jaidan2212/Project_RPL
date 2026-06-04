<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$file = $_GET['file'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lihat Bukti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="text-center">

        <img src="assets/gambar/<?php echo $file; ?>" 
             class="img-fluid rounded shadow"
             style="max-width: 700px; width: 100%;">

        <div class="mt-4">
            <a href="admin.php" class="btn btn-dark px-4">
                ← Kembali
            </a>
        </div>

    </div>

</div>

</body>
</html>