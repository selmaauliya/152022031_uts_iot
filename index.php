<?php
// index.php

// Mengambil data JSON dari backend.php
$jsonData = file_get_contents('http://localhost/152022031_Selma_UTS/backend/backend.php'); 
$data = json_decode($jsonData, true);  // Parsing JSON menjadi array asosiatif PHP
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Cuaca</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Data Cuaca</h1>
        
        <div class="summary">
            <h2>Summary Data Cuaca</h2>
            <ul>
                <li><strong>Suhu Maksimum:</strong> <?= htmlspecialchars($data['suhumax']); ?> °C</li>
                <li><strong>Suhu Minimum:</strong> <?= htmlspecialchars($data['suhumin']); ?> °C</li>
                <li><strong>Suhu Rata-rata:</strong> <?= htmlspecialchars($data['suhurata']); ?> °C</li>
            </ul>
        </div>
        
        <div class="nilai-suhu">
            <h2>Data Nilai Suhu, Humiditas, dan Lux</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Suhu (°C)</th>
                        <th>Humiditas (%)</th>
                        <th>Kecerahan (Lux)</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['nilai_suhu_max_humid_max'] as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['id']); ?></td>
                        <td><?= htmlspecialchars($item['suhu']); ?>°C</td>
                        <td><?= htmlspecialchars($item['humid']); ?>%</td>
                        <td><?= htmlspecialchars($item['lux']); ?> lux</td>
                        <td><?= htmlspecialchars($item['ts']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="month-year">
            <h2>Bulan dan Tahun Suhu Maksimum</h2>
            <ul>
                <?php foreach ($data['month_year_max'] as $item): ?>
                    <li><?= htmlspecialchars($item['month_year']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>
