<?php namespace App\Controllers;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login() { return view('auth/login'); }

    public function processLogin()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $sessionData = [
                'user_id'    => $user['user_id'],
                'username'   => $user['username'],
                'role'       => $user['role'],
                'isLoggedIn' => true,
            ];
            session()->set($sessionData);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->to('/login')->with('error', 'Login Gagal!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}