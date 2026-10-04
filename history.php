<?php
require_once __DIR__ . '/helpers.php';

$history = [
    ['name' => 'Alya', 'course' => 'Web Dasar', 'total' => 240000],
    ['name' => 'Bima', 'course' => 'PHP Dasar', 'total' => 340000],
    ['name' => 'Citra', 'course' => 'Laravel Dasar', 'total' => 500000],
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>History Dummy - KursusKu</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #d7dade;
            margin: 0;
            padding: 0;
            color: #333;
        }
        header {
            background-color: #0f172a;
            padding: 15px 30px;
        }
        header nav a {
            color: #cbd5e1;
            text-decoration: none;
            margin-right: 15px;
            font-weight: 500;
        }
        header nav a:hover {
            color: #ffffff;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .card-header {
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }
        .card-subtitle {
            color: #64748b;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .custom-table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-align: left;
            padding: 12px 16px;
            border-bottom: 2px solid #e2e8f0;
        }
        .custom-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
            font-size: 0.95rem;
        }
        .custom-table tbody tr:hover {
            background-color: #f8fafc;
        }
        .text-center {
            text-align: center;
        }
        .price-tag {
            font-weight: 600;
            color: #0284c7;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Beranda</a>
            <a href="registration.php">Daftar Kursus</a>
            <a href="history.php" style="color: #ffffff; font-weight: bold;">History Dummy</a>
            <a href="loop-lab.php">Loop Lab</a>
        </nav>
    </header>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Riwayat Pendaftaran (Dummy)</h1>
                <p class="card-subtitle">Data simulasi riwayat pendaftaran peserta kursus</p>
            </div>

            <table class="custom-table">
                <thead>
                    <tr>
                        <th class="text-center" width="80">No</th>
                        <th>Nama Peserta</th>
                        <th>Kursus yang Dipilih</th>
                        <th width="180">Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history as $index => $item): ?>
                        <tr>
                            <td class="text-center"><?= $index + 1 ?></td>
                            <td><strong><?= e($item['name']) ?></strong></td>
                            <td><?= e($item['course']) ?></td>
                            <td class="price-tag"><?= rupiah($item['total']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>