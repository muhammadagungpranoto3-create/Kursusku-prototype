<?php
session_start(); // Wajib ditaruh di paling atas untuk membaca session
require_once __DIR__ . '/helpers.php';

$siteName = 'KursusKu UIN';
$year = date('Y');

// Inisialisasi data awal jika session history belum ada
if (!isset($_SESSION['history']) || empty($_SESSION['history'])) {
    $_SESSION['history'] = [
        ['fullname' => 'Alya',  'course' => 'Web Dasar',     'total' => 240000],
        ['fullname' => 'Bima',  'course' => 'PHP Dasar',     'total' => 340000],
        ['fullname' => 'Citra', 'course' => 'Laravel Dasar', 'total' => 500000],
    ];
}

$historyData = $_SESSION['history'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Pendaftaran - <?= htmlspecialchars($siteName) ?></title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- External CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Header / Navigasi -->
    <header class="navbar">
        <div class="container nav-container">
            <a href="index.php" class="logo">
                <span class="logo-accent">Kursus</span>Ku <span class="logo-badge">UIN</span>
            </a>
            <nav class="nav-menu" aria-label="Navigasi utama">
                <a href="index.php">Home</a>
                <a href="index.php#katalog">Katalog</a>
                <a href="registration.php">Daftar</a>
                <a href="history.php" class="active">History Dummy</a>
                <a href="fee-calculator.php" class="btn-calculator"><i class="fa-solid fa-calculator"></i> Hitung Biaya</a>
            </nav>
        </div>
    </header>

    <main class="registration-section">
        <div class="container">
            <div class="form-card-wrapper">
                
                <div class="form-header" style="text-align: left;">
                    <h2>Riwayat Pendaftaran (Dummy)</h2>
                    <p>Data simulasi riwayat pendaftaran peserta kursus</p>
                </div>

                <div class="table-responsive" style="margin-top: 20px;">
                    <table class="history-table" style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 2px solid #eee; text-align: left;">
                                <th style="padding: 12px;">No</th>
                                <th style="padding: 12px;">Nama Peserta</th>
                                <th style="padding: 12px;">Kursus yang Dipilih</th>
                                <th style="padding: 12px;">Total Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($historyData as $index => $row): ?>
                                <tr style="border-bottom: 1px solid #f0f0f0;">
                                    <td style="padding: 12px;"><?= $index + 1 ?></td>
                                    <td style="padding: 12px;"><?= htmlspecialchars($row['fullname'] ?? $row['name'] ?? '-') ?></td>
                                    <td style="padding: 12px;"><?= htmlspecialchars($row['course'] ?? '-') ?></td>
                                    <td style="padding: 12px;">Rp <?= number_format($row['total'] ?? 0, 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-content">
            <div class="footer-brand">
                <a href="index.php" class="logo">
                    <span class="logo-accent">Kursus</span>Ku UIN
                </a>
                <p>&copy; <?= $year ?> <?= htmlspecialchars($siteName) ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>