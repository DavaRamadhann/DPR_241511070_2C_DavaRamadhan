<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\StudentModel;

class StudentController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        
        // Ambil semua data user yang rolenya 'Mahasiswa' dan join dengan data student
        $data['students'] = $userModel
            ->select('users.user_id, users.username, users.full_name, students.entry_year')
            ->join('students', 'students.student_id = users.user_id')
            ->where('users.role', 'Mahasiswa')
            ->findAll();

        return view('admin/students', $data);
    }

    public function create()
    {
        $userModel = new UserModel();
        $studentModel = new StudentModel();
        
        // 1. Simpan data ke tabel 'users'
        $userData = [
            'username'  => $this->request->getPost('username'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'full_name' => $this->request->getPost('full_name'),
            'role'      => 'Mahasiswa'
        ];
        
        // Gunakan transaction untuk memastikan kedua insert berhasil
        $this->db = \Config\Database::connect();
        $this->db->transStart();
        
        $userModel->insert($userData);
        
        // 2. Ambil user_id yang baru saja dibuat
        $newUserId = $userModel->getInsertID();

        // 3. Simpan data ke tabel 'students'
        $studentData = [
            'student_id' => $newUserId,
            'entry_year' => $this->request->getPost('entry_year')
        ];
        $studentModel->insert($studentData);

        $this->db->transComplete();

        return redirect()->to('/admin/students')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        // Karena kita menggunakan CASCADE on delete di migrasi,
        // menghapus data di tabel 'users' akan otomatis menghapus data terkait di 'students'.
        $userModel->delete($id);

        return redirect()->to('/admin/students')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}