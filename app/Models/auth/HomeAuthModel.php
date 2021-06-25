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
        $this->db->table('users')->insert($data);
        return $this->db->insertID();
    }

    public function email_verification($token)
    {
        $builder = $this->db->table('users')->where('token',$token)->get()->getRowArray();
        if (count($builder) > 0) {
            $this->db->table('users')->where('token',$token)->update(array('is_verify'=>1,'token'=>''));
            return $builder;
        }else{
            return false;
        }
    }

    public function change_password($id,$password)
    {
    	return $this->db->table('users')->where('id',$id)->update(array('password'=>$password));
    }

}