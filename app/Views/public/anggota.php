<?= $this->extend('layout/public_template') ?>

<?= $this->section('title') ?>
Data Anggota DPR
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <h2 class="mb-4">Daftar Anggota DPR</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Jabatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($anggota as $item): ?>
                        <tr>
                            <td><?= trim(esc($item['gelar_depan']) . ' ' . esc($item['nama_depan']) . ' ' . esc($item['nama_belakang']) . ', ' . esc($item['gelar_belakang']), ' ,') ?></td>
                            <td><?= esc($item['jabatan']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>