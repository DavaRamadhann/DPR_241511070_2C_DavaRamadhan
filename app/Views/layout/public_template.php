<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title', 'Transparansi Gaji DPR') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5; /* Warna latar belakang lebih lembut */
        }
        .navbar {
            border-bottom: 1px solid #ddd;
        }
        .nav-link.active {
            font-weight: bold;
            color: #0d6efd !important;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= site_url('public') ?>">TRANSPARANSI DPR</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= is_active('') ? 'active' : '' ?>" href="<?= site_url('public') ?>">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= is_active('anggota') ? 'active' : '' ?>" href="<?= site_url('public/anggota') ?>">Data Anggota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= is_active('penggajian') ? 'active' : '' ?>" href="<?= site_url('public/penggajian') ?>">Data Penggajian</a>
                </li>
            </ul>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-primary">Kembali</a>
        </div>
    </div>
</nav>

<main class="mt-4">
    <?= $this->renderSection('content') ?>
</main>

<footer class="text-center mt-5 py-4 bg-white border-top">
    <p class="mb-0 text-muted">&copy; <?= date('Y') ?> Aplikasi Penghitungan Gaji DPR. Dibuat untuk Transparansi.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>