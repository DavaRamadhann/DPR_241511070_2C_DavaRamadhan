<?= $this->extend('layout/template') ?>

<?= $this->section('title') ?>
Ambil Mata Kuliah
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow-sm">
    <div class="card-header">
        <h4>Daftar Mata Kuliah Tersedia</h4>
    </div>
    <div class="card-body">
        
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

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
                        <a href="<?= site_url('mahasiswa/courses/enroll/' . $course['course_id']) ?>" 
                           class="btn btn-success btn-sm"
                           onclick="return confirm('Apakah Anda yakin ingin mengambil mata kuliah ini?')">
                           Ambil (Enroll)
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>