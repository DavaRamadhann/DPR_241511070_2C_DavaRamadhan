<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['course_name' => 'Dasar Pemrograman', 'credits' => 3],
            ['course_name' => 'Struktur Data', 'credits' => 3],
            ['course_name' => 'Proyek Perangkat Lunak 3', 'credits' => 4],
        ];
        $this->db->table('courses')->insertBatch($data);
    }
}
