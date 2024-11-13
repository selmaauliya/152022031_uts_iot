<?php
// config.php

$servername = "localhost";
$username = "root";
$password = ""; // Jika menggunakan password kosong, jika tidak sesuaikan
$dbname = "iot";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
