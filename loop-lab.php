<?php
require_once __DIR__ . '/helpers.php';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loop Lab - KursusKu</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e1dcdc;
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
        .page-title {
            text-align: center;
            margin-bottom: 30px;
            color: #1e293b;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }
        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-top: 4px solid #0284c7;
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e2e8f0;
        }
        .badge-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .badge-item {
            background-color: #f1f5f9;
            color: #334155;
            padding: 8px 12px;
            margin-bottom: 8px;
            border-radius: 6px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .badge-item span {
            background-color: #0284c7;
            color: #ffffff;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Beranda</a>
            <a href="registration.php">Daftar Kursus</a>
            <a href="history.php">History Dummy</a>
            <a href="loop-lab.php" style="color: #ffffff; font-weight: bold;">Loop Lab</a>
        </nav>
    </header>

    <div class="container">
        <div class="page-title">
            <h1>Latihan Loop - Pertemuan 6</h1>
            <p>Implementasi perulangan FOR, WHILE, dan DO-WHILE dalam PHP</p>
        </div>

        <div class="grid-container">
            <!-- Card 1: Loop For -->
            <div class="card">
                <div class="card-title">1. Perulangan For</div>
                <ul class="badge-list">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <li class="badge-item">
                            Pertemuan Ke-<?= $i ?>
                            <span>FOR</span>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>

            <!-- Card 2: Loop While -->
            <div class="card" style="border-top-color: #10b981;">
                <div class="card-title">2. Perulangan While</div>
                <ul class="badge-list">
                    <?php 
                    $j = 1;
                    while ($j <= 5): 
                    ?>
                        <li class="badge-item">
                            Antrean No: <?= $j ?>
                            <span style="background-color: #10b981;">WHILE</span>
                        </li>
                        <?php $j++; ?>
                    <?php endwhile; ?>
                </ul>
            </div>

            <!-- Card 3: Loop Do-While -->
            <div class="card" style="border-top-color: #f59e0b;">
                <div class="card-title">3. Perulangan Do-While</div>
                <ul class="badge-list">
                    <?php 
                    $k = 1;
                    do {
                        echo '<li class="badge-item">Modul Praktikum ' . $k . ' <span style="background-color: #f59e0b;">DO-WHILE</span></li>';
                        $k++;
                    } while ($k <= 5);
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>