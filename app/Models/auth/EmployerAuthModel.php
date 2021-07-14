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
                if ($result[0]['is_active'] == 1) {
                    $array = array('id' => $result[0]['id'], 'username' => $result[0]['firstname'], 'profile_completed' => $result[0]['profile_completed'], 'company_completed' => $result[0]['company_completed'], 'is_verify' => $result[0]['is_verify']);
                    return $array;
                }else
                    return 2;
            } else 
                return 0;
        } else {
            return 0;
        }
    }

    public function changepassword($id,$data)
    {
        $builder = $this->db->table('employers');
        $result = $builder->where('id',$id)->get()->getResultArray();
        $validPassword = password_verify($data['old_password'], $result[0]['password']);   
        if ($validPassword) {
            $this->db->table('employers')->where('id', $id)->update(array('password'=>$data['new_password']));
            return true;
        } else {
            return false;
        }     
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
        return $this->db->table('companies')->where('employer_id', $id)->update($cmp_info);
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
        $builder = $this->db->table('employers');
        $data = $builder->select('firstname,lastname,email')->where('password_reset_code', $id)->get()->getResultArray();
        $result = $builder->where('password_reset_code', $id)->update(array('password'=>$password,'password_reset_code'=>''));
        if($this->db->affectedRows() == 1)
            return array('status'=>1,'data'=>$data[0]);
        else
            return 0;
    }

    public function email_verification($token)
    {
        $builder = $this->db->table('employers')->where('token', $token)->get()->getRowArray();
        if (count($builder) > 0) {
            $this->db->table('employers')->where('token', $token)->update(array('is_verify'=>1,'token'=>''));
            return $builder;
        } else {
            return false;
        }
    }

    public function cmpy_cmpld($user_id)
    {
        return $this->db->table('employers')->where('id',$user_id)->update(array('company_completed' => 1));
    }
    
    public function delete_emp_cmpy()
    {   
        $lastid = $this->db->insertID();
        $del_emp = $this->db->table('employers')->where('id',$lastid)->delete();
        if($del_emp == 1)
            return $this->db->table('companies')->where('id',$lastid)->delete();
        else
            return 0;
    }
}
