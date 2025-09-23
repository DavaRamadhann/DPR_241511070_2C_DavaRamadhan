<?= $this->extend($template) ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="p-5 mb-4 bg-light rounded-3 shadow-sm">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Selamat Datang, <?= session()->get('username') ?>!</h1>
        <p class="col-md-8 fs-4">Anda telah berhasil login ke Sistem Akademik Sederhana sebagai <strong><?= session()->get('role') ?></strong>.</p>
    </div>
</div>
<?= $this->endSection() ?>