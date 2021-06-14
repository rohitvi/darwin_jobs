<?php
namespace App\Models\auth;
use CodeIgniter\Model;
class AuthModel extends Model
{
    protected $table = NULL;

    public function login_validate($username,$password)
    {
        $builder = $this->db->table('admin');
        $result = $builder->where(array('username' => $username ,'password' => $password ))->get()->getResultArray();
        if (count($result) == 1) {
           $array = array('id' => $result[0]['id']);
           return $array; 
        } else 
        {
            return 0;
        }
    }
    public function account($userdata,$id)
    {
        $builder = $this->db->table('admin');
        $update_row = [
            'username'=>$userdata['username'],
            'email' => $userdata['email'],
            'firstname'=>$userdata['firstname'],
            'lastname'=>$userdata['lastname'],
            'mobile_no'=>$userdata['mobile_no']
        ];
        $builder->where('id', $id );
        
        if ($builder->update($update_row) == 1)
        {
            echo 'done';
        }
    }
    public function changepassword($password,$id)
    {
        $builder = $this->db->table('admin');
        $builder->where('id',$id);
        $builder->set('password' , $password);
        if ( $builder->update() == 1)
        {
            return true;
        }
    }
    public function showadmin()
    {
        $builder = $this->db->table('admin');
        $builder->orderBy( 'id', 'asc' );
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function registeradmin($userdata)
    {
        $builder = $this->db->table('admin');
        $query = $builder->insert($userdata);
        return $query;
    } 

    public function editadmin($id)
    {
        $builder = $this->db->table('admin');
        $query = $builder->where('id',$id)->get()->getResultArray();
        return $query;
    }

    public function updateadmin($id,$data)
    {
        $builder = $this->db->table('admin');
        $update_row = [
            'username'=>$data['username'],
            'email' => $data['email'],
            'firstname'=>$data['firstname'],
            'lastname'=>$data['lastname'],
            'mobile_no'=>$data['mobile_no']
        ];
        $builder->where('id', $id );
        
        if ($query = $builder->update($update_row) == 1)
        {
            return $query;
        }
    }

    public function deleteadmin($id)
    {
        $builder = $this->db->table('admin');
        $builder->where('id',$id);
        $query = $builder->delete();
        return $query;
    }
}