<?= $this->extend('layout/admin_template') ?>

<?= $this->section('title') ?>
Data Penggajian Anggota
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Data Penggajian Anggota DPR</h2>
        <a href="<?= site_url('admin/penggajian/create') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data Penggajian</a>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <form action="<?= site_url('admin/penggajian') ?>" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari berdasarkan Nama, Jabatan, atau ID..." name="keyword" value="<?= esc($keyword ?? '') ?>">
                    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i> Cari</button>
                </div>
            </form>
        </div>
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
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Anggota</th>
                            <th>Nama Lengkap</th>
                            <th>Jabatan</th>
                            <th class="text-end">Take Home Pay (Per Bulan)</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($penggajian)): ?>
                            <tr><td colspan="5" class="text-center py-4">Data tidak ditemukan.</td></tr>
                        <?php else: ?>
                            <?php foreach($penggajian as $item): ?>
                            <tr>
                                <td><?= $item['id_anggota'] ?></td>
                                <td><?= trim(esc($item['gelar_depan']) . ' ' . esc($item['nama_depan']) . ' ' . esc($item['nama_belakang']) . ', ' . esc($item['gelar_belakang']), ' ,') ?></td>
                                <td><?= esc($item['jabatan']) ?></td>
                                <td class="text-end"><strong>Rp <?= number_format($item['take_home_pay'] ?? 0, 0, ',', '.') ?></strong></td>
                                <td class="text-center">
                                    <a href="<?= site_url('admin/penggajian/detail/' . $item['id_anggota']) ?>" class="btn btn-sm btn-info" title="Lihat Detail & Ubah"><i class="fas fa-eye"></i></a>
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