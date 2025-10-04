<?= $this->extend('layout/admin_template') ?>

<?= $this->section('title') ?>
Tambah Komponen Gaji
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="mb-0">Formulir Tambah Komponen Gaji Baru</h2>
        </div>
        <div class="card-body">
            
            <?php if(session()->get('errors')): ?>
                <div class="alert alert-danger" role="alert">
                    <p><strong>Mohon periksa isian Anda:</strong></p>
                    <ul>
                    <?php foreach (session()->get('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('admin/komponen/store') ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label for="nama_komponen" class="form-label">Nama Komponen</label>
                    <input type="text" class="form-control" id="nama_komponen" name="nama_komponen" value="<?= old('nama_komponen') ?>" required>
                    <div class="form-text">Contoh: Gaji Pokok, Tunjangan Jabatan, Uang Sidang.</div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" value="<?= old('kategori') ?>" required>
                        <div class="form-text">Contoh: Gaji Pokok, Tunjangan Keluarga, Tunjangan Jabatan.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jabatan" class="form-label">Berlaku untuk Jabatan</label>
                        <select class="form-select" id="jabatan" name="jabatan" required>
                            <option value="Semua" <?= old('jabatan') == 'Semua' ? 'selected' : '' ?>>Semua Jabatan</option>
                            <option value="Ketua" <?= old('jabatan') == 'Ketua' ? 'selected' : '' ?>>Ketua</option>
                            <option value="Wakil Ketua" <?= old('jabatan') == 'Wakil Ketua' ? 'selected' : '' ?>>Wakil Ketua</option>
                            <option value="Anggota" <?= old('jabatan') == 'Anggota' ? 'selected' : '' ?>>Anggota</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nominal" class="form-label">Nominal (Rp)</label>
                        <input type="number" class="form-control" id="nominal" name="nominal" value="<?= old('nominal') ?>" min="0" required>
                    </div>
                     <div class="col-md-6 mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <select class="form-select" id="satuan" name="satuan" required>
                            <option value="Bulan" <?= old('satuan') == 'Bulan' ? 'selected' : '' ?>>Per Bulan</option>
                            <option value="Hari" <?= old('satuan') == 'Hari' ? 'selected' : '' ?>>Per Hari</option>
                            <option value="Sesi" <?= old('satuan') == 'Sesi' ? 'selected' : '' ?>>Per Sesi</option>
                        </select>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan Komponen</button>
                    <a href="#" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>