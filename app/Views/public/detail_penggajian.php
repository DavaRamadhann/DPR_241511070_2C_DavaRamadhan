<?= $this->extend('layout/public_template') ?>

<?= $this->section('title') ?>
Detail Gaji: <?= esc($anggota['nama_depan']) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Detail Gaji: <?= esc($anggota['nama_depan'] . ' ' . $anggota['nama_belakang']) ?></h2>
            <a href="<?= site_url('public/penggajian') ?>" class="btn btn-secondary btn-sm"> &laquo; Kembali ke Daftar</a>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Jabatan:</strong> <?= esc($anggota['jabatan']) ?></p>
                    <p><strong>Status Pernikahan:</strong> <?= esc($anggota['status_pernikahan']) ?></p>
                </div>
            </div>

            <h4>Rincian Penghasilan (Per Bulan)</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Komponen</th>
                            <th class="text-end">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($komponen_diterima as $komponen): ?>
                        <tr>
                            <td><?= esc($komponen['nama_komponen']) ?></td>
                            <td class="text-end">Rp <?= number_format($komponen['nominal'], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="table-group-divider">
                            <td colspan="2"><strong>Tunjangan Keluarga</strong></td>
                        </tr>
                        <tr>
                            <td><?= esc($tunjangan_pasangan['nama']) ?></td>
                            <td class="text-end">Rp <?= number_format($tunjangan_pasangan['nominal'], 0, ',', '.') ?></td>
                        </tr>
                    </tbody>
                    <tfoot class="table-group-divider">
                        <tr>
                            <th class="text-end">Total Take Home Pay</th>
                            <th class="text-end fs-5">Rp <?= number_format($take_home_pay, 0, ',', '.') ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>