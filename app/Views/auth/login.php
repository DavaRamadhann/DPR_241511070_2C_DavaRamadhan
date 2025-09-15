<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistem Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            background-color: #f0f2f5;
        }
        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="card shadow-lg border-0 login-card">
        <div class="card-body">
            <h3 class="card-title text-center mb-4"><b>SIAKAD</b> | Login</h3>
            
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>