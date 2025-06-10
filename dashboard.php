
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
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #fff0f5, #ffc0cb);
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffffdd;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #d63384;
        }

        nav {
            text-align: center;
            margin: 20px 0;
        }

        nav a {
            text-decoration: none;
            color: white;
            background-color: #ff69b4;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 25px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 4px 10px rgba(255, 105, 180, 0.2);
        }

        nav a:hover {
            background-color: #ff85c1;
            transform: scale(1.05);
        }

        nav a.logout {
            background-color: #e74c3c;
        }

        nav a.logout:hover {
            background-color: #c0392b;
        }

        h3 {
            color: #c2185b;
        }

        p {
            line-height: 1.6;
            font-size: 1.1em;
            color: #555;
        }

        hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Dashboard</h2>
        <nav>
            <a href="data_mobil.php">Data Mobil</a>
            <a href="form_pembelian.php">Form Pembelian</a>
            <a href="data_pembeli.php">Data Pembeli</a>
            <a href="statistik.php">Statistik Penjualan</a>
            <a href="logout.php" class="logout">Logout</a>
        </nav>
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
