<?php
// test-matrix.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Muat file pendukung hanya jika memang ada di folder ini
foreach (['data.php', 'helpers.php', 'functions.php'] as $file) {
    if (file_exists(__DIR__ . '/' . $file)) {
        require_once __DIR__ . '/' . $file;
    }
}

// Data cadangan jika $courses belum didefinisikan oleh file mana pun
if (!isset($courses) || !is_array($courses) || empty($courses)) {
    $courses = [
        ['code' => 'WEB-01', 'name' => 'Web Dasar',           'fee' => 200000],
        ['code' => 'PHP-01', 'name' => 'PHP Dasar',           'fee' => 250000],
        ['code' => 'PHP-02', 'name' => 'PHP Lanjutan',        'fee' => 300000],
        ['code' => 'LAR-01', 'name' => 'Laravel Fundamental', 'fee' => 350000],
    ];
}

/*
 * Jaring pengaman: hanya dibuat jika fungsi belum didefinisikan
 * di helpers.php / functions.php, sehingga tidak bentrok.
 */
if (!function_exists('findCourse')) {
    function findCourse(array $courses, string $code): ?array
    {
        foreach ($courses as $c) {
            if (($c['code'] ?? '') === $code) {
                return $c;
            }
        }
        return null;
    }
}

if (!function_exists('getDiscountPercent')) {
    function getDiscountPercent(string $type): int
    {
        switch ($type) {
            case 'mahasiswa':
                return 20;
            case 'guru':
                return 15;
            default:
                return 0;
        }
    }
}

if (!function_exists('rupiah')) {
    function rupiah($amount): string
    {
        return 'Rp ' . number_format((float)$amount, 0, ',', '.');
    }
}

$siteName = 'KursusKu-prototype';
$year = date('Y');

$coursesList = isset($courses) ? $courses : [];

$testCases = [
    [
        'no' => 1,
        'skenario' => 'Mahasiswa, Web Dasar, 1 paket',
        'type' => 'mahasiswa',
        'code' => 'WEB-01',
        'packages' => 1,
        'expected' => 160000
    ],
    [
        'no' => 2,
        'skenario' => 'Guru, PHP Dasar, 1 paket',
        'type' => 'guru',
        'code' => 'PHP-01',
        'packages' => 1,
        'expected' => 212500
    ],
    [
        'no' => 3,
        'skenario' => 'Umum, Laravel Fundamental, 1 paket',
        'type' => 'umum',
        'code' => 'LAR-01',
        'packages' => 1,
        'expected' => 350000
    ],
    [
        'no' => 4,
        'skenario' => 'Mahasiswa, Web Dasar, 2 paket',
        'type' => 'mahasiswa',
        'code' => 'WEB-01',
        'packages' => 2,
        'expected' => 320000
    ],
    [
        'no' => 5,
        'skenario' => 'Guru, PHP Lanjutan, 3 paket',
        'type' => 'guru',
        'code' => 'PHP-02',
        'packages' => 3,
        'expected' => 765000
    ],
];

// Hitung semua hasil pengujian
$results = [];
$passedCount = 0;

foreach ($testCases as $test) {
    $course = findCourse($coursesList, $test['code']);
    $fee = $course ? (float)$course['fee'] : 0;
    $subtotal = $fee * $test['packages'];

    $discountPercent = getDiscountPercent($test['type']);
    $discountAmount = ($subtotal * $discountPercent) / 100;
    $actualTotal = $subtotal - $discountAmount;

    $isPassed = round((float)$actualTotal, 2) === round((float)$test['expected'], 2);
    if ($isPassed) {
        $passedCount++;
    }

    $results[] = [
        'no'       => $test['no'],
        'skenario' => $test['skenario'],
        'discount' => $discountPercent,
        'actual'   => $actualTotal,
        'expected' => $test['expected'],
        'diff'     => $actualTotal - $test['expected'],
        'passed'   => $isPassed,
    ];
}

