<?php
// Pengaturan kredensial database default XAMPP
$host     = "localhost";
$username = "root";
$password = "";
$database = "ecommerce_db";

// Membuat koneksi ke database MySQL
$conn = mysqli_connect($host, $username, $password, $database);

// Periksa status koneksi
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>