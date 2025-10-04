<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title', 'Admin - Gaji DPR') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .card .border-left-primary { border-left: .25rem solid #4e73df!important; }
        .card .border-left-success { border-left: .25rem solid #1cc88a!important; }
        .text-xs { font-size: .8rem; }
        /* Style untuk menu yang aktif */
        .nav-link.active {
            font-weight: bold;
            color: #fff !important;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('admin/dashboard') ?>"><b>ADMIN PANEL</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?= is_active('dashboard') ?>" href="<?= site_url('admin/dashboard') ?>">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= is_active('anggota') ?>" href="<?= site_url('admin/anggota') ?>">Anggota DPR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= is_active('komponen') ?>" href="<?= site_url('admin/komponen') ?>">Komponen Gaji</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= is_active('penggajian') ?>" href="<?= site_url('admin/penggajian') ?>">Penggajian</a>
                </li>
            </ul>
            <span class="navbar-text text-white me-3">
                Halo, <strong><?= session()->get('username') ?></strong>!
            </span>
            <a href="<?= site_url('logout') ?>" class="btn btn-danger btn-sm">Logout</a>
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