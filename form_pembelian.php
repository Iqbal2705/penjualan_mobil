<?php
include 'config.php';
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$selected_mobil_id = isset($_GET['mobil_id']) ? (int)$_GET['mobil_id'] : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $pekerjaan = $_POST['pekerjaan'];
    $pembayaran = $_POST['pembayaran'];
    $mobil_id = isset($_POST['mobil_id']) ? (int)$_POST['mobil_id'] : 0;

    // Add validation
    if ($mobil_id > 0) {
        // Use prepared statement to prevent SQL injection
        $stmt = mysqli_prepare($conn, "INSERT INTO pembelian (nama, email, alamat, pekerjaan, pembayaran, mobil_id) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssssi", $nama, $email, $alamat, $pekerjaan, $pembayaran, $mobil_id);
        
        if (mysqli_stmt_execute($stmt)) {
            $msg = "Pembelian berhasil disimpan!";
        } else {
            $msg = "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        $msg = "Pilih mobil terlebih dahulu!";
    }
}

$mobil = mysqli_query($conn, "SELECT * FROM mobil");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pembelian Mobil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="dashboard-container">
        <h2>📝 Form Pembelian Mobil</h2>
        <a href="dashboard.php" class="btn-back">← Kembali ke Dashboard</a>

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

            <select name="mobil_id" required <?= $selected_mobil_id ? "" : "" ?>>
                <option value="">Pilih Mobil</option>
                <?php while ($row = mysqli_fetch_assoc($mobil)): ?>
                    <option value="<?= $row['id'] ?>" <?= ($selected_mobil_id == $row['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['merk'] . ' ' . $row['model'] . ' - Rp ' . number_format($row['harga'], 0, ',', '.')) ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <!-- If mobil_id is pre-selected from URL, add hidden field -->
            <?php if ($selected_mobil_id > 0): ?>
                <input type="hidden" name="mobil_id" value="<?= $selected_mobil_id ?>">
                <script>
                    // Disable the select if pre-selected
                    document.querySelector('select[name="mobil_id"]').disabled = true;
                </script>
            <?php endif; ?>

            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>