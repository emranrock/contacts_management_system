<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Role extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'roleId'=>['type'=>'INT','constraint'=>11,'unassigned'=>true,'auto_increment'=>true],
            'role'=>['type'=>'VARCHAR','constraint'=>255]
        ]);

        $this->forge->addKey('roleId',true);
        $this->forge->createTable('roles');
    }

    public function down()
    {
        $this->forge->dropTable('roles');
    }
}
