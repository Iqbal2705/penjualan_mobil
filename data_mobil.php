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
    <link rel="stylesheet" href="style.css">
<<<<<<< HEAD

=======
>>>>>>> 0cfdf96 (progres kedua)
    <script>
        function confirmHapus(merk, model) {
            return confirm(`Yakin ingin menghapus mobil ${merk} ${model}?`);
        }
    </script>
</head>
<body>

    <h2>📋 Data Mobil</h2>
    <a href="dashboard.php" class="btn-back">← Kembali ke Dashboard</a>
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
<div><br></div>
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
