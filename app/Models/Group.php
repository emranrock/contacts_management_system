<?php

namespace App\Models;

use CodeIgniter\Model;

class Group extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'groups';
    protected $primaryKey       = 'group_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name'];

    public function getGroups($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id]);
        }
    }
}
