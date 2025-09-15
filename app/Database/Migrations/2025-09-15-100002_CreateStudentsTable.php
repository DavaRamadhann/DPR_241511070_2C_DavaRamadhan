<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'student_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'entry_year' => ['type' => 'YEAR', 'constraint' => 4],
        ]);
        $this->forge->addKey('student_id', true);
        $this->forge->addForeignKey('student_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('students');
    }

    public function down()
    {
        //
    }
}
