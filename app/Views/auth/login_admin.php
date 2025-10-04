<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Admin Login') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 mt-5">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h4><?= esc($title ?? 'Admin Login') ?></h4>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('msg')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                    <?php endif; ?>
                    
                    <form action="<?= site_url('login/admin') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required value="admin">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required value="admin123">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                         <div class="text-center mt-3">
                            <a href="<?= site_url('/') ?>">&laquo; Kembali ke Pilihan Peran</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>