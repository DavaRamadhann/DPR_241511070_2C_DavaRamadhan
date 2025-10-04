<?= $this->extend('layout/public_template') ?>

<?= $this->section('title') ?>
Data Penggajian DPR
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <h2 class="mb-4">Data Penggajian Anggota DPR</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Jabatan</th>
                            <th class="text-end">Take Home Pay (Per Bulan)</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($penggajian as $item): ?>
                        <tr>
                            <td><?= trim(esc($item['gelar_depan']) . ' ' . esc($item['nama_depan']) . ' ' . esc($item['nama_belakang']) . ', ' . esc($item['gelar_belakang']), ' ,') ?></td>
                            <td><?= esc($item['jabatan']) ?></td>
                            <td class="text-end"><strong>Rp <?= number_format($item['total_gaji'] ?? 0, 0, ',', '.') ?></strong></td>
                            <td class="text-center">
                                <a href="<?= site_url('public/penggajian/detail/' . $item['id_anggota']) ?>" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>