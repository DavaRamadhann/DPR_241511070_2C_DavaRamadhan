<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTakesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'enrollment_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'student_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'course_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'enroll_date'   => ['type' => 'DATE'],
        ]);
        $this->forge->addKey('enrollment_id', true);
        $this->forge->addForeignKey('student_id', 'students', 'student_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('course_id', 'courses', 'course_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('takes');
    }

    public function down()
    {
        //
    }
}
