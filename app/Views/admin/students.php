<?= $this->extend('layout/template') ?>

<?= $this->section('title') ?>
Kelola Mahasiswa
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Tambah Mahasiswa Baru</h4>
            </div>
            <div class="card-body">
                <form action="<?= site_url('admin/students/create') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="entry_year" class="form-label">Tahun Angkatan</label>
                        <input type="number" class="form-control" id="entry_year" name="entry_year" min="2000" max="<?= date('Y') ?>" value="<?= date('Y') ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Daftar Mahasiswa</h4>
            </div>
            <div class="card-body">
                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>
                
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Tahun Angkatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($students as $student): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($student['full_name']) ?></td>
                            <td><?= esc($student['username']) ?></td>
                            <td><?= esc($student['entry_year']) ?></td>
                            <td>
                                <form action="<?= site_url('admin/students/delete/' . $student['user_id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>