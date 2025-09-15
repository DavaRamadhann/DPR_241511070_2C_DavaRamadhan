<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Data Admin
        $adminData = [
            'username'  => 'admin',
            'password'  => password_hash('admin123', PASSWORD_DEFAULT),
            'full_name' => 'Administrator',
            'role'      => 'Admin'
        ];
        // Data Mahasiswa
        $mhsData = [
            'username'  => 'mahasiswa',
            'password'  => password_hash('mahasiswa123', PASSWORD_DEFAULT),
            'full_name' => 'Budi Santoso',
            'role'      => 'Mahasiswa'
        ];

        $userModel = new \App\Models\UserModel();
        $userModel->insert($adminData);

        // Insert Mahasiswa dan data student-nya
        $mhsUserId = $userModel->insert($mhsData, true);
        $studentModel = new \App\Models\StudentModel();
        $studentModel->insert(['student_id' => $mhsUserId, 'entry_year' => '2023']);
    }
}
