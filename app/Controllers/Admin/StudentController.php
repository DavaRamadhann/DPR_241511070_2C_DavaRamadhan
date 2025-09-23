<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\StudentModel;

class StudentController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        
        $data['students'] = $userModel
            ->select('users.user_id, users.username, users.full_name, students.entry_year')
            ->join('students', 'students.student_id = users.user_id')
            ->where('users.role', 'Mahasiswa')
            ->findAll();

        return view('admin/students', $data);
    }

    public function create()
    {
        // 1. Definisikan Aturan Validasi
        $rules = [
            'full_name'  => 'required|min_length[3]',
            'username'   => 'required|min_length[5]|is_unique[users.username]',
            'password'   => 'required|min_length[8]',
            'entry_year' => 'required|exact_length[4]|numeric'
        ];

        // 2. Jalankan Validasi
        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembali ke form dengan error dan input lama
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 3. Jika validasi berhasil, lanjutkan proses penyimpanan
        $userModel = new UserModel();
        $studentModel = new StudentModel();
        
        $userData = [
            'username'  => $this->request->getPost('username'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'full_name' => $this->request->getPost('full_name'),
            'role'      => 'Mahasiswa'
        ];
        
        $userModel->insert($userData);
        $newUserId = $userModel->getInsertID();

        $studentData = [
            'student_id' => $newUserId,
            'entry_year' => $this->request->getPost('entry_year')
        ];
        $studentModel->insert($studentData);

        return redirect()->to('/admin/students')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to('/admin/students')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}