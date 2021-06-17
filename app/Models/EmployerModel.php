<?php
namespace App\Models;
use CodeIgniter\Model;

class EmployerModel extends Model
 {
    protected $table = NULL;

    public function getpackages()
    {
      return $this->db->table('packages')->get()->getResultArray();
    }

}