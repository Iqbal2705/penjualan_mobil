<?php
include 'config.php';


$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $message = "Username sudah digunakan!";
    } elseif ($password !== $konfirmasi) {
        $message = "Konfirmasi password tidak cocok!";
    } else {
        $hash = md5($password);
        mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$hash')");
        header("Location: login.php?pesan=akun_berhasil_dibuat");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #ffe6f0, #ffd6e0);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-container {
            background: #ffffffdd;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .register-container h2 {
            margin-bottom: 25px;
            color: #d63384;
        }

        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 16px;
            background: #fff0f5;
        }

        button {
            padding: 12px 20px;
            background-color: #ff69b4;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 95%;
            margin-top: 10px;
        }

        button:hover {
            background-color: #ff85c1;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .login-link {
            margin-top: 15px;
            display: block;
            color: #555;
        }

        .login-link a {
            color: #d63384;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>💕 Form Registrasi</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="password" name="konfirmasi" placeholder="Konfirmasi Password" required><br>
            <button type="submit">Daftar</button>
        </form>
        <?php if ($message): ?>
            <p class="error"><?= $message ?></p>
        <?php endif; ?>
        <p class="login-link">Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</body>
</html>
