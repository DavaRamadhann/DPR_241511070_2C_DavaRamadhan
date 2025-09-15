<?= $this->extend('layout/template') ?>

<?= $this->section('title') ?>
Mata Kuliah yang Diambil
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow-sm">
    <div class="card-header">
        <h4>Daftar Mata Kuliah yang Telah Anda Ambil</h4>
    </div>
    <div class="card-body">
        
        <?php if (!empty($enrolledCourses)): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Tanggal Pengambilan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($enrolledCourses as $course): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($course['course_name']) ?></td>
                        <td><?= esc($course['credits']) ?></td>
                        <td><?= date('d F Y', strtotime($course['enroll_date'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">
                Anda belum mengambil mata kuliah apapun. Silakan ambil mata kuliah pada menu "Ambil Mata Kuliah".
            </div>
        <?php endif; ?>

    </div>
</div>
<?= $this->endSection() ?>