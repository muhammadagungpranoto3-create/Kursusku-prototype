<?php
require_once __DIR__ . '/helpers.php';

$siteName = 'KursusKu UIN';
$tagline = 'Belajar, daftar, dan kelola kursus dalam satu tempat.';
$year = date('Y');

$courses = [
    [
        'code'       => 'WEB-01',
        'name'       => 'Web Dasar',
        'fee'        => 200000,
        'quota'      => 30,
        'registered' => 12,
        'start_date' => '2026-09-21',
    ],
    [
        'code'       => 'PHP-01',
        'name'       => 'PHP Dasar',
        'fee'        => 250000,
        'quota'      => 30,
        'registered' => 18,
        'start_date' => '2026-09-22',
    ],
    [
        'code'       => 'PHP-02',
        'name'       => 'PHP Lanjutan',
        'fee'        => 300000,
        'quota'      => 25,
        'registered' => 24,
        'start_date' => '2026-09-24',
    ],
    [
        'code'       => 'LAR-01',
        'name'       => 'Laravel Fundamental',
        'fee'        => 350000,
        'quota'      => 25,
        'registered' => 25,
        'start_date' => '2026-09-28',
    ],
    [
        'code'       => 'DB-01',
        'name'       => 'MySQL Dasar',
        'fee'        => 275000,
        'quota'      => 20,
        'registered' => 0,
        'start_date' => '2026-10-01',
    ],
    [
        'code'       => 'UI-01',
        'name'       => 'UI Web Dasar',
        'fee'        => 225000,
        'quota'      => 35,
        'registered' => 9,
        'start_date' => '2026-10-03',
    ],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($siteName) ?></title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- External CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Navigasi / Header -->
    <header class="navbar">
        <div class="container nav-container">
            <a href="index.php" class="logo">
                <span class="logo-accent">Kursus</span>Ku <span class="logo-badge">UIN</span>
            </a>
            <nav class="nav-menu" aria-label="Navigasi utama">
    <a href="index.php" class="active">Home</a>
    <a href="#keunggulan">Keunggulan</a>
    <a href="#katalog">Katalog</a>
    <a href="#alur">Cara Daftar</a>
    <a href="#media">Media</a>
    <a href="#kontak">Kontak</a>
    <!-- Tambah 2 menu baru di bawah ini -->
<a href="history.php">History Dummy</a>
<a href="loop-lab.php">Loop Lab</a>
<a href="test-matrix.php">Test Matrix</a>
<a href="fee-calculator.php" class="btn-calculator"><i class="fa-solid fa-calculator"></i> Hitung Biaya</a>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section id="hero" class="hero">
            <div class="container hero-content">
                <h1><?= htmlspecialchars($tagline) ?></h1>
                <p class="hero-sub">Temukan kursus teknologi yang relevan untuk meningkatkan keterampilan Anda secara terarah dan terukur.</p>
                
                <div class="hero-buttons">
                    <a href="#katalog" class="hero-card-btn orange-btn">
                        <div class="btn-icon"><i class="fa-solid fa-book-open"></i></div>
                        <div class="btn-text">
                            <strong>Lihat Katalog Kursus</strong>
                            <span>Jelajahi semua materi</span>
                        </div>
                    </a>
                    <a href="fee-calculator.php" class="hero-card-btn teal-btn">
                        <div class="btn-icon"><i class="fa-solid fa-calculator"></i></div>
                        <div class="btn-text">
                            <strong>Lihat Estimasi Biaya Kursus</strong>
                            <span>Hitung investasi belajar</span>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- Section Keunggulan -->
        <section id="keunggulan" class="section-features">
            <div class="container">
                <h2 class="section-title">Mengapa Memilih KursusKu?</h2>
                
                <div class="features-grid">
                    <article class="feature-card card-orange">
                        <div class="card-badge">1</div>
                        <div class="card-icon">
                            <i class="fa-solid fa-compass"></i>
                        </div>
                        <h3>Materi Terarah</h3>
                        <p>Materi disusun bertahap dari dasar hingga praktik berbasis industri.</p>
                    </article>

                    <article class="feature-card card-blue">
                        <div class="card-badge">2</div>
                        <div class="card-icon">
                            <i class="fa-solid fa-laptop-code"></i>
                        </div>
                        <h3>Belajar dengan Proyek</h3>
                        <p>Setiap tahap menghasilkan bagian nyata dari aplikasi portofolio Anda.</p>
                    </article>

                    <article class="feature-card card-green">
                        <div class="card-badge">3</div>
                        <div class="card-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <h3>Pendampingan Praktik</h3>
                        <p>Mahasiswa belajar melalui demonstrasi, latihan, dan evaluasi mentor.</p>
                    </article>
                </div>
            </div>
        </section>

        <!-- Section Katalog Kursus -->
        <section id="katalog" class="section-courses">
            <div class="container">
                <h2 class="section-title">Katalog Kursus</h2>
                
                <div class="table-card">
                    <div class="table-responsive">
                       <!-- Bagian Tabel di index.php -->
<table>
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama Kursus</th>
            <th>Biaya</th>
            <th>Mulai</th>
            <th>Sisa Kursi</th>
            <th>Status</th>
            <th>Aksi</th> <!-- 1. Tambahkan Header Kolom Aksi -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($courses as $course): ?>
        <?php
            $status = statusKursus($course['quota'], $course['registered']);
            $statusClass = ($status === 'Penuh') ? 'badge-full' : 'badge-available';
        ?>
        <tr>
            <td><span class="code-badge"><?= htmlspecialchars($course['code']) ?></span></td>
            <td><strong><?= htmlspecialchars(trim($course['name'])) ?></strong></td>
            <td class="fee-text"><?= rupiah($course['fee']) ?></td>
            <td><?= formatTanggal($course['start_date']) ?></td>
            <td><?= sisaKursi($course['quota'], $course['registered']) ?> Kursi</td>
            <td><span class="<?= $statusClass ?>"><?= $status ?></span></td>
            <td>
                <!-- 2. Tambahkan Link / Tombol ke registration.php -->
                <?php if ($status === 'Penuh'): ?>
                    <button class="btn-action disabled" disabled>Penuh</button>
                <?php else: ?>
                    <a href="registration.php" class="btn-action">Daftar</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Cara Mendaftar -->
       <section id="alur" class="section-steps">
    <div class="container">
        <h2 class="section-title">Cara Mendaftar</h2>
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-number">1</div>
                <h3>Pilih Kursus</h3>
                <p>Pilih kursus yang diminati dari katalog yang tersedia.</p>
            </div>
            <div class="step-card">
                <div class="step-number">2</div>
                <h3>Isi Form Pendaftaran</h3>
                <p>Lengkapi form pendaftaran dan hitung estimasi biaya.</p>
            </div>
            <div class="step-card">
                <div class="step-number">3</div>
                <h3>Konfirmasi</h3>
                <p>Kirim pendaftaran dan tunggu konfirmasi dari tim admin.</p>
            </div>
        </div>
        
        <!-- Tambahkan Tombol Buka Form Pendaftaran -->
        <div style="text-align: center; margin-top: 25px;">
            <a href="registration.php" class="btn-calculator" style="display: inline-block; padding: 12px 28px; font-size: 14px;">
                <i class="fa-solid fa-pen-to-square"></i> Buka Form Pendaftaran
            </a>
        </div>
    </div>
</section>

        <!-- Section Media Program -->
        <section id="media" class="section-media">
            <div class="container">
                <h2 class="section-title">Kenali Program Kami</h2>
                
                <div class="media-grid">
                    <div class="media-box">
                        <img src="assets/images/hero-kursus.jpeg" alt="Mahasiswa sedang mengikuti kegiatan kursus komputer" class="media-img">
                    </div>
                    <div class="media-box">
                        <h3>Video Singkat</h3>
                        <div class="video-wrapper">
                            <video controls>
                                <source src="assets/video/intro-kursus.mp4" type="video/mp4">
                                Browser Anda tidak mendukung video HTML5.
                            </video>
                        </div>
                        <p class="media-doc-link">
                            Pelajari juga <a href="https://www.php.net/" target="_blank" rel="noopener"><i class="fa-brands fa-php"></i> Dokumentasi PHP</a>.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Kontak -->
        <section id="kontak" class="section-contact">
            <div class="container">
                <div class="contact-card">
                    <h2>Hubungi Kami</h2>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fa-solid fa-envelope"></i>
                            <div>
                                <strong>Email</strong>
                                <p>muhammadagungpranoto3@gmail.com</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fa-solid fa-location-dot"></i>
                            <div>
                                <strong>Alamat</strong>
                                <p>Aia Kaciak</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
            <div class="footer-links">
                <a href="index.php">Home</a>
                <a href="#keunggulan">Keunggulan</a>
                <a href="#katalog">Katalog</a>
                <a href="#alur">Cara Daftar</a>
                <a href="fee-calculator.php">Kalkulator</a>
            </div>
            <div class="footer-socials">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                 <a href="https://instagram.com/agunng_02" target="_blank" rel="noopener">
        <i class="fa-brands fa-instagram"></i>
    </a>
    <a href="https://github.com/muhammadagungpranoto3-create" target="_blank" rel="noopener">
        <i class="fa-brands fa-github"></i>
    </a>
</div>
        </div>
    </footer>

</body>
</html>