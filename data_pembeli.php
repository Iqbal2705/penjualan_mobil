<?php
include 'config.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$data = mysqli_query($conn, "
    SELECT p.*, m.merk, m.model FROM pembelian p 
    JOIN mobil m ON p.mobil_id = m.id
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pembeli</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

    <h2>💖 Data Pembeli Mobil</h2>
    <a href="dashboard.php" class="btn-back">← Kembali ke Dashboard</a>


    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Pekerjaan</th>
            <th>Pembayaran</th>
            <th>Mobil</th>
        </tr>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['alamat']) ?></td>
            <td><?= htmlspecialchars($row['pekerjaan']) ?></td>
            <td><?= htmlspecialchars($row['pembayaran']) ?></td>
            <td><?= htmlspecialchars($row['merk']) . " " . htmlspecialchars($row['model']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
