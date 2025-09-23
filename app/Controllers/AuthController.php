<?php namespace App\Controllers;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function selectRole() {
        return view('auth/role_selection');
    }

    public function loginAdmin() {
        $data = [
            'role' => 'Admin',
            'formAction' => 'login/admin'
        ];
        return view('auth/login', $data);
    }
    
    public function loginMahasiswa() {
        $data = [
            'role' => 'Mahasiswa',
            'formAction' => 'login/mahasiswa'
        ];
        return view('auth/login', $data);
    }

    public function processAdminLogin()
    {
        // Langsung panggil processLoginAttempt dan kembalikan hasilnya
        return $this->processLoginAttempt('Admin');
    }

    public function processMahasiswaLogin()
    {
        // Langsung panggil processLoginAttempt dan kembalikan hasilnya
        return $this->processLoginAttempt('Mahasiswa');
    }

    private function processLoginAttempt(string $expectedRole)
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Username atau Password salah!');
        }

        if ($user['role'] !== $expectedRole) {
            return redirect()->back()->withInput()->with('error', "Akses ditolak. Akun ini bukan akun {$expectedRole}.");
        }
        
        $sessionData = [
            'user_id'    => $user['user_id'],
            'username'   => $user['username'],
            'role'       => $user['role'],
            'isLoggedIn' => true,
        ];
        session()->set($sessionData);
        
        // Pastikan redirect mengarah ke URL yang benar
        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}