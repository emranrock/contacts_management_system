<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contact extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>['type'=>'INT','constraint'=>11,'unassigned'=>true,'auto_increment'=>true],
            'name'=>['type'=>'VARCHAR','constraint'=>255],
            'email'=>['type'=>'VARCHAR','constraint'=>255],
            'phone'=>['type'=>'VARCHAR','constraint'=>255],
            'group'=>['type'=>'INT','constraint'=>11,'unassigned'=>true]
        ]);

        $this->forge->addKey('id',true);
        $this->forge->addForeignKey('group', 'groups', 'group_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('contacts');
    }

    public function down()
    {
        $this->forge->dropTable('contacts');
    }
}
