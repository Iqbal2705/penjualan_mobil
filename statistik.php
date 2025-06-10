<?php
include 'config.php';


if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$total_terjual = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pembelian"))['total'];

$mobil_terbanyak_q = mysqli_query($conn, "
    SELECT m.merk, m.model, COUNT(p.id) AS jumlah 
    FROM mobil m LEFT JOIN pembelian p ON m.id = p.mobil_id 
    GROUP BY m.id ORDER BY jumlah DESC LIMIT 1
");
$mobil_terbanyak = mysqli_fetch_assoc($mobil_terbanyak_q);

$mobil_tersedikit_q = mysqli_query($conn, "
    SELECT m.merk, m.model, COUNT(p.id) AS jumlah 
    FROM mobil m LEFT JOIN pembelian p ON m.id = p.mobil_id 
    GROUP BY m.id ORDER BY jumlah ASC LIMIT 1
");
$mobil_tersedikit = mysqli_fetch_assoc($mobil_tersedikit_q);

$total_pembelian = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT SUM(m.harga) AS total 
    FROM pembelian p JOIN mobil m ON p.mobil_id = m.id
"))['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Statistik Penjualan</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #ffe6f0, #fff);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            background: #fff0f5;
            margin-top: 50px;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            width: 90%;
            max-width: 600px;
        }

        h2 {
            text-align: center;
            color: #d63384;
            margin-bottom: 30px;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            color: #d63384;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .stat {
            background: #fff;
            border-left: 5px solid #ff69b4;
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 16px;
        }

        .stat strong {
            display: block;
            font-size: 17px;
            color: #cc0077;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>💗 Statistik Penjualan Mobil</h2>
        <a href="dashboard.php">← Kembali ke Dashboard</a>

        <div class="stat">
            <strong>Total Mobil Terjual:</strong>
            <?= $total_terjual ?>
        </div>

        <div class="stat">
            <strong>Mobil Terbanyak Terjual:</strong>
            <?= $mobil_terbanyak ? $mobil_terbanyak['merk'] . " " . $mobil_terbanyak['model'] . " (" . $mobil_terbanyak['jumlah'] . ")" : "Data tidak tersedia" ?>
        </div>

        <div class="stat">
            <strong>Mobil Tersedikit Terjual:</strong>
            <?= $mobil_tersedikit ? $mobil_tersedikit['merk'] . " " . $mobil_tersedikit['model'] . " (" . $mobil_tersedikit['jumlah'] . ")" : "Data tidak tersedia" ?>
        </div>

        <div class="stat">
            <strong>Total Pembelian (Rp):</strong>
            <?= number_format($total_pembelian ?: 0, 0, ',', '.') ?>
        </div>
    </div>
</body>
</html>
