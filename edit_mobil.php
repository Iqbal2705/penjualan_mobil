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
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #fff0f5, #ffc0cb);
            margin: 0;
            padding: 40px;
            color: #333;
        }

        h2 {
            color: #d63384;
            text-align: center;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: #ffffffcc;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .message {
            color: green;
            margin-bottom: 20px;
            text-align: center;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            color: #d63384;
            font-weight: bold;
            text-decoration: none;
        }

        a:hover {
            color: #a61e55;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #ff69b4;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #ff85c1;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>✏️ Edit Mobil</h2>
        <a href="data_mobil.php">← Kembali ke Data Mobil</a>

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
