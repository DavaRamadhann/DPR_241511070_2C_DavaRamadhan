<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username'   => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'password'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'full_name'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'role'       => ['type' => 'ENUM', 'constraint' => ['Admin', 'Mahasiswa']],
            'created_at' => ['type' => 'TIMESTAMP', 'null' => true, 'default' => null],
            'updated_at' => ['type' => 'TIMESTAMP', 'null' => true, 'default' => null],
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        //
    }
}
