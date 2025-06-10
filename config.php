<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan_mobil");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
session_start();
?>