$totalCount  = count($results);
$failedCount = $totalCount - $passedCount;
$percent     = $totalCount > 0 ? (int)round($passedCount / $totalCount * 100) : 0;
$allPassed   = ($failedCount === 0);
?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Test Matrix - <?= htmlspecialchars($siteName) ?></title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>
    @property --pct {
      syntax: '<number>';
      inherits: false;
      initial-value: 0;
    }

    :root {
      --navy: #1f2a44;
      --teal: #2c6577;
      --teal-soft: #d9eeee;
      --orange: #e8873a;
      --orange-dark: #cf7226;
      --muted: #6b7686;
      --line: #e1e7ea;
      --pass: #1c8560;
      --pass-bg: #d8f2e5;
      --fail: #c13b2b;
      --fail-bg: #fbe0da;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Poppins', system-ui, sans-serif;
      color: var(--navy);
      line-height: 1.6;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background: linear-gradient(165deg, #f5f2e9 0%, #e4f2ef 55%, #d3eaea 100%) fixed;
    }

    a { color: inherit; text-decoration: none; }

    :focus-visible {
      outline: 3px solid var(--orange);
      outline-offset: 3px;
      border-radius: 8px;
    }

    /* ---------- Navbar ---------- */
    .tm-nav {
      position: sticky;
      top: 0;
      z-index: 10;
      background: rgba(255, 255, 255, .86);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid var(--line);
    }

    .tm-nav-inner {
      max-width: 1120px;
      margin: 0 auto;
      padding: .75rem 1.25rem;
      display: flex;
      align-items: center;
      gap: 1.5rem;
    }

    .tm-logo {
      font-weight: 700;
      font-size: 1.3rem;
      white-space: nowrap;
      display: flex;
      align-items: center;
      gap: .4rem;
    }
    .tm-logo .accent { color: var(--orange); }
    .tm-logo .badge {
      background: var(--navy);
      color: #fff;
      font-size: .7rem;
      font-weight: 600;
      padding: .15rem .5rem;
      border-radius: 6px;
    }

    .tm-menu {
      display: flex;
      align-items: center;
      gap: 1.25rem;
      margin-left: auto;
      overflow-x: auto;
      scrollbar-width: none;
    }
    .tm-menu::-webkit-scrollbar { display: none; }

    .tm-menu a {
      font-size: .9rem;
      font-weight: 500;
      white-space: nowrap;
      padding: .35rem 0;
      border-bottom: 2px solid transparent;
      transition: color .2s, border-color .2s;
    }
    .tm-menu a:hover { color: var(--teal); }
    .tm-menu a.active {
      color: var(--orange-dark);
      border-bottom-color: var(--orange);
    }
    .tm-menu a.cta {
      background: var(--navy);
      color: #fff;
      padding: .5rem 1rem;
      border-radius: 999px;
      border-bottom: 0;
    }
    .tm-menu a.cta:hover { background: var(--teal); color: #fff; }

    /* ---------- Layout ---------- */
    .tm-main {
      width: 100%;
      max-width: 1120px;
      margin: 0 auto;
      padding: 2.5rem 1.25rem 3rem;
      flex: 1;
    }

    .tm-intro { margin-bottom: 1.75rem; max-width: 640px; }

    .tm-pill {
      display: inline-block;
      background: var(--teal-soft);
      color: var(--teal);
      font-size: .8rem;
      font-weight: 600;
      padding: .25rem .8rem;
      border-radius: 999px;
      margin-bottom: .75rem;
    }

    .tm-intro h1 {
      font-size: clamp(1.8rem, 4.5vw, 2.6rem);
      font-weight: 700;
      line-height: 1.2;
      margin-bottom: .5rem;
    }

    .tm-intro p { color: var(--muted); }

    /* ---------- Ringkasan ---------- */
    .tm-summary {
      display: flex;
      align-items: center;
      gap: 1.75rem;
      background: #fff;
      border: 1px solid var(--line);
      border-radius: 20px;
      padding: 1.5rem 1.75rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 10px 30px rgba(31, 42, 68, .06);
    }

    .tm-ring {
      --ring: var(--pass);
      flex: none;
      width: 120px;
      height: 120px;
      border-radius: 50%;
      display: grid;
      place-items: center;
      position: relative;
      background: conic-gradient(var(--ring) calc(var(--pct) * 1%), #e6ecee 0);
      animation: fill 1.1s ease-out;
    }
    .tm-ring.has-fail { --ring: var(--orange); }
    .tm-ring::before {
      content: '';
      position: absolute;
      inset: 11px;
      background: #fff;
      border-radius: 50%;
    }
    .tm-ring span {
      position: relative;
      font-size: 1.5rem;
      font-weight: 700;
    }

    @keyframes fill { from { --pct: 0; } }

    .tm-summary h2 { font-size: 1.3rem; font-weight: 600; margin-bottom: .2rem; }
    .tm-summary p { color: var(--muted); font-size: .95rem; }

    .tm-stats { display: flex; gap: .6rem; margin-top: .9rem; flex-wrap: wrap; }
    .tm-chip {
      font-size: .85rem;
      font-weight: 600;
      padding: .3rem .85rem;
      border-radius: 999px;
    }
    .tm-chip.ok { background: var(--pass-bg); color: var(--pass); }
    .tm-chip.bad { background: var(--fail-bg); color: var(--fail); }
    .tm-chip.all { background: #eef2f4; color: var(--navy); }

    /* ---------- Tabel ---------- */
    .tm-table-wrap {
      background: #fff;
      border: 1px solid var(--line);
      border-radius: 20px;
      padding: .75rem 1.25rem 1rem;
      box-shadow: 0 10px 30px rgba(31, 42, 68, .06);
    }

    .tm-table { width: 100%; border-collapse: collapse; }

    .tm-table th {
      text-align: left;
      font-size: .8rem;
      font-weight: 600;
      color: var(--muted);
      padding: .9rem .75rem;
      border-bottom: 2px solid var(--line);
    }

    .tm-table td {
      padding: 1rem .75rem;
      border-bottom: 1px solid var(--line);
      vertical-align: middle;
    }
    .tm-table tbody tr:last-child td { border-bottom: 0; }
    .tm-table tbody tr:hover { background: #f7fafa; }
    .tm-table tr.is-fail { background: #fff6f4; }
    .tm-table tr.is-fail:hover { background: #fff0ec; }

    .col-no { width: 56px; color: var(--muted); font-weight: 600; }
    .col-num { text-align: right; font-variant-numeric: tabular-nums; white-space: nowrap; }
    .tm-table th.col-num { text-align: right; }
    .col-status { text-align: center; }
    .tm-table th.col-status { text-align: center; }

    .tm-skenario { font-weight: 500; }

    .tm-disc {
      display: inline-block;
      font-size: .8rem;
      font-weight: 600;
      padding: .15rem .6rem;
      border-radius: 6px;
      background: #fdeedd;
      color: var(--orange-dark);
    }
    .tm-disc.none { background: #eef2f4; color: var(--muted); }

    .tm-diff { display: block; font-size: .75rem; color: var(--fail); font-weight: 500; }

    .tm-status {
      display: inline-flex;
      align-items: center;
      gap: .4rem;
      font-size: .8rem;
      font-weight: 700;
      padding: .3rem .8rem;
      border-radius: 999px;
    }
    .tm-status.pass { background: var(--pass-bg); color: var(--pass); }
    .tm-status.fail { background: var(--fail-bg); color: var(--fail); }

    /* ---------- Tombol ---------- */
    .tm-actions { margin-top: 1.75rem; display: flex; gap: .85rem; flex-wrap: wrap; }

    .tm-btn {
      display: inline-flex;
      align-items: center;
      gap: .55rem;
      font-weight: 600;
      font-size: .95rem;
      padding: .8rem 1.4rem;
      border-radius: 14px;
      transition: transform .15s, background .2s, color .2s;
    }
    .tm-btn:hover { transform: translateY(-2px); }
    .tm-btn.primary { background: var(--orange); color: #fff; }
    .tm-btn.primary:hover { background: var(--orange-dark); }
    .tm-btn.ghost { border: 2px solid var(--teal); color: var(--teal); }
    .tm-btn.ghost:hover { background: var(--teal); color: #fff; }

    /* ---------- Footer ---------- */
    .tm-footer {
      text-align: center;
      padding: 1.25rem;
      color: var(--muted);
      font-size: .85rem;
      border-top: 1px solid var(--line);
      background: rgba(255, 255, 255, .6);
    }

    /* ---------- Responsif ---------- */
    @media (max-width: 760px) {
      .tm-nav-inner { flex-direction: column; align-items: flex-start; gap: .5rem; }
      .tm-menu { margin-left: 0; width: 100%; }

      .tm-summary { flex-direction: column; text-align: center; padding: 1.5rem 1.25rem; }
      .tm-stats { justify-content: center; }

      .tm-table-wrap { padding: .5rem; background: transparent; border: 0; box-shadow: none; }
      .tm-table thead { display: none; }
      .tm-table, .tm-table tbody, .tm-table tr, .tm-table td { display: block; width: 100%; }

      .tm-table tr {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: .6rem 1rem;
        margin-bottom: .85rem;
      }
      .tm-table tr.is-fail { background: #fff6f4; border-color: #f2c4bb; }

      .tm-table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        padding: .5rem 0;
        border-bottom: 1px dashed var(--line);
        text-align: right;
      }
      .tm-table td:last-child { border-bottom: 0; }
      .tm-table td::before {
        content: attr(data-label);
        font-size: .8rem;
        font-weight: 600;
        color: var(--muted);
        text-align: left;
      }
      .col-no { width: 100%; }
      .tm-table td.col-status { text-align: right; }
    }

    @media (prefers-reduced-motion: reduce) {
      .tm-ring { animation: none; }
      .tm-btn { transition: none; }
      .tm-btn:hover { transform: none; }
    }
  </style>
</head>

<body>
  <header class="tm-nav">
    <div class="tm-nav-inner">
      <a href="index.php" class="tm-logo" aria-label="Beranda <?= htmlspecialchars($siteName) ?>">
        <span><span class="accent">Kursus</span>Ku</span>
        <span class="badge">UIN</span>
      </a>
      <nav class="tm-menu" aria-label="Navigasi utama">
        <a href="index.php#keunggulan">Keunggulan</a>
        <a href="index.php#katalog">Katalog</a>
        <a href="registration.php">Daftar Kursus</a>
        <a href="history.php">History</a>
        <a href="loop-lab.php">Loop Lab</a>
        <a href="test-matrix.php" class="active" aria-current="page">Test Matrix</a>
        <a href="index.php#kontak">Kontak</a>
        <a href="fee-calculator.php" class="cta"><i class="fa-solid fa-calculator"></i> Estimasi Biaya</a>
      </nav>
    </div>
  </header>

  <main class="tm-main">
    <section class="tm-intro">
      <span class="tm-pill">Milestone 6</span>
      <h1>Matriks Pengujian Sistem</h1>
      <p>Pengujian otomatis fungsi perhitungan biaya dan diskon pada <?= htmlspecialchars($siteName) ?>.</p>
    </section>

    <section class="tm-summary" aria-label="Ringkasan hasil pengujian">
      <div class="tm-ring <?= $allPassed ? '' : 'has-fail' ?>" style="--pct: <?= $percent ?>;" role="img" aria-label="<?= $percent ?> persen tes lulus">
        <span><?= $percent ?>%</span>
      </div>
      <div>
        <h2><?= $allPassed ? 'Semua tes lulus' : $failedCount . ' tes gagal, periksa perhitungan diskon' ?></h2>
        <p><?= $passedCount ?> dari <?= $totalCount ?> skenario menghasilkan total yang sesuai dengan nilai harapan.</p>
        <div class="tm-stats">
          <span class="tm-chip all"><?= $totalCount ?> skenario</span>
          <span class="tm-chip ok"><i class="fa-solid fa-check"></i> <?= $passedCount ?> lulus</span>
          <?php if ($failedCount > 0): ?>
            <span class="tm-chip bad"><i class="fa-solid fa-xmark"></i> <?= $failedCount ?> gagal</span>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <section class="tm-table-wrap">
      <table class="tm-table">
        <thead>
          <tr>
            <th class="col-no">No</th>
            <th>Skenario</th>
            <th>Diskon</th>
            <th class="col-num">Actual</th>
            <th class="col-num">Expected</th>
            <th class="col-status">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($results as $r): ?>
            <tr class="<?= $r['passed'] ? '' : 'is-fail' ?>">
              <td class="col-no" data-label="No"><?= $r['no'] ?></td>
              <td class="tm-skenario" data-label="Skenario"><?= htmlspecialchars($r['skenario']) ?></td>
              <td data-label="Diskon">
                <span class="tm-disc <?= $r['discount'] > 0 ? '' : 'none' ?>">
                  <?= $r['discount'] > 0 ? $r['discount'] . '%' : 'Tanpa diskon' ?>
                </span>
              </td>
              <td class="col-num" data-label="Actual">
                <?= rupiah($r['actual']) ?>
                <?php if (!$r['passed']): ?>
                  <span class="tm-diff">selisih <?= ($r['diff'] > 0 ? '+' : '-') . rupiah(abs($r['diff'])) ?></span>
                <?php endif; ?>
              </td>
              <td class="col-num" data-label="Expected"><?= rupiah($r['expected']) ?></td>
              <td class="col-status" data-label="Status">
                <span class="tm-status <?= $r['passed'] ? 'pass' : 'fail' ?>">
                  <i class="fa-solid <?= $r['passed'] ? 'fa-circle-check' : 'fa-circle-xmark' ?>"></i>
                  <?= $r['passed'] ? 'PASS' : 'FAIL' ?>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>

    <div class="tm-actions">
      <a href="registration.php" class="tm-btn primary"><i class="fa-solid fa-pen-to-square"></i> Ke Form Pendaftaran</a>
      <a href="index.php" class="tm-btn ghost"><i class="fa-solid fa-house"></i> Kembali ke Beranda</a>
    </div>
  </main>

  <footer class="tm-footer">
    <small>&copy; <?= $year ?> <?= htmlspecialchars($siteName) ?></small>
  </footer>
</body>

</html>