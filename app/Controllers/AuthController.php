<?php

namespace App\Controllers;

use App\Models\AdminModel;

class AuthController extends BaseController
{
    // Halaman utama untuk memilih peran
    public function chooseLogin()
    {
        return view('auth/choose_login');
    }

    // Hanya untuk MENAMPILKAN halaman login admin
    public function showAdminLogin()
    {
        return view('auth/login_admin', ['title' => 'Admin Login']);
    }

    // Hanya untuk MEMPROSES data login admin
    public function processAdminLogin()
    {
        $session = session();
        $model = new AdminModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $adminData = $model->where('username', $username)->first();

        // Cek username dan verifikasi password
        if ($adminData && password_verify($password, $adminData['password'])) {
            // Jika login berhasil, siapkan data session
            $sessionData = [
                'admin_id'   => $adminData['id_pengguna'],
                'username'   => $adminData['username'],
                'logged_in'  => true, // Gunakan boolean `true` bukan string `TRUE`
                'role'       => 'Admin'
            ];
            $session->set($sessionData);

            // Arahkan ke dashboard admin
            return redirect()->to('/admin/dashboard');
        }

        // Jika login gagal, kembali dengan pesan error
        $session->setFlashdata('msg', 'Username atau Password salah.');
        return redirect()->to('/login/admin');
    }

    // Fungsi logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}