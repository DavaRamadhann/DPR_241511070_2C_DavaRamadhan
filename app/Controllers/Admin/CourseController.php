<?php namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\CourseModel;

class CourseController extends BaseController
{
    public function index()
    {
        $courseModel = new CourseModel();
        $data['courses'] = $courseModel->findAll();
        return view('admin/courses', $data);
    }

    public function create()
    {
        // 1. Definisikan Aturan Validasi
        $rules = [
            'course_name' => 'required|min_length[3]|max_length[255]',
            'credits'     => 'required|numeric|greater_than[0]'
        ];

        // 2. Jalankan Validasi
        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembali ke form dengan error dan input lama
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 3. Jika validasi berhasil, simpan data
        $courseModel = new CourseModel();
        $courseModel->save([
            'course_name' => $this->request->getPost('course_name'),
            'credits' => $this->request->getPost('credits'),
        ]);

        return redirect()->to('/admin/courses')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    public function delete($id)
    {
        $courseModel = new CourseModel();
        $courseModel->delete($id);
        return redirect()->to('/admin/courses')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}