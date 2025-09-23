<?php namespace App\Controllers;

// Pastikan use App\Controllers\BaseController ada
use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index() 
    {
        // Pastikan session sudah di-load dengan benar
        $role = session()->get('role');
        $template = '';

        if ($role === 'Admin') {
            $template = 'layout/admin_template';
        } elseif ($role === 'Mahasiswa') {
            $template = 'layout/mahasiswa_template';
        } else {
            return redirect()->to('/logout');
        }
        
        $data = [
            'template' => $template
        ];

        return view('dashboard', $data); 
    }
}