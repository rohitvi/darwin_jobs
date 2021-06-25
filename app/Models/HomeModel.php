<?php
namespace App\Models;
use CodeIgniter\Model;
class HomeModel extends Model
{
    protected $table = NULL;

    public function add_subscriber($data)
    {
        $builder = $this->db->table('subscribers');
        $builder->where('email',$data['email']);
        if ($builder->countAllResults() > 0) {
            return true;
        }
        else
        {
            return $this->db->table('subscribers')->insert($data);
        }
    }

}