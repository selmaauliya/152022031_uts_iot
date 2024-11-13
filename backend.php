<?php
// backend.php

// Menghubungkan ke database
include('config.php');

// Query untuk mendapatkan suhu minimum, maksimum, dan rata-rata
$sql_suhu = "SELECT MIN(suhu) AS suhumin, MAX(suhu) AS suhumax, AVG(suhu) AS suhurata FROM tb_cuaca"; 
$result_suhu = $conn->query($sql_suhu);
$row_suhu = $result_suhu->fetch_assoc();

// Query untuk mendapatkan data cuaca lainnya
$sql = "SELECT id, suhu, humid, lux, ts FROM tb_cuaca"; 
$result = $conn->query($sql);

// Data cuaca lainnya
$data = [];
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Query untuk mendapatkan bulan dan tahun suhu maksimum
$sql_month_year_max = "SELECT DISTINCT DATE_FORMAT(ts, '%m-%Y') AS month_year FROM tb_cuaca WHERE suhu = (SELECT MAX(suhu) FROM tb_cuaca)";
$result_month_year_max = $conn->query($sql_month_year_max);

// Mengambil bulan dan tahun suhu maksimum
$month_year_max = [];
while($row_month_year = $result_month_year_max->fetch_assoc()) {
    $month_year_max[] = ["month_year" => $row_month_year['month_year']];
}

// Menutup koneksi database
$conn->close();

// Data cuaca tambahan
$response = [
    "suhumax" => $row_suhu['suhumax'],
    "suhumin" => $row_suhu['suhumin'],
    "suhurata" => round($row_suhu['suhurata'], 2),  // Membulatkan suhu rata-rata ke 2 desimal
    "nilai_suhu_max_humid_max" => $data,  // Data dari tabel
    "month_year_max" => $month_year_max  // Menambahkan bulan dan tahun berdasarkan suhu maksimum
];

echo json_encode($response);
?>
