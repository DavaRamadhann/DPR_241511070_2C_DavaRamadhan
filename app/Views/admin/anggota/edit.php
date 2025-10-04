<?= $this->extend('layout/admin_template') ?>

<?= $this->section('title') ?>
Ubah Data Anggota DPR
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="mb-0">Formulir Ubah Data Anggota</h2>
        </div>
        <div class="card-body">
            
            <?php if(session()->get('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                    <?php foreach (session()->get('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('admin/anggota/update/' . $anggota['id_anggota']) ?>" method="POST">
                <?= csrf_field() ?>
                
                <p class="text-muted">Informasi Pribadi</p>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="gelar_depan" class="form-label">Gelar Depan</label>
                        <input type="text" class="form-control" id="gelar_depan" name="gelar_depan" value="<?= esc($anggota['gelar_depan']) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nama_depan" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control" id="nama_depan" name="nama_depan" value="<?= esc($anggota['nama_depan']) ?>" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="nama_belakang" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" value="<?= esc($anggota['nama_belakang']) ?>">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="gelar_belakang" class="form-label">Gelar Belakang</label>
                    <input type="text" class="form-control" id="gelar_belakang" name="gelar_belakang" value="<?= esc($anggota['gelar_belakang']) ?>">
                </div>
                
                <hr>
                <p class="text-muted">Informasi Jabatan & Keluarga</p>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <select class="form-select" id="jabatan" name="jabatan" required>
                            <option value="Ketua" <?= $anggota['jabatan'] == 'Ketua' ? 'selected' : '' ?>>Ketua</option>
                            <option value="Wakil Ketua" <?= $anggota['jabatan'] == 'Wakil Ketua' ? 'selected' : '' ?>>Wakil Ketua</option>
                            <option value="Anggota" <?= $anggota['jabatan'] == 'Anggota' ? 'selected' : '' ?>>Anggota</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                         <select class="form-select" id="status_pernikahan" name="status_pernikahan" required>
                            <option value="Kawin" <?= $anggota['status_pernikahan'] == 'Kawin' ? 'selected' : '' ?>>Kawin</option>
                            <option value="Belum Kawin" <?= $anggota['status_pernikahan'] == 'Belum Kawin' ? 'selected' : '' ?>>Belum Kawin</option>
                        </select>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="<?= site_url('admin/anggota') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>