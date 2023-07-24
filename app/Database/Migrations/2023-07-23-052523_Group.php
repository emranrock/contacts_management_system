<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Group extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'group_id'=>['type'=>'INT','constraint'=>11,'unassigned'=>true,'auto_increment'=>true],
            'name'=>['type'=>'VARCHAR','constraint'=>255]
        ]);
        $this->forge->addKey('group_id',true);
        $this->forge->createTable('groups');
    }

    public function down()
    {
        $this->forge->dropTable('groups');
    }
}
