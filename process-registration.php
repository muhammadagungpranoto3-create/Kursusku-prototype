<?php
session_start(); // Wajib ditaruh di paling atas
require_once __DIR__ . '/helpers.php';

$siteName = 'KursusKu UIN';
$year = date('Y');

// Mengambil data dari form GET secara aman
$fullname         = htmlspecialchars($_GET['fullname'] ?? $_GET['name'] ?? $_GET['nama'] ?? '-');
$email            = htmlspecialchars($_GET['email'] ?? '-');
$phone            = htmlspecialchars($_GET['phone'] ?? $_GET['hp'] ?? '-');
$study_program    = htmlspecialchars($_GET['study_program'] ?? '-');
$course_raw       = htmlspecialchars($_GET['course'] ?? $_GET['course_code'] ?? '-');
$participant_type = htmlspecialchars($_GET['participant_type'] ?? '-');
$learning_method  = htmlspecialchars($_GET['learning_mode'] ?? $_GET['learning_method'] ?? 'online');
$package_qty      = (int)($_GET['package_count'] ?? $_GET['package_qty'] ?? 1);

// Memproses minat (array)
$interests_raw = $_GET['interests'] ?? [];
if (is_array($interests_raw)) {
    $interests = !empty($interests_raw) ? implode(', ', array_map('ucwords', $interests_raw)) : 'Tidak ada';
} else {
    $interests = !empty($interests_raw) ? htmlspecialchars($interests_raw) : 'Tidak ada';
}

$note   = htmlspecialchars($_GET['note'] ?? $_GET['catatan'] ?? '-');
$source = htmlspecialchars($_GET['source'] ?? $_GET['sumber'] ?? 'Formulir Website');
// Format nama kursus agar lebih rapi
$course_names = [
    'web-dasar'           => 'Web Dasar',
    'php-dasar'           => 'PHP Dasar',
    'php-lanjutan'        => 'PHP Lanjutan',
    'laravel-fundamental' => 'Laravel Fundamental',
    'mysql-dasar'         => 'MySQL Dasar',
    'ui-web-dasar'        => 'UI Web Dasar',
];
$course_display = $course_names[$course_raw] ?? ucwords(str_replace('-', ' ', $course_raw));

// Daftar Harga & Diskon untuk perhitungan otomatis
$course_prices = [
    'web-dasar'           => 200000,
    'php-dasar'           => 250000,
    'php-lanjutan'        => 350000,
    'laravel-fundamental' => 400000,
    'mysql-dasar'         => 200000,
    'ui-web-dasar'        => 250000,
];

$discounts = [
    'mahasiswa' => 0.20,
    'guru'      => 0.15,
    'umum'      => 0.00
];

// Hitung total biaya dinamis
$base_price    = $course_prices[$course_raw] ?? 200000;
$discount_rate = $discounts[strtolower($participant_type)] ?? 0;
$subtotal      = $base_price * $package_qty;
$total_price   = $subtotal - ($subtotal * $discount_rate);

// Inisialisasi array session history jika belum ada
if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = [
        ['name' => 'Alya',  'fullname' => 'Alya',  'course' => 'Web Dasar',     'total' => 240000],
        ['name' => 'Bima',  'fullname' => 'Bima',  'course' => 'PHP Dasar',     'total' => 340000],
        ['name' => 'Citra', 'fullname' => 'Citra', 'course' => 'Laravel Dasar', 'total' => 500000],
    ];
}

// Simpan pendaftaran baru dari form ke dalam session
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($fullname) && $fullname !== '-') {
    $_SESSION['history'][] = [
        'name'     => $fullname,
        'fullname' => $fullname,
        'course'   => $course_display,
        'total'    => $total_price
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ringkasan Pendaftaran - <?= htmlspecialchars($siteName) ?></title>
    
    <!-- Google Fonts & Font Awesome -->
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
                <a href="history.php">History Dummy</a>
                <a href="fee-calculator.php" class="btn-calculator"><i class="fa-solid fa-calculator"></i> Hitung Biaya</a>
            </nav>
        </div>
    </header>

    <main class="registration-section">
        <div class="container">
            <div class="success-card-wrapper">
                
                <!-- Icon Sukses -->
                <div class="success-header">
                    <div class="success-icon-circle">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <h2>Pendaftaran Diterima untuk Diproses</h2>
                    <p>Terima kasih! Periksa kembali data latihan pendaftaran Anda di bawah ini.</p>
                </div>

                <!-- Ringkasan Data -->
                <div class="summary-box">
                    <div class="summary-item">
                        <div class="summary-label"><i class="fa-solid fa-user"></i> Nama Lengkap</div>
                        <div class="summary-value"><strong><?= $fullname ?></strong></div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label"><i class="fa-solid fa-envelope"></i> Email</div>
                        <div class="summary-value"><?= $email ?></div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label"><i class="fa-solid fa-phone"></i> Nomor HP</div>
                        <div class="summary-value"><?= $phone ?></div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label"><i class="fa-solid fa-graduation-cap"></i> Program Studi</div>
                        <div class="summary-value"><?= strtoupper($study_program) ?></div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label"><i class="fa-solid fa-book-open"></i> Kursus Dipilih</div>
                        <div class="summary-value"><span class="highlight-badge"><?= $course_display ?></span></div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label"><i class="fa-solid fa-user-tag"></i> Jenis Peserta</div>
                        <div class="summary-value"><?= ucfirst($participant_type) ?></div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label"><i class="fa-solid fa-laptop"></i> Metode Belajar</div>
                        <div class="summary-value"><?= ucfirst($learning_method) ?></div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label"><i class="fa-solid fa-cubes"></i> Jumlah Paket</div>
                        <div class="summary-value"><?= $package_qty ?> Paket</div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label"><i class="fa-solid fa-layer-group"></i> Minat Tambahan</div>
                        <div class="summary-value"><?= $interests ?></div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label"><i class="fa-solid fa-receipt"></i> Total Biaya</div>
                        <div class="summary-value"><strong>Rp <?= number_format($total_price, 0, ',', '.') ?></strong></div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label"><i class="fa-solid fa-comment-dots"></i> Catatan</div>
                        <div class="summary-value"><?= !empty($note) && $note !== '-' ? $note : '<em>Tidak ada catatan</em>' ?></div>
                    </div>
                </div>

                <!-- Navigasi Tombol Aksi -->
                <div class="success-actions">
                    <a href="history.php" class="btn-action-fill">
                        <i class="fa-solid fa-clock-rotate-left"></i> Lihat Riwayat
                    </a>
                    <a href="registration.php" class="btn-action-outline">
                        <i class="fa-solid fa-pen-to-square"></i> Isi Form Lagi
                    </a>
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