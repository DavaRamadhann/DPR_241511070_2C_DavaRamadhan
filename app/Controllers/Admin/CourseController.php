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
        $courseModel = new CourseModel();
        $courseModel->save([
            'course_name' => $this->request->getPost('course_name'),
            'credits' => $this->request->getPost('credits'),
        ]);
        return redirect()->to('/admin/courses');
    }

    public function delete($id)
    {
        $courseModel = new CourseModel();
        $courseModel->delete($id);
        return redirect()->to('/admin/courses');
    }
}