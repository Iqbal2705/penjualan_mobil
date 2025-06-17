<?php
include 'config.php';


if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Query data
$mobil_laris_q = mysqli_query($conn, "
    SELECT m.merk, m.model, COUNT(p.id) AS jumlah 
    FROM mobil m 
    LEFT JOIN pembelian p ON m.id = p.mobil_id 
    GROUP BY m.id 
    ORDER BY jumlah DESC 
    LIMIT 3
");

$mobil_mahal_q = mysqli_query($conn, "
    SELECT merk, model, harga 
    FROM mobil 
    ORDER BY harga DESC 
    LIMIT 3
");

$mobil_tidak_laku_q = mysqli_query($conn, "
    SELECT m.merk, m.model 
    FROM mobil m 
    LEFT JOIN pembelian p ON m.id = p.mobil_id 
    WHERE p.id IS NULL 
    LIMIT 3
");

$total_terjual = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pembelian"))['total'];

$total_pembelian = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT SUM(m.harga) AS total 
    FROM pembelian p 
    JOIN mobil m ON p.mobil_id = m.id
"))['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Statistik Penjualan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>📊 Statistik Penjualan Mobil</h2>
        <a href="dashboard.php" class="btn-back">← Kembali ke Dashboard</a>

        <h3>🚗 3 Mobil Paling Laku</h3>
        <table>
            <tr>
                <th>No</th>
                <th>Merk</th>
                <th>Model</th>
                <th>Jumlah Terjual</th>
            </tr>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($mobil_laris_q)) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['merk']) ?></td>
                <td><?= htmlspecialchars($row['model']) ?></td>
                <td><?= $row['jumlah'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <h3>💰 3 Mobil Termahal</h3>
        <table>
            <tr>
                <th>No</th>
                <th>Merk</th>
                <th>Model</th>
                <th>Harga</th>
            </tr>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($mobil_mahal_q)) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['merk']) ?></td>
                <td><?= htmlspecialchars($row['model']) ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <h3>🚫 3 Mobil Tidak Pernah Terjual</h3>
        <table>
            <tr>
                <th>No</th>
                <th>Merk</th>
                <th>Model</th>
            </tr>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($mobil_tidak_laku_q)) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['merk']) ?></td>
                <td><?= htmlspecialchars($row['model']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <h3>📈 Ringkasan</h3>
        <table>
            <tr>
                <th>Total Mobil Terjual</th>
                <td><?= $total_terjual ?></td>
            </tr>
            <tr>
                <th>Total Nominal Pembelian</th>
                <td>Rp <?= number_format($total_pembelian ?: 0, 0, ',', '.') ?></td>
            </tr>
        </table>
    </div>
</body>
</html>
