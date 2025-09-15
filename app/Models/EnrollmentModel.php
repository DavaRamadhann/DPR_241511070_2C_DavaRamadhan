<?php namespace App\Models;
use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table = 'takes';
    protected $primaryKey = 'enrollment_id';
    protected $allowedFields = ['student_id', 'course_id', 'enroll_date'];
}