<?php
namespace App\Models\auth;
use CodeIgniter\Model;
class EmployerAuthModel extends Model
{
	protected $table = NULL;

	public function login_validate($email,$password)
    {
        $builder = $this->db->table('employers');
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

    public function changepassword($id,$password)
    {
    	return $this->db->table('employers')->where('id',$id)->update(array('password'=>$password));
    }

    public function personal_info($id)
    {
        $builder = $this->db->table('employers');
        $builder->where('id',$id);
        return $builder->get()->getResultArray();
    }

    public function personal_info_update($update_info,$id){
        return $this->db->table('employers')->where('id', $id)->update($update_info);
    }
    
    public function cmp_info($id){
        $builder = $this->db->table('companies');
        return $builder->where('employer_id',$id)->get()->getResultArray();
    }

    public function cmp_info_update($cmp_info,$id){
        return $this->db->table('companies')->where('id', $id)->update($cmp_info);
    }

    public function getlastid()
    {
        $lastid = $this->db->query('SELECT MAX(id) as max_id FROM employers')->getResult();
        return $lastid;
    }

    public function register($data)
    {
        $this->db->table('employers')->insert($data);
        return $this->db->insertID();
    }

    public function registercmpny($data)
    {
        return $this->db->table('companies')->insert($data);
    }

    public function check_email($email)
    {
        return $this->db->table('employers')->where(array('email'=>$email))->get()->getResultArray();
    }

    public function update_reset_code($reset_code,$id)
    {
        $data = array('password_reset_code' => $reset_code);
        return $this->db->table('employers')->where('id',$id)->update($data);
    }

    public function check_reset_code($reset_code)
    {
        return $this->db->table('employers')->where('password_reset_code',$reset_code)->get()->getResultArray();
    }

    public function update_reset_password($password,$id)
    {
        return $this->db->table('employers')->where('id',$id)->update(array('password'=>$password));
    }
}
