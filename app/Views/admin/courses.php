<?= $this->extend('layout/template') ?>

<?= $this->section('title') ?>
Kelola Mata Kuliah
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Tambah Mata Kuliah</h4>
            </div>
            <div class="card-body">
                <form action="<?= site_url('admin/courses/create') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="course_name" class="form-label">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" id="course_name" name="course_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="credits" class="form-label">Jumlah SKS</label>
                        <input type="number" class="form-control" id="credits" name="credits" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Daftar Mata Kuliah</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($courses as $course): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($course['course_name']) ?></td>
                            <td><?= esc($course['credits']) ?></td>
                            <td>
                                <form action="<?= site_url('admin/courses/delete/' . $course['course_id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?');">
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