<?php
include 'config.php';
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: data_mobil.php");
    exit;
}

$id = (int)$_GET['id'];
$mobil = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mobil WHERE id=$id"));

if (!$mobil) {
    header("Location: data_mobil.php");
    exit;
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $merk = $_POST['merk'];
    $model = $_POST['model'];
    $harga = $_POST['harga'];

    if (!empty($merk) && !empty($model) && !empty($harga) && is_numeric($harga)) {
        mysqli_query($conn, "UPDATE mobil SET merk='$merk', model='$model', harga=$harga WHERE id=$id");
        $message = "Data mobil berhasil diperbarui!";
        $mobil = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mobil WHERE id=$id"));
    } else {
        $message = "Mohon isi semua data dengan benar.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mobil</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

    <div class="container">
        <h2>✏️ Edit Mobil</h2>
        <a href="dashboard.php" class="btn-back">← Kembali ke Dashboard</a>


        <?php if ($message): ?>
            <p class="message"><?= $message; ?></p>
        <?php endif; ?>

        <form method="post">
            <input type="text" name="merk" placeholder="Merk Mobil" value="<?= htmlspecialchars($mobil['merk']) ?>" required>
            <input type="text" name="model" placeholder="Model Mobil" value="<?= htmlspecialchars($mobil['model']) ?>" required>
            <input type="number" name="harga" placeholder="Harga (angka)" value="<?= $mobil['harga'] ?>" required>
            <button type="submit">💾 Update Mobil</button>
        </form>
    </div>

</body>
</html>

</html>
