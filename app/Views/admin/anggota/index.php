<?= $this->extend('layout/admin_template') ?>

<?= $this->section('title') ?>
Kelola Anggota DPR
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Anggota DPR</h2>
        <a href="<?= site_url('admin/anggota/create') ?>" class="btn btn-primary">Tambah Anggota</a>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($anggota as $item): ?>
                <tr>
                    <td><?= $item['id_anggota'] ?></td>
                    <td><?= trim(esc($item['gelar_depan']) . ' ' . esc($item['nama_depan']) . ' ' . esc($item['nama_belakang']) . ', ' . esc($item['gelar_belakang']), ' ,') ?></td>
                    <td><?= esc($item['jabatan']) ?></td>
                    <td><?= esc($item['status_pernikahan']) ?></td>
                    <td>
                        <a href="<?= site_url('admin/anggota/edit/' . $item['id_anggota']) ?>" class="btn btn-sm btn-warning">Ubah</a>
                        <form action="<?= site_url('admin/anggota/delete/' . $item['id_anggota']) ?>" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>