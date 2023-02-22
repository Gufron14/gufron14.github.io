<?php
// File konfigurasi database

define('DB_HOST', 'localhost');
define('DB_USER', 'username');
define('DB_PASS', 'password');
define('DB_NAME', 'kpum_vote');

// Membuat koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'voting');

// Mengecek koneksi
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>