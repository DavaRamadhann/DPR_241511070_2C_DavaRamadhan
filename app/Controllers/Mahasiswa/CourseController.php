<?php namespace App\Controllers\Mahasiswa;
use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class CourseController extends BaseController
{
    public function index()
    {
        $courseModel = new CourseModel();
        $data['courses'] = $courseModel->findAll();
        return view('mahasiswa/courses', $data);
    }

    public function enroll($courseId)
    {
        $enrollmentModel = new EnrollmentModel();
        $enrollmentModel->save([
            'student_id' => session()->get('user_id'),
            'course_id'  => $courseId,
            'enroll_date' => date('Y-m-d')
        ]);
        return redirect()->to('/mahasiswa/courses')->with('success', 'Berhasil mendaftar mata kuliah!');
    }

    public function myCourses()
    {
        $enrollmentModel = new EnrollmentModel();
        
        // Kita butuh JOIN untuk mendapatkan nama mata kuliah dari tabel 'courses'
        // berdasarkan data yang ada di tabel 'takes'
        $enrolledCourses = $enrollmentModel
            ->select('courses.course_name, courses.credits, takes.enroll_date')
            ->join('courses', 'courses.course_id = takes.course_id')
            ->where('takes.student_id', session()->get('user_id'))
            ->findAll();
            
        $data = [
            'enrolledCourses' => $enrolledCourses
        ];

        return view('mahasiswa/my_courses', $data);
    }
}
