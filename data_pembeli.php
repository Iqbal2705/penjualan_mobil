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
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 30px;
            color: #333;
        }

        h2 {
            color: #d63384;
        }

        a {
            text-decoration: none;
            background-color: #f8d7da;
            padding: 10px 16px;
            border-radius: 8px;
            color: #d63384;
            font-weight: bold;
            transition: all 0.3s ease;
            display: inline-block;
        }

        a:hover {
            background-color: #f3a6b1;
            color: white;
            box-shadow: 0 0 8px rgba(214, 51, 132, 0.3);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 14px 16px;
            text-align: center;
        }

        th {
            background-color: #d63384;
            color: white;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #fff0f5;
        }

        tr:hover {
            background-color: #ffe0eb;
        }
    </style>
</head>
<body>

    <h2>💖 Data Pembeli Mobil</h2>
    <a href="dashboard.php">← Kembali ke Dashboard</a>

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
