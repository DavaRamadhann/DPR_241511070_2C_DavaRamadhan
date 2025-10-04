<?= $this->extend('layout/admin_template') ?>
<?= $this->section('title') ?>
Detail & Ubah Penggajian
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            </div>
        <div class="card-body">
            <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <h4>Rincian Penghasilan (Per Bulan)</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <?php if(empty($komponen_diterima)): ?>
                            <tr><td colspan="3" class="text-center">Belum ada komponen Gaji Pokok / Jabatan yang ditambahkan.</td></tr>
                        <?php endif; ?>
                        
                        <?php foreach($komponen_diterima as $komponen): ?>
                        <tr>
                            <td><?= esc($komponen['nama_komponen']) ?></td>
                            <td class="text-end">Rp <?= number_format($komponen['nominal'], 0, ',', '.') ?></td>
                            <td class="text-center">
                                <form action="<?= site_url('admin/penggajian/delete-komponen/' . $komponen['id']) ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus komponen ini dari gaji anggota?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus Komponen"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
            </div>
            <div class="mt-3">
                <a href="<?= site_url('admin/penggajian/create?id_anggota='.$anggota['id_anggota']) ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Komponen Lain</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>