<?= $this->extend('layout/admin_template') ?>

<?= $this->section('title') ?>
Kelola Komponen Gaji
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Komponen Gaji & Tunjangan</h2>
        <a href="<?= site_url('admin/komponen/create') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Komponen</a>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Komponen</th>
                            <th>Kategori</th>
                            <th>Jabatan</th>
                            <th>Nominal</th>
                            <th>Satuan</th>
                            <th>Aksi</th> </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($komponen)): ?>
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data komponen gaji.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($komponen as $item): ?>
                            <tr>
                                <td><?= $item['id_komponen'] ?></td>
                                <td><?= esc($item['nama_komponen']) ?></td>
                                <td><?= esc($item['kategori']) ?></td>
                                <td><?= esc($item['jabatan']) ?></td>
                                <td>Rp <?= number_format($item['nominal'], 0, ',', '.') ?></td>
                                <td>Per <?= esc($item['satuan']) ?></td>
                                <td>
                                    <a href="<?= site_url('admin/komponen/edit/' . $item['id_komponen']) ?>" class="btn btn-sm btn-warning" title="Ubah"><i class="fas fa-edit"></i></a>

                                    <form action="<?= site_url('admin/komponen/delete/' . $item['id_komponen']) ?>" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus komponen ini?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>
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