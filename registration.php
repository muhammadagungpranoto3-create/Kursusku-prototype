<?php
require_once __DIR__ . '/helpers.php';

$siteName = 'KursusKu UIN';
$year = date('Y');
$selectedCourse = $_GET['course'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Kursus - <?= htmlspecialchars($siteName) ?></title>
    
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
                <a href="index.php#keunggulan">Keunggulan</a>
                <a href="index.php#katalog">Katalog</a>
                <a href="index.php#alur">Cara Daftar</a>
                <a href="registration.php" class="active">Daftar</a>
                <a href="fee-calculator.php" class="btn-calculator"><i class="fa-solid fa-calculator"></i> Hitung Biaya</a>
            </nav>
        </div>
    </header>

    <main class="registration-section">
        <div class="container">
            <div class="form-card-wrapper">
                
                <div class="form-header">
                    <h2>Mulai Belajar Bersama <span class="logo-accent">KursusKu</span></h2>
                    <p>Gunakan data latihan. Field bertanda <span class="required">*</span> wajib diisi.</p>
                </div>

                <form action="process-registration.php" method="POST" class="registration-form">
                    
                    <!-- Row 1: Nama Lengkap & Email -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fullname">Nama Lengkap <span class="required">*</span></label>
                            <div class="input-icon-wrapper">
                                <i class="fa-solid fa-user input-icon"></i>
                                <input type="text" id="fullname" name="fullname" placeholder="Masukkan nama lengkap Anda" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span class="required">*</span></label>
                            <div class="input-icon-wrapper">
                                <i class="fa-solid fa-envelope input-icon"></i>
                                <input type="email" id="email" name="email" placeholder="contoh@domain.com" required>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Nomor HP & Program Studi -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Nomor HP <span class="required">*</span></label>
                            <div class="input-icon-wrapper">
                                <i class="fa-solid fa-phone input-icon"></i>
                                <input type="tel" id="phone" name="phone" placeholder="Contoh: 081234567890" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="study_program">Program Studi <span class="required">*</span></label>
                            <div class="input-icon-wrapper">
                                <i class="fa-solid fa-graduation-cap input-icon"></i>
                                <input type="text" id="study_program" name="study_program" maxlength="100" placeholder="Contoh: Teknik Informatika" required>
                            </div>
                        </div>
                    </div>

                    <!-- Kursus yang Dipilih -->
                    <div class="form-group">
                        <label for="course">Kursus yang Dipilih <span class="required">*</span></label>
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-book-open input-icon"></i>
                            <select id="course" name="course" required>
                                <option value="">-- Pilih kursus --</option>
                                <option value="web-dasar" <?= ($selectedCourse === 'web-dasar' || $selectedCourse === 'WEB-01') ? 'selected' : '' ?>>Web Dasar - Rp 200.000</option>
                                <option value="php-dasar" <?= ($selectedCourse === 'php-dasar' || $selectedCourse === 'PHP-01') ? 'selected' : '' ?>>PHP Dasar - Rp 250.000</option>
                                <option value="php-lanjutan" <?= ($selectedCourse === 'php-lanjutan' || $selectedCourse === 'PHP-02') ? 'selected' : '' ?>>PHP Lanjutan - Rp 350.000</option>
                                <option value="laravel-fundamental" <?= ($selectedCourse === 'laravel-fundamental' || $selectedCourse === 'LAR-01') ? 'selected' : '' ?>>Laravel Fundamental - Rp 400.000</option>
                                <option value="mysql-dasar" <?= ($selectedCourse === 'mysql-dasar' || $selectedCourse === 'DB-01') ? 'selected' : '' ?>>MySQL Dasar - Rp 200.000</option>
                                <option value="ui-web-dasar" <?= ($selectedCourse === 'ui-web-dasar' || $selectedCourse === 'UI-01') ? 'selected' : '' ?>>UI Web Dasar - Rp 250.000</option>
                            </select>
                        </div>
                    </div>

                    <!-- Jenis Peserta -->
                    <div class="form-group-box">
                        <label class="group-title">Jenis Peserta <span class="required">*</span></label>
                        <div class="radio-checkbox-group">
                            <label class="custom-option">
                                <input type="radio" name="participant_type" value="mahasiswa" required>
                                <span class="option-card">
                                    <i class="fa-solid fa-user-graduate"></i>
                                    <span>Mahasiswa (Diskon 20%)</span>
                                </span>
                            </label>
                            <label class="custom-option">
                                <input type="radio" name="participant_type" value="guru">
                                <span class="option-card">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                    <span>Guru (Diskon 15%)</span>
                                </span>
                            </label>
                            <label class="custom-option">
                                <input type="radio" name="participant_type" value="umum">
                                <span class="option-card">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <span>Umum (Diskon 0%)</span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <!-- Minat Tambahan -->
                    <div class="form-group-box">
                        <label class="group-title">Minat Tambahan</label>
                        <div class="radio-checkbox-group">
                            <label class="custom-option">
                                <input type="checkbox" name="interests[]" value="frontend">
                                <span class="option-card">
                                    <i class="fa-solid fa-code"></i>
                                    <span>Frontend</span>
                                </span>
                            </label>
                            <label class="custom-option">
                                <input type="checkbox" name="interests[]" value="backend">
                                <span class="option-card">
                                    <i class="fa-solid fa-server"></i>
                                    <span>Backend</span>
                                </span>
                            </label>
                            <label class="custom-option">
                                <input type="checkbox" name="interests[]" value="database">
                                <span class="option-card">
                                    <i class="fa-solid fa-database"></i>
                                    <span>Database</span>
                                </span>
                            </label>
                            <label class="custom-option">
                                <input type="checkbox" name="interests[]" value="uiux">
                                <span class="option-card">
                                    <i class="fa-solid fa-palette"></i>
                                    <span>UI/UX</span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <!-- Row: Metode Belajar & Jumlah Paket -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="learning_method">Metode Belajar <span class="required">*</span></label>
                            <div class="input-icon-wrapper">
                                <i class="fa-solid fa-gear input-icon"></i>
                                <select id="learning_method" name="learning_method" required>
                                    <option value="online">Online</option>
                                    <option value="offline">Offline</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="package_qty">Jumlah Paket <span class="required">*</span></label>
                            <div class="input-icon-wrapper">
                                <i class="fa-solid fa-user-gear input-icon"></i>
                                <select id="package_qty" name="package_qty" required>
                                    <option value="1">1 Paket</option>
                                    <option value="2">2 Paket</option>
                                    <option value="3">3 Paket</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div class="form-group">
                        <label for="note">Catatan</label>
                        <textarea id="note" name="note" rows="3" maxlength="300" placeholder="Tuliskan kebutuhan belajar Anda (opsional)"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit-registration">Daftar Sekarang</button>

                </form>
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