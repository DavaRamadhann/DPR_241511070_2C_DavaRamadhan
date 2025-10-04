<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use App\Models\PenggajianModel;
use App\Models\KomponenGajiModel;

class AdminController extends BaseController
{
    /**
     * Menampilkan halaman dashboard utama untuk admin.
     */
    public function dashboard()
    {
        $db = \Config\Database::connect();
        
        // Menghitung jumlah anggota untuk ditampilkan di card
        $data['jumlah_anggota'] = $db->table('anggota')->countAllResults();
        // Menghitung jumlah komponen gaji untuk ditampilkan di card
        $data['jumlah_komponen'] = $db->table('komponen_gaji')->countAllResults();
        
        return view('admin/dashboard', $data);
    }

    /**
     * Menampilkan halaman formulir untuk menambah data anggota baru.
     */
    public function createAnggota()
    {
        // helper('form'); // Tidak perlu jika sudah di BaseController
        return view('admin/anggota/create');
    }

    /**
     * Memvalidasi dan menyimpan data anggota baru dari form.
     */
    public function storeAnggota()
    {
        // 1. Siapkan aturan validasi yang ketat sesuai kebutuhan
        $rules = [
            'nama_depan'    => [
                'rules'  => 'required|min_length[2]|alpha_space',
                'errors' => [
                    'required' => 'Nama depan wajib diisi.',
                    'min_length' => 'Nama depan minimal 2 karakter.',
                    'alpha_space' => 'Nama depan hanya boleh berisi huruf dan spasi.'
                ]
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => ['required' => 'Jabatan harus dipilih.']
            ],
            'status_pernikahan' => [
                'rules' => 'required',
                'errors' => ['required' => 'Status pernikahan harus dipilih.']
            ]
        ];

        // 2. Lakukan validasi data yang dikirim dari form
        if (! $this->validate($rules)) {
            // Jika validasi gagal, kembalikan pengguna ke form dengan pesan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 3. Jika validasi berhasil, simpan data ke database
        $model = new AnggotaModel();
        $model->save([
            'gelar_depan'       => $this->request->getPost('gelar_depan'),
            'nama_depan'        => $this->request->getPost('nama_depan'),
            'nama_belakang'     => $this->request->getPost('nama_belakang'),
            'gelar_belakang'    => $this->request->getPost('gelar_belakang'),
            'jabatan'           => $this->request->getPost('jabatan'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan')
        ]);

        // 4. Arahkan kembali ke halaman daftar anggota dengan pesan sukses
        return redirect()->to('/admin/anggota')->with('success', 'Data anggota baru berhasil ditambahkan!');
    }
    
    /**
     * Menampilkan daftar semua anggota.
     */
    public function anggota()
    {
        $model = new AnggotaModel();
        $keyword = $this->request->getGet('keyword'); // Ambil kata kunci dari URL

        if ($keyword) {
            // Jika ada kata kunci pencarian, lakukan query pencarian
            $data['anggota'] = $model->like('nama_depan', $keyword)
                                     ->orLike('nama_belakang', $keyword)
                                     ->orLike('jabatan', $keyword)
                                     ->orLike('id_anggota', $keyword)
                                     ->findAll();
        } else {
            // Jika tidak ada, tampilkan semua data
            $data['anggota'] = $model->findAll();
        }

        $data['keyword'] = $keyword; // Kirim keyword kembali ke view untuk ditampilkan di form
        return view('admin/anggota/index', $data);
    }

    // --- METHOD BARU UNTUK FITUR UBAH ---
    /**
     * Menampilkan halaman form untuk mengubah data anggota.
     */
    public function editAnggota($id)
    {
        $model = new AnggotaModel();
        $data['anggota'] = $model->find($id);

        if (!$data['anggota']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data anggota tidak ditemukan.');
        }

        return view('admin/anggota/edit', $data);
    }

    /**
     * Memproses dan memperbarui data anggota dari form edit.
     */
    public function updateAnggota($id)
    {
        // Aturan validasi bisa disesuaikan jika diperlukan
        $rules = [
            'nama_depan'    => 'required|min_length[2]|alpha_space',
            'jabatan'       => 'required',
            'status_pernikahan' => 'required'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new AnggotaModel();
        $model->update($id, [
            'gelar_depan'       => $this->request->getPost('gelar_depan'),
            'nama_depan'        => $this->request->getPost('nama_depan'),
            'nama_belakang'     => $this->request->getPost('nama_belakang'),
            'gelar_belakang'    => $this->request->getPost('gelar_belakang'),
            'jabatan'           => $this->request->getPost('jabatan'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan')
        ]);

        return redirect()->to('/admin/anggota')->with('success', 'Data anggota berhasil diperbarui!');
    }

    // --- METHOD BARU UNTUK FITUR HAPUS ---
    /**
     * Menghapus data anggota berdasarkan ID.
     */
    public function deleteAnggota($id)
    {
        $model = new AnggotaModel();
        $model->delete($id);

        return redirect()->to('/admin/anggota')->with('success', 'Data anggota berhasil dihapus.');
    }

    // --- METHOD BARU UNTUK KOMPONEN GAJI ---

    /**
     * Menampilkan halaman form untuk menambah komponen gaji baru.
     */
    public function createKomponen()
    {
        return view('admin/komponen/create');
    }

    /**
     * Memvalidasi dan menyimpan data komponen gaji baru.
     */
    public function storeKomponen()
    {
        // Aturan validasi
        $rules = [
            'nama_komponen' => 'required|min_length[3]',
            'kategori'      => 'required',
            'jabatan'       => 'required',
            'nominal'       => 'required|numeric',
            'satuan'        => 'required'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new \App\Models\KomponenGajiModel(); // Panggil modelnya
        $model->save([
            'nama_komponen' => $this->request->getPost('nama_komponen'),
            'kategori'      => $this->request->getPost('kategori'),
            'jabatan'       => $this->request->getPost('jabatan'),
            'nominal'       => $this->request->getPost('nominal'),
            'satuan'        => $this->request->getPost('satuan')
        ]);

        return redirect()->to('/admin/komponen')->with('success', 'Komponen gaji berhasil ditambahkan!');
    }

    public function komponenGaji()
    {
        $model = new KomponenGajiModel();
        $keyword = $this->request->getGet('keyword'); // Ambil kata kunci dari URL

        if ($keyword) {
            // Jika ada kata kunci pencarian, lakukan query pencarian multi-kolom
            $data['komponen'] = $model->like('nama_komponen', $keyword)
                                      ->orLike('kategori', $keyword)
                                      ->orLike('jabatan', $keyword)
                                      ->orLike('nominal', $keyword)
                                      ->orLike('satuan', $keyword)
                                      ->orLike('id_komponen', $keyword)
                                      ->findAll();
        } else {
            // Jika tidak ada, tampilkan semua data
            $data['komponen'] = $model->findAll();
        }

        $data['keyword'] = $keyword; // Kirim keyword kembali ke view
        return view('admin/komponen/index', $data);
    }

    public function editKomponen($id)
    {
        $model = new \App\Models\KomponenGajiModel();
        $data['komponen'] = $model->find($id);

        if (!$data['komponen']) {
            // Jika data tidak ditemukan, tampilkan error 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Komponen gaji tidak ditemukan.');
        }

        return view('admin/komponen/edit', $data);
    }

    /**
     * Memproses dan memperbarui data komponen gaji dari form edit.
     */
    public function updateKomponen($id)
    {
        // Aturan validasi (sama seperti saat membuat)
        $rules = [
            'nama_komponen' => 'required|min_length[3]',
            'kategori'      => 'required',
            'jabatan'       => 'required',
            'nominal'       => 'required|numeric',
            'satuan'        => 'required'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new \App\Models\KomponenGajiModel();
        $model->update($id, [
            'nama_komponen' => $this->request->getPost('nama_komponen'),
            'kategori'      => $this->request->getPost('kategori'),
            'jabatan'       => $this->request->getPost('jabatan'),
            'nominal'       => $this->request->getPost('nominal'),
            'satuan'        => $this->request->getPost('satuan')
        ]);

        return redirect()->to('/admin/komponen')->with('success', 'Data komponen gaji berhasil diperbarui!');
    }

    public function deleteKomponen($id)
    {
        $model = new \App\Models\KomponenGajiModel();
        $model->delete($id);

        return redirect()->to('/admin/komponen')->with('success', 'Komponen gaji berhasil dihapus.');
    }

    /**
     * Menampilkan daftar penggajian dengan Take Home Pay dan fitur pencarian.
     */
    public function penggajian()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('anggota a');
        
        // Query utama untuk mengambil data anggota
        $builder->select("
            a.id_anggota, a.gelar_depan, a.nama_depan, a.nama_belakang, a.gelar_belakang, 
            a.jabatan, a.status_pernikahan
        ");

        // Logika Pencarian
        $keyword = $this->request->getGet('keyword');
        if ($keyword) {
            $builder->like('a.nama_depan', $keyword)
                    ->orLike('a.nama_belakang', $keyword)
                    ->orLike('a.jabatan', $keyword)
                    ->orLike('a.id_anggota', $keyword);
        }
        
        $anggotaList = $builder->get()->getResultArray();
        
        // Lakukan perhitungan Take Home Pay di PHP untuk setiap anggota
        foreach ($anggotaList as &$anggota) {
            $anggota['take_home_pay'] = $this->hitungTakeHomePay($anggota['id_anggota']);
        }
        
        $data['penggajian'] = $anggotaList;
        $data['keyword'] = $keyword;

        return view('admin/penggajian/index', $data);
    }

    /**
     * Menampilkan form untuk menambah data penggajian.
     */
    public function createPenggajian()
    {
        $anggotaModel = new AnggotaModel();
        $komponenModel = new KomponenGajiModel();

        $data['anggota_list'] = $anggotaModel->findAll();
        $data['komponen_list'] = []; 

        $selectedAnggotaId = $this->request->getGet('id_anggota');
        if ($selectedAnggotaId) {
            $anggota = $anggotaModel->find($selectedAnggotaId);
            if ($anggota) {
                // Challenge Validation: Komponen gaji menyesuaikan jabatan
                $data['komponen_list'] = $komponenModel->whereIn('jabatan', [$anggota['jabatan'], 'Semua'])->findAll();

                $penggajianModel = new PenggajianModel();
                $sudahAda = $penggajianModel->where('id_anggota', $selectedAnggotaId)->findColumn('id_komponen');
                $data['komponen_sudah_ada'] = $sudahAda ?? [];
            }
        }
        $data['selected_anggota_id'] = $selectedAnggotaId;

        return view('admin/penggajian/create', $data);
    }

    /**
     * Memproses dan menyimpan data penggajian baru.
     */
    public function storePenggajian()
    {
        $idAnggota = $this->request->getPost('id_anggota');
        $idKomponen = $this->request->getPost('id_komponen');

        $model = new PenggajianModel();

        // Challenge Validation: Tidak bisa menambahkan komponen yang sama
        $existing = $model->where(['id_anggota' => $idAnggota, 'id_komponen' => $idKomponen])->first();
        if ($existing) {
            return redirect()->to('/admin/penggajian/create?id_anggota=' . $idAnggota)
                             ->with('error', 'Komponen gaji tersebut sudah ditambahkan untuk anggota ini.');
        }

        $model->save(['id_anggota' => $idAnggota, 'id_komponen' => $idKomponen]);

        return redirect()->to('/admin/penggajian/create?id_anggota=' . $idAnggota)
                         ->with('success', 'Komponen berhasil ditambahkan.');
    }

    /**
     * Menampilkan rincian detail penggajian untuk satu anggota.
     */
    public function detailPenggajian($id_anggota)
    {
        $anggotaModel = new AnggotaModel();
        $data['anggota'] = $anggotaModel->find($id_anggota);

        if (!$data['anggota']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data anggota tidak ditemukan.');
        }
    
        $db = \Config\Database::connect();
        
        $builder = $db->table('penggajian p');
        $builder->select('p.id, kg.nama_komponen, kg.kategori, kg.nominal');
        $builder->join('komponen_gaji kg', 'p.id_komponen = kg.id_komponen');
        $builder->where('p.id_anggota', $id_anggota);
        $data['komponen_diterima'] = $builder->get()->getResultArray();
    
        $data['take_home_pay'] = $this->hitungTakeHomePay($id_anggota, $data);

        return view('admin/penggajian/detail', $data);
    }
    
    /**
     * Menghapus satu komponen dari penggajian (fungsi "Ubah").
     */
    public function deleteKomponenPenggajian($id_penggajian)
    {
        $penggajianModel = new PenggajianModel();
        $penggajian = $penggajianModel->find($id_penggajian);
        if ($penggajian) {
            $id_anggota = $penggajian['id_anggota'];
            $penggajianModel->delete($id_penggajian);
            return redirect()->to('/admin/penggajian/detail/' . $id_anggota)
                             ->with('success', 'Satu komponen gaji berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    /**
     * Menghapus SEMUA data penggajian untuk seorang anggota.
     */
    public function deletePenggajian($id_anggota)
    {
        $penggajianModel = new PenggajianModel();
        $penggajianModel->where('id_anggota', $id_anggota)->delete();
        return redirect()->to('/admin/penggajian')->with('success', 'Semua data penggajian untuk anggota tersebut berhasil direset.');
    }

    /**
     * Helper function untuk menghitung Take Home Pay.
     */
    private function hitungTakeHomePay($id_anggota, &$data = [])
    {
        $db = \Config\Database::connect();
        $anggota = $data['anggota'] ?? (new AnggotaModel())->find($id_anggota);

        // 1. Hitung total dari komponen yang terdaftar di tabel `penggajian`
        $builder = $db->table('penggajian');
        $builder->selectSum('komponen_gaji.nominal');
        $builder->join('komponen_gaji', 'komponen_gaji.id_komponen = penggajian.id_komponen');
        $builder->where('penggajian.id_anggota', $id_anggota);
        $total_pokok_jabatan = $builder->get()->getRow()->nominal ?? 0;

        // 2. Hitung Tunjangan Istri/Suami
        $tunjangan_pasangan = 0;
        if($anggota['status_pernikahan'] == 'Kawin'){
            $query = $db->table('komponen_gaji')->where('nama_komponen', 'Tunjangan Istri/Suami')->get()->getRow();
            if ($query) $tunjangan_pasangan = $query->nominal;
        }

        // Kirim data detail ke view jika $data di-pass by reference
        if (!empty($data)) {
            $data['tunjangan_pasangan'] = ['nama' => 'Tunjangan Istri/Suami', 'nominal' => $tunjangan_pasangan];
        }

        return $total_pokok_jabatan + $tunjangan_pasangan ;
    }
}