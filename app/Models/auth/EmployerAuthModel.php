<?php
namespace App\Models\auth;
use CodeIgniter\Model;
class EmployerAuthModel extends Model
{
	protected $table = NULL;

	public function login_validate($email,$password)
    {
        $builder = $this->db->table('employers');
        $result = $builder->where(array('email' => $email ,'password' => $password ))->get()->getResultArray();
        if (count($result) == 1) {
           $array = array('id' => $result[0]['id'], 'username' => $result[0]['firstname']);
           return $array; 
        } else 
        {
            return 0;
        }
    }

    public function changepassword($id,$password)
    {
    	$builder = $this->db->table('employers');
    	$builder->where('id',$id);
        $builder->set('password' , $password);
        return $builder->update();
    }

}
?>