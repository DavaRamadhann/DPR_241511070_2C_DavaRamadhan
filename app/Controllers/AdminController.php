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
        $data['anggota'] = $model->findAll();
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
        $model = new \App\Models\KomponenGajiModel();
        $data['komponen'] = $model->findAll();
        
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

    public function createPenggajian()
    {
        $anggotaModel = new \App\Models\AnggotaModel();
        $komponenModel = new KomponenGajiModel();

        $data['anggota'] = $anggotaModel->findAll();
        $data['komponen'] = []; // Awalnya kosong, akan diisi via JavaScript

        // Ambil ID anggota dari URL jika ada (untuk auto-select)
        $selectedAnggotaId = $this->request->getGet('id_anggota');
        if ($selectedAnggotaId) {
            $anggota = $anggotaModel->find($selectedAnggotaId);
            if ($anggota) {
                // Ambil komponen yang sesuai dengan jabatan anggota + yang berlaku untuk "Semua"
                $data['komponen'] = $komponenModel->where('jabatan', $anggota['jabatan'])
                                                  ->orWhere('jabatan', 'Semua')
                                                  ->findAll();

                // Ambil komponen yang sudah ditambahkan untuk anggota ini
                $penggajianModel = new PenggajianModel();
                $sudahAda = $penggajianModel->where('id_anggota', $selectedAnggotaId)->findColumn('id_komponen');
                $data['komponen_sudah_ada'] = $sudahAda ?? [];
            }
        }
        $data['selected_anggota_id'] = $selectedAnggotaId;

        return view('admin/penggajian/create', $data);
    }

    public function storePenggajian()
    {
        $rules = [
            'id_anggota' => 'required',
            'id_komponen' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $idAnggota = $this->request->getPost('id_anggota');
        $idKomponen = $this->request->getPost('id_komponen');

        $model = new PenggajianModel();

        // Validasi agar tidak ada komponen ganda
        $existing = $model->where('id_anggota', $idAnggota)
                          ->where('id_komponen', $idKomponen)
                          ->first();

        if ($existing) {
            return redirect()->to('/admin/penggajian/create?id_anggota=' . $idAnggota)
                             ->with('error', 'Komponen gaji tersebut sudah ditambahkan untuk anggota ini.');
        }

        $model->save([
            'id_anggota' => $idAnggota,
            'id_komponen' => $idKomponen,
        ]);

        // Redirect kembali ke halaman yang sama untuk menambah komponen lain
        return redirect()->to('/admin/penggajian/create?id_anggota=' . $idAnggota)
                         ->with('success', 'Komponen berhasil ditambahkan ke penggajian anggota.');
    }

    // --- METHOD BARU UNTUK MELIHAT DATA PENGGAJIAN ---

    /**
     * Menampilkan daftar penggajian semua anggota dengan total Take Home Pay.
     */
    public function penggajian()
    {
        $db = \Config\Database::connect();
        
        // Query builder untuk menggabungkan tabel dan menghitung total gaji
        $builder = $db->table('anggota');
        $builder->select('
            anggota.id_anggota, 
            anggota.gelar_depan, 
            anggota.nama_depan, 
            anggota.nama_belakang, 
            anggota.gelar_belakang, 
            anggota.jabatan,
            (
                SELECT SUM(komponen_gaji.nominal) 
                FROM penggajian 
                JOIN komponen_gaji ON penggajian.id_komponen = komponen_gaji.id_komponen
                WHERE penggajian.id_anggota = anggota.id_anggota
            ) as total_gaji
        ');
        $builder->groupBy('anggota.id_anggota');
        
        $data['penggajian'] = $builder->get()->getResultArray();

        return view('admin/penggajian/index', $data);
    }

    public function detailPenggajian($id_anggota)
    {
        $anggotaModel = new \App\Models\AnggotaModel();
        $data['anggota'] = $anggotaModel->find($id_anggota);

        if (!$data['anggota']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data anggota tidak ditemukan.');
        }
    
        $db = \Config\Database::connect();

        // 1. Ambil semua komponen gaji pokok & jabatan yang sudah terdaftar
        // Modifikasi query untuk mengambil id_penggajian
        $builder = $db->table('penggajian p');
        $builder->select('p.id, kg.nama_komponen, kg.kategori, kg.nominal');
        $builder->join('komponen_gaji kg', 'p.id_komponen = kg.id_komponen');
        $builder->where('p.id_anggota', $id_anggota);
        $komponen_diterima = $builder->get()->getResultArray();
        $data['komponen_diterima'] = $komponen_diterima;
    
        // 2. Hitung Tunjangan Istri/Suami (jika status 'Kawin')
        $tunjangan_pasangan = 0;
        if($data['anggota']['status_pernikahan'] == 'Kawin'){
            $query = $db->table('komponen_gaji')->where('nama_komponen', 'Tunjangan Istri/Suami')->get()->getRow();
            if ($query) {
                $tunjangan_pasangan = $query->nominal;
            }
        }
    
        // Kirim data tunjangan ke view
        $data['tunjangan_pasangan'] = ['nama' => 'Tunjangan Istri/Suami', 'nominal' => $tunjangan_pasangan];
    
        // 4. Hitung total Take Home Pay
        $total_pokok_jabatan = array_sum(array_column($komponen_diterima, 'nominal'));
        $data['take_home_pay'] = $total_pokok_jabatan + $tunjangan_pasangan;

        return view('admin/penggajian/detail', $data);
    }

    public function deleteKomponenPenggajian($id_penggajian)
    {
        $penggajianModel = new PenggajianModel();
        
        // Ambil data penggajian untuk mendapatkan id_anggota sebelum dihapus
        $penggajian = $penggajianModel->find($id_penggajian);
        if ($penggajian) {
            $id_anggota = $penggajian['id_anggota'];
            $penggajianModel->delete($id_penggajian);
            
            return redirect()->to('/admin/penggajian/detail/' . $id_anggota)
                             ->with('success', 'Satu komponen gaji berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    public function deletePenggajian($id_anggota)
    {
        $penggajianModel = new PenggajianModel();
        $penggajianModel->where('id_anggota', $id_anggota)->delete();

        return redirect()->to('/admin/penggajian')->with('success', 'Semua data penggajian untuk anggota tersebut berhasil direset.');
    }
}