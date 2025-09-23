<?php namespace App\Controllers\Mahasiswa;
use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class CourseController extends BaseController
{
    public function index()
    {
        $courseModel = new CourseModel();
        $enrollmentModel = new EnrollmentModel();
        
        $data['courses'] = $courseModel->findAll();
        
        // Get courses already enrolled by the student
        $enrolled = $enrollmentModel->where('student_id', session()->get('user_id'))->findAll();
        $data['enrolledCourseIds'] = array_column($enrolled, 'course_id');

        return view('mahasiswa/courses', $data);
    }

    public function enroll()
    {
        $enrollmentModel = new EnrollmentModel();
        $selectedCourses = $this->request->getPost('course_ids');
        $studentId = session()->get('user_id');

        if (empty($selectedCourses)) {
            return redirect()->to('/mahasiswa/courses')->with('error', 'Tidak ada mata kuliah yang dipilih.');
        }

        foreach ($selectedCourses as $courseId) {
            // Cek agar tidak double enroll
            $isExist = $enrollmentModel->where('student_id', $studentId)
                                       ->where('course_id', $courseId)
                                       ->first();
            if (!$isExist) {
                $enrollmentModel->save([
                    'student_id' => $studentId,
                    'course_id'  => $courseId,
                    'enroll_date' => date('Y-m-d')
                ]);
            }
        }
        
        return redirect()->to('/mahasiswa/courses')->with('success', 'Berhasil mengambil mata kuliah yang dipilih!');
    }

    public function myCourses()
    {
        $enrollmentModel = new EnrollmentModel();
        
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