<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title', 'Sistem Akademik') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f8f9fa; 
        }
        .navbar { 
            box-shadow: 0 2px 4px rgba(0,0,0,.1); 
        }
        /* Style untuk menu yang aktif */
        .nav-link.active { 
            font-weight: bold; 
            color: #fff !important;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('dashboard') ?>"><b>SIAKAD</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?= is_active('courses') ?>" href="<?= site_url('mahasiswa/courses') ?>">Ambil Mata Kuliah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= is_active('my-courses') ?>" href="<?= site_url('mahasiswa/my-courses') ?>">Mata Kuliah Saya</a>
                </li>
            </ul>
            <div class="d-flex">
                 <span class="navbar-text text-white me-3">
                    Halo, <b><?= session()->get('username') ?>!</b>
                </span>
                <a href="<?= site_url('logout') ?>" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</nav>

<main class="container mt-4">
    <?= $this->renderSection('content') ?>
</main>

<footer class="text-center mt-5 py-3 bg-light">
    <p>&copy; <?= date('Y') ?> Sistem Akademik Sederhana. Dibuat dengan CodeIgniter 4 & JavaScript.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?= $this->renderSection('scripts') ?>
</body>
</html>