<?php
namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = NULL;

    public function test()
    {
        $builder = $this->db->table('admin');
        $builder->orderBy('id',"desc");
        $result = $builder->get()->getResultArray();
        return $result;
    }


}