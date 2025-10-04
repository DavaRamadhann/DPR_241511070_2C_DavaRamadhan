<?php

namespace App\Controllers;

use App\Models\AnggotaModel;

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
}