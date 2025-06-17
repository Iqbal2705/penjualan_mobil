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
<link rel="stylesheet" href="style.css">
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
