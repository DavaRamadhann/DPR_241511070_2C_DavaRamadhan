<?= $this->extend('layout/mahasiswa_template') ?>

<?= $this->section('title') ?>
Ambil Mata Kuliah
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Daftar Mata Kuliah Tersedia</h4>
        <div class="fw-bold fs-5">Total SKS Dipilih: <span id="total-sks" class="badge bg-primary">0</span></div>
    </div>
    <div class="card-body">
        
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('mahasiswa/courses/enroll') ?>" method="POST">
            <?= csrf_field() ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 5%;">Pilih</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($courses as $course): 
                        $isEnrolled = in_array($course['course_id'], $enrolledCourseIds);
                    ?>
                    <tr>
                        <td class="text-center">
                            <input class="form-check-input course-checkbox" type="checkbox" 
                                   name="course_ids[]" 
                                   value="<?= $course['course_id'] ?>"
                                   data-sks="<?= $course['credits'] ?>"
                                   <?= $isEnrolled ? 'disabled checked' : '' ?>>
                        </td>
                        <td><?= esc($course['course_name']) ?><?= $isEnrolled ? ' <span class="badge bg-secondary">Sudah Diambil</span>' : '' ?></td>
                        <td><?= esc($course['credits']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Ambil Mata Kuliah Terpilih</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const totalSksElement = document.getElementById('total-sks');
    const checkboxes = document.querySelectorAll('.course-checkbox');

    function calculateTotalSks() {
        let totalSks = 0;
        checkboxes.forEach(checkbox => {
            if (checkbox.checked && !checkbox.disabled) {
                totalSks += parseInt(checkbox.getAttribute('data-sks'), 10);
            }
        });
        totalSksElement.textContent = totalSks;
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', calculateTotalSks);
    });

    // Initial calculation
    calculateTotalSks();
});
</script>
<?= $this->endSection() ?>