<?= $this->extend('layout/public_template') ?>

<?= $this->section('title') ?>
Dashboard Transparansi Gaji DPR
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="px-4 py-5 my-5 text-center bg-white rounded-3 shadow-lg">
        <h1 class="display-4 fw-bold">Portal Transparansi Penghasilan DPR</h1>
        <div class="col-lg-8 mx-auto">
            <p class="lead mb-4">
                Selamat datang di portal informasi penghasilan Dewan Perwakilan Rakyat. Kami berkomitmen untuk menyajikan data yang akurat dan mudah dipahami oleh masyarakat sebagai bentuk akuntabilitas publik.
            </p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="<?= site_url('public/penggajian') ?>" class="btn btn-primary btn-lg px-4 gap-3">Lihat Rincian Gaji</a>
                <a href="<?= site_url('public/anggota') ?>" class="btn btn-outline-secondary btn-lg px-4">Lihat Daftar Anggota</a>
            </div>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title text-muted">Jumlah Anggota Terdaftar</h5>
                    <p class="card-text display-5 fw-bold text-primary"><?= esc($jumlah_anggota ?? 0) ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title text-muted">Rata-Rata Take Home Pay</h5>
                    <p class="card-text display-5 fw-bold text-success">
                        Rp <?= number_format($rata_rata_gaji ?? 0, 0, ',', '.') ?>
                    </p>
                    <small class="text-muted">/ Bulan</small>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>