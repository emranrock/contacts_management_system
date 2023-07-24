<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>['type'=>'INT','constraint'=>11,'unassigned'=>true,'auto_increment'=>true],
            'full_name'=>['type'=>'VARCHAR','constraint'=>255],
            'email'=>['type'=>'VARCHAR','constraint'=>255],
            'password'=>['type'=>'VARCHAR','constraint'=>255],
            'phone'=>['type'=>'VARCHAR','constraint'=>255],
            'roleId'=>['type'=>'INT','constraint'=>11,'unassigned'=>true]
        ]);

        $this->forge->addKey('id',true);
        $this->forge->addForeignKey('roleId', 'roles', 'roleId', 'CASCADE', 'CASCADE');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
