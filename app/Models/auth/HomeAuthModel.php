<?php
namespace App\Models\auth;
use CodeIgniter\Model;

class HomeAuthModel extends Model
{
    protected $table = NULL;

    public function login_validate($email,$password)
    {
        $builder = $this->db->table('users');
        $result = $builder->where(array('email' => $email))->get()->getResultArray();
        if (count($result) == 1) {
            if (password_verify($password, $result[0]['password'])) {
               $array = array('id' => $result[0]['id'], 'username' => $result[0]['firstname']);
               return $array; 
            } else 
                return 0;
        } else {
            return 0;
        }
    }

    public function register($data)
    {
        return $this->db->table('users')->insert($data);
    }
}