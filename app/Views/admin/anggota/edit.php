<?= $this->extend('layout/admin_template') ?>

<?= $this->section('title') ?>
Ubah Komponen Gaji
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="mb-0">Formulir Ubah Komponen Gaji</h2>
        </div>
        <div class="card-body">
            
            <form action="<?= site_url('admin/komponen/update/' . $komponen['id_komponen']) ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label for="nama_komponen" class="form-label">Nama Komponen</label>
                    <input type="text" class="form-control" id="nama_komponen" name="nama_komponen" value="<?= esc($komponen['nama_komponen']) ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" value="<?= esc($komponen['kategori']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jabatan" class="form-label">Berlaku untuk Jabatan</label>
                        <select class="form-select" id="jabatan" name="jabatan" required>
                            <option value="Semua" <?= $komponen['jabatan'] == 'Semua' ? 'selected' : '' ?>>Semua Jabatan</option>
                            <option value="Ketua" <?= $komponen['jabatan'] == 'Ketua' ? 'selected' : '' ?>>Ketua</option>
                            <option value="Wakil Ketua" <?= $komponen['jabatan'] == 'Wakil Ketua' ? 'selected' : '' ?>>Wakil Ketua</option>
                            <option value="Anggota" <?= $komponen['jabatan'] == 'Anggota' ? 'selected' : '' ?>>Anggota</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nominal" class="form-label">Nominal (Rp)</label>
                        <input type="number" class="form-control" id="nominal" name="nominal" value="<?= esc($komponen['nominal']) ?>" min="0" required>
                    </div>
                     <div class="col-md-6 mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <select class="form-select" id="satuan" name="satuan" required>
                            <option value="Bulan" <?= $komponen['satuan'] == 'Bulan' ? 'selected' : '' ?>>Per Bulan</option>
                            <option value="Hari" <?= $komponen['satuan'] == 'Hari' ? 'selected' : '' ?>>Per Hari</option>
                            <option value="Sesi" <?= $komponen['satuan'] == 'Sesi' ? 'selected' : '' ?>>Per Sesi</option>
                        </select>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="<?= site_url('admin/komponen') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>