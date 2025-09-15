<?php namespace App\Models;
use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    protected $allowedFields = ['student_id', 'entry_year'];
}