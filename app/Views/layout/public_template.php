<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title', 'Transparansi Gaji DPR') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style untuk menu yang aktif */
        .nav-link.active {
            font-weight: bold;
            color: #000 !important;
            border-bottom: 2px solid #0d6efd;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('public') ?>"><b>Gaji DPR</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                 <li class="nav-item">
                    <a class="nav-link <?= is_active('') ?>" href="<?= site_url('public') ?>">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= is_active('anggota') ?>" href="<?= site_url('public/anggota') ?>">Data Anggota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= is_active('penggajian') ?>" href="<?= site_url('public/penggajian') ?>">Data Penggajian</a>
                </li>
            </ul>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-primary">Halaman Awal</a>
        </div>
    </div>
</nav>

<main class="container mt-4">
    <?= $this->renderSection('content') ?>
</main>

<footer class="text-center mt-5 py-3">
    <p class="text-muted">&copy; <?= date('Y') ?> Aplikasi Penghitungan Gaji DPR</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>