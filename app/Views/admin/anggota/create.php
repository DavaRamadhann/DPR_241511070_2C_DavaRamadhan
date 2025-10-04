<?= $this->extend('layout/admin_template') ?>

<?= $this->section('title') ?>
Tambah Anggota DPR
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="mb-0">Formulir Tambah Anggota Baru</h2>
        </div>
        <div class="card-body">
            
            <?php if(session()->get('errors')): ?>
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Terjadi Kesalahan!</h4>
                    <hr>
                    <p class="mb-0">Mohon periksa kembali data yang Anda masukkan:</p>
                    <ul>
                    <?php foreach (session()->get('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('admin/anggota/store') ?>" method="POST">
                <?= csrf_field() ?>
                
                <p class="text-muted">Informasi Pribadi</p>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="gelar_depan" class="form-label">Gelar Depan</label>
                        <input type="text" class="form-control" id="gelar_depan" name="gelar_depan" value="<?= old('gelar_depan') ?>" placeholder="Contoh: Dr.">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nama_depan" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control" id="nama_depan" name="nama_depan" value="<?= old('nama_depan') ?>" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="nama_belakang" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" value="<?= old('nama_belakang') ?>">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="gelar_belakang" class="form-label">Gelar Belakang</label>
                    <input type="text" class="form-control" id="gelar_belakang" name="gelar_belakang" value="<?= old('gelar_belakang') ?>" placeholder="Contoh: S.H., M.Kom.">
                </div>
                
                <hr>
                <p class="text-muted">Informasi Jabatan & Keluarga</p>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <select class="form-select" id="jabatan" name="jabatan" required>
                            <option value="" disabled selected>--- Pilih Jabatan ---</option>
                            <option value="Ketua" <?= old('jabatan') == 'Ketua' ? 'selected' : '' ?>>Ketua</option>
                            <option value="Wakil Ketua" <?= old('jabatan') == 'Wakil Ketua' ? 'selected' : '' ?>>Wakil Ketua</option>
                            <option value="Anggota" <?= old('jabatan') == 'Anggota' ? 'selected' : '' ?>>Anggota</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                         <select class="form-select" id="status_pernikahan" name="status_pernikahan" required>
                            <option value="Kawin" <?= old('status_pernikahan') == 'Kawin' ? 'selected' : '' ?>>Kawin</option>
                            <option value="Belum Kawin" <?= old('status_pernikahan') == 'Belum Kawin' ? 'selected' : '' ?>>Belum Kawin</option>
                        </select>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                    <a href="<?= site_url('admin/anggota') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>