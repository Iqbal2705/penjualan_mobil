
<?php
include 'config.php';
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="dashboard-container">
        <h2>Dashboard</h2>
        <nav>
            <a href="data_mobil.php">Data Mobil</a>
            <a href="form_pembelian.php">Form Pembelian</a>
            <a href="data_pembeli.php">Data Pembeli</a>
            <a href="statistik.php">Statistik Penjualan</a>
            <a href="logout.php" class="logout">Logout</a>
        </nav>
        <br>
        <hr>
        <h3>Selamat datang di Sistem Penjualan Mobil</h3>
        <p>
            Di dashboard ini Anda dapat mengelola <strong>data mobil</strong>, <strong>data pembeli</strong>, dan melakukan 
            <strong>pembelian mobil</strong>. Untuk melihat ringkasan <strong>statistik penjualan mobil</strong>, silakan klik menu 
            di atas.
        </p>
    </div>
</body>
</html>
