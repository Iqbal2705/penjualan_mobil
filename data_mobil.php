<?php
include 'config.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$message = "";

// Proses tambah mobil
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_mobil'])) {
    $merk = $_POST['merk'];
    $model = $_POST['model'];
    $harga = $_POST['harga'];

    if (!empty($merk) && !empty($model) && !empty($harga) && is_numeric($harga)) {
        mysqli_query($conn, "INSERT INTO mobil (merk, model, harga) VALUES ('$merk', '$model', $harga)");
        $message = "Mobil berhasil ditambahkan!";
    } else {
        $message = "Mohon isi semua data dengan benar.";
    }
}

// Proses hapus mobil
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($conn, "DELETE FROM mobil WHERE id=$id");
    header("Location: data_mobil.php");
    exit;
}

// Ambil data mobil
$result = mysqli_query($conn, "SELECT * FROM mobil");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mobil</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(to right, #fff0f5, #ffc0cb);
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h2 {
            color: #d63384;
        }

        .message {
            color: #155724;
            background-color: #fce4ec;
            border: 1px solid #f8bbd0;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            max-width: 600px;
        }

        .form-container {
            background-color: #ffffffcc;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            max-width: 600px;
        }

        input[type="text"],
        input[type="number"] {
            padding: 10px;
            width: calc(100% - 24px);
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            background-color: #ff69b4;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s;
        }

        button:hover {
            background-color: #ff85c1;
            transform: scale(1.05);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        th, td {
            padding: 14px 16px;
            border-bottom: 1px solid #eee;
            text-align: center;
        }

        th {
            background-color: #ffb6c1;
            color: #fff;
        }

        tr:hover {
            background-color: #ffe6f0;
        }

        .aksi a {
            margin: 0 6px;
            text-decoration: none;
            color: #d63384;
            font-weight: bold;
            transition: color 0.3s;
        }

        .aksi a:hover {
            color: #a61e55;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 15px;
            font-weight: bold;
            color: #d63384;
            text-decoration: none;
        }

        .back-link:hover {
            color: #a61e55;
        }
    </style>
    <script>
        function confirmHapus(merk, model) {
            return confirm(`Yakin ingin menghapus mobil ${merk} ${model}?`);
        }
    </script>
</head>
<body>

    <h2>📋 Data Mobil</h2>
    <a href="dashboard.php" class="back-link">← Kembali ke Dashboard</a>

    <?php if ($message): ?>
        <p class="message"><?= $message; ?></p>
    <?php endif; ?>

    <div class="form-container">
        <h3 style="margin-top: 0;">➕ Tambah Mobil Baru</h3>
        <form method="post">
            <input type="text" name="merk" placeholder="Merk Mobil" required>
            <input type="text" name="model" placeholder="Model Mobil" required>
            <input type="number" name="harga" placeholder="Harga (angka)" required>
            <button type="submit" name="tambah_mobil">Tambah Mobil</button>
        </form>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Merk</th>
            <th>Model</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['merk']) ?></td>
            <td><?= htmlspecialchars($row['model']) ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
            <td class="aksi">
                <a href="edit_mobil.php?id=<?= $row['id'] ?>">✏️ Edit</a> | 
                <a href="data_mobil.php?hapus=<?= $row['id'] ?>" onclick="return confirmHapus('<?= addslashes($row['merk']) ?>', '<?= addslashes($row['model']) ?>')">🗑️ Hapus</a> | 
                <a href="form_pembelian.php?mobil_id=<?= $row['id'] ?>">🛒 Beli</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
