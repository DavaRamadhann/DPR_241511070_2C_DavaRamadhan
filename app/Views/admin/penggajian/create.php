<?= $this->extend('layout/admin_template') ?>

<?= $this->section('title') ?>
Tambah Data Penggajian
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="mb-0">Formulir Tambah Data Penggajian</h2>
        </div>
        <div class="card-body">
            
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div class="mb-4">
                <label for="id_anggota_select" class="form-label fs-5">Langkah 1: Pilih Anggota DPR</label>
                <select class="form-select" id="id_anggota_select">
                    <option value="">--- Pilih Anggota ---</option>
                    <?php foreach($anggota as $item): ?>
                        <option value="<?= $item['id_anggota'] ?>" <?= ($selected_anggota_id == $item['id_anggota']) ? 'selected' : '' ?>>
                            <?= esc($item['nama_depan'] . ' ' . $item['nama_belakang']) ?> (<?= esc($item['jabatan']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <?php if($selected_anggota_id): ?>
                <hr>
                <h3 class="fs-5">Langkah 2: Tambah Komponen Gaji untuk <span class="text-primary"><?= esc($anggota[array_search($selected_anggota_id, array_column($anggota, 'id_anggota'))]['nama_depan']) ?></span></h3>
                <form action="<?= site_url('admin/penggajian/store') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_anggota" value="<?= $selected_anggota_id ?>">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="id_komponen" class="form-label">Pilih Komponen</label>
                            <select class="form-select" id="id_komponen" name="id_komponen" required>
                                <option value="">--- Pilih Komponen Gaji ---</option>
                                <?php foreach($komponen as $item): ?>
                                    <?php if(!in_array($item['id_komponen'], $komponen_sudah_ada)): ?>
                                        <option value="<?= $item['id_komponen'] ?>">
                                            <?= esc($item['nama_komponen']) ?> (Rp <?= number_format($item['nominal']) ?>)
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Tambahkan Komponen</button>
                        </div>
                    </div>
                </form>

                <div class="mt-4">
                    <h5>Komponen yang Sudah Diterima:</h5>
                    <?php
                        $komponenSudahDipilih = array_filter($komponen, function($k) use ($komponen_sudah_ada) {
                            return in_array($k['id_komponen'], $komponen_sudah_ada);
                        });
                    ?>
                    <?php if(empty($komponenSudahDipilih)): ?>
                        <p class="text-muted">Belum ada komponen yang ditambahkan.</p>
                    <?php else: ?>
                        <ul class="list-group">
                        <?php foreach($komponenSudahDipilih as $item): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= esc($item['nama_komponen']) ?>
                                <span class="badge bg-primary rounded-pill">Rp <?= number_format($item['nominal']) ?></span>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('id_anggota_select').addEventListener('change', function() {
        const selectedId = this.value;
        if (selectedId) {
            // Arahkan ke URL yang sama dengan parameter GET id_anggota
            window.location.href = '<?= site_url('admin/penggajian/create') ?>?id_anggota=' + selectedId;
        } else {
            // Jika tidak ada yang dipilih, kembali ke halaman tanpa parameter
            window.location.href = '<?= site_url('admin/penggajian/create') ?>';
        }
    });
</script>
<?= $this->endSection() ?>