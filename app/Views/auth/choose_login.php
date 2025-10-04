<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Aplikasi Gaji DPR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html { height: 100%; }
        .container-center {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            background-color: #f4f7f6;
        }
        .card {
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-radius: 15px;
        }
        .card-title {
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="container-center">
        <div class="card text-center p-4 p-md-5" style="width: 25rem;">
            <div class="card-body">
                <h3 class="card-title mb-3">Aplikasi Gaji DPR</h3>
                <p class="text-muted mb-4">Silakan pilih peran Anda untuk melanjutkan.</p>
                <div class="d-grid gap-3">
                    <a href="<?= site_url('login/admin') ?>" class="btn btn-primary btn-lg">Login sebagai Admin</a>
                    <a href="<?= site_url('public') ?>" class="btn btn-success btn-lg">Masuk sebagai Publik</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>