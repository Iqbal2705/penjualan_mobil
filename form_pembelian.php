<?php
include 'config.php';
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$selected_mobil_id = isset($_GET['mobil_id']) ? (int)$_GET['mobil_id'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $pekerjaan = $_POST['pekerjaan'];
    $pembayaran = $_POST['pembayaran'];
    $mobil_id = $_POST['mobil_id'];

    mysqli_query($conn, "INSERT INTO pembelian (nama, email, alamat, pekerjaan, pembayaran, mobil_id) 
        VALUES ('$nama', '$email', '$alamat', '$pekerjaan', '$pembayaran', '$mobil_id')");
    $msg = "Pembelian berhasil disimpan!";
}

$mobil = mysqli_query($conn, "SELECT * FROM mobil");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pembelian Mobil</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #ffe6f0, #ffd6e0);
            margin: 0;
            padding: 40px;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #d63384;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffffcc;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
        }

        a {
            color: #d63384;
            font-weight: bold;
            text-decoration: none;
        }

        a:hover {
            color: #a61e55;
        }

        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 16px;
            resize: vertical;
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
        <h2>📝 Form Pembelian Mobil</h2>
        <p><a href="dashboard.php">← Kembali ke Dashboard</a></p>

        <?php if (isset($msg)) echo "<p class='success-message'>$msg</p>"; ?>

        <form method="post">
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="email" name="email" placeholder="Email" required>
            <textarea name="alamat" placeholder="Alamat" required></textarea>
            <input type="text" name="pekerjaan" placeholder="Pekerjaan" required>
            
            <select name="pembayaran" required>
                <option value="">Pilih Pembayaran</option>
                <option value="Cash">Cash</option>
                <option value="Debit">Debit</option>
            </select>

            <select name="mobil_id" required <?= $selected_mobil_id ? "disabled" : "" ?>>
                <option value="">Pilih Mobil</optio
