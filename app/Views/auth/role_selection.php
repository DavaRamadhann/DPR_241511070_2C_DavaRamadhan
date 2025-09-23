<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pilih Peran - Sistem Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            background-color: #f0f2f5;
        }
        .container-center {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }
        .card {
            width: 100%;
            max-width: 500px;
        }
        .card-body {
            padding: 3rem;
        }
        .btn-lg {
            padding: 0.8rem 1.5rem;
            font-size: 1.25rem;
        }
    </style>
</head>
<body>

<div class="container-center">
    <div class="card shadow-lg border-0 text-center">
        <div class="card-body">
            <h3 class="card-title mb-4"><b>Selamat Datang di SIAKAD</b></h3>
            <p class="text-muted mb-4">Silakan pilih peran Anda untuk melanjutkan</p>
            <div class="d-grid gap-3">
                <a href="<?= site_url('login/admin') ?>" class="btn btn-primary btn-lg">Login sebagai Admin</a>
                <a href="<?= site_url('login/mahasiswa') ?>" class="btn btn-success btn-lg">Login sebagai Mahasiswa</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>