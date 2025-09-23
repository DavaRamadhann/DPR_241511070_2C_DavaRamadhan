<?= $this->extend('layout/admin_template') ?>

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
                <div id="success-message" class="alert alert-success" style="display: none;"></div>
                <?php if(session()->get('errors')): ?>
                    <div class="alert alert-danger">
                        <p class="mb-0"><strong>Terdapat kesalahan:</strong></p>
                        <ul>
                            <?php foreach (session()->get('errors') as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form id="add-course-form" action="<?= site_url('admin/courses/create') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="course_name" class="form-label">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" id="course_name" name="course_name">
                        <div class="invalid-feedback" id="course_name_error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="credits" class="form-label">Jumlah SKS</label>
                        <input type="number" class="form-control" id="credits" name="credits">
                        <div class="invalid-feedback" id="credits_error"></div>
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
                    <tbody id="courses-table-body">
                        <?php $no = 1; foreach($courses as $course): ?>
                        <tr id="course-row-<?= $course['course_id'] ?>">
                            <td><?= $no++ ?></td>
                            <td><?= esc($course['course_name']) ?></td>
                            <td><?= esc($course['credits']) ?></td>
                            <td>
                                <form action="<?= site_url('admin/courses/delete/' . $course['course_id']) ?>" method="post" class="d-inline delete-form">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            data-course-name="<?= esc($course['course_name']) ?>" 
                                            data-course-credits="<?= esc($course['credits']) ?>">Hapus</button>
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

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // FORM VALIDATION
    const form = document.getElementById('add-course-form');
    const courseNameInput = document.getElementById('course_name');
    const creditsInput = document.getElementById('credits');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default submission

        let isValid = true;
        // Reset errors
        [courseNameInput, creditsInput].forEach(input => {
            input.classList.remove('is-invalid');
            document.getElementById(input.id + '_error').textContent = '';
        });

        // Validate Course Name
        if (courseNameInput.value.trim() === '') {
            courseNameInput.classList.add('is-invalid');
            document.getElementById('course_name_error').textContent = 'Nama mata kuliah tidak boleh kosong.';
            isValid = false;
        }

        // Validate Credits
        if (creditsInput.value.trim() === '' || parseInt(creditsInput.value) <= 0) {
            creditsInput.classList.add('is-invalid');
            document.getElementById('credits_error').textContent = 'Jumlah SKS harus angka positif.';
            isValid = false;
        }

        if (isValid) {
            // Asynchronous submission (optional, for no-refresh experience)
            // For now, we'll just let the form submit normally if valid
            this.submit();
        }
    });

    // DELETE CONFIRMATION
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const button = this.querySelector('button[type="submit"]');
            const courseName = button.getAttribute('data-course-name');
            const courseCredits = button.getAttribute('data-course-credits');
            
            const message = `Apakah Anda yakin ingin menghapus mata kuliah:\n\nNama: ${courseName}\nSKS: ${courseCredits}\n\nAksi ini tidak dapat dibatalkan.`;
            
            if (confirm(message)) {
                this.submit();
            }
        });
    });

    // ASYNC EXAMPLE: Show temporary success message
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success')) {
        const successMessage = document.getElementById('success-message');
        successMessage.textContent = 'Aksi berhasil dilakukan!';
        successMessage.style.display = 'block';

        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 3000); // Hide after 3 seconds
    }
});
</script>
<?= $this->endSection() ?>