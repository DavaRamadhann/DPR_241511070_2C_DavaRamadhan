<?= $this->extend('layout/admin_template') ?>

<?= $this->section('title') ?>
Data Penggajian Anggota
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Penggajian Anggota DPR</h2>
        <a href="<?= site_url('admin/penggajian/create') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data Penggajian</a>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Anggota</th>
                            <th>Nama Lengkap</th>
                            <th>Jabatan</th>
                            <th>Take Home Pay (Per Bulan)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($penggajian)): ?>
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data penggajian.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($penggajian as $item): ?>
                            <tr>
                                <td><?= $item['id_anggota'] ?></td>
                                <td><?= trim(esc($item['gelar_depan']) . ' ' . esc($item['nama_depan']) . ' ' . esc($item['nama_belakang']) . ', ' . esc($item['gelar_belakang']), ' ,') ?></td>
                                <td><?= esc($item['jabatan']) ?></td>
                                <td><strong>Rp <?= number_format($item['total_gaji'] ?? 0, 0, ',', '.') ?></strong></td>
                                <td>
                                    <a href="<?= site_url('admin/penggajian/detail/' . $item['id_anggota']) ?>" class="btn btn-sm btn-info" title="Lihat Detail"><i class="fas fa-eye"></i> Detail</a>

                                    <form action="<?= site_url('admin/penggajian/delete/' . $item['id_anggota']) ?>" method="POST" class="d-inline" onsubmit="return confirm('PERHATIAN: Aksi ini akan menghapus SEMUA komponen gaji untuk anggota ini. Lanjutkan?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger" title="Reset Gaji"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>