<?php

namespace App\Models\auth;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = NULL;

    public function login_validate($username, $password)
    {
        $builder = $this->db->table('admin');
        $result = $builder->where(array('username' => $username))->get()->getResultArray();
        if (count($result) == 1) {
            if (password_verify($password, $result[0]['password'])) {
                $array = array('id' => $result[0]['id'], 'status' => $result[0]['status']);
                return $array;
            } else
                return 0;
        } else {
            return 0;
        }
    }

    public function register($data)
    {
        $builder = $this->db->table('admin');
        return $builder->insert($data);
    }

    public function deleteadmin($id)
    {
        $builder = $this->db->table('admin');
        $builder->where('id', $id);
        return $builder->delete();
    }

    public function getaccount($id)
    {
        $builder = $this->db->table('admin');
        return $builder->where('id', $id)->get()->getResultArray();
    }

    public function account($userdata, $id)
    {
        $builder = $this->db->table('admin');
        $update_row = [
            'username' => $userdata['username'],
            'email' => $userdata['email'],
            'firstname' => $userdata['firstname'],
            'lastname' => $userdata['lastname'],
            'mobile_no' => $userdata['mobile_no']
        ];
        $builder->where('id', $id);

        if ($query = $builder->update($update_row) == 1) {
            return $query;
        }
    }
    public function changepassword($password, $id)
    {
        $builder = $this->db->table('admin');
        $builder->where('id', $id);
        $builder->set('password', $password);
        if ($builder->update() == 1) {
            return true;
        }
    }
    public function showadmin()
    {
        $builder = $this->db->table('admin');
        $builder->orderBy('id', 'asc');
        $query = $builder->get()->getResultArray();
        return $query;
    }

    //============ Check User Email ============
    function check_user_mail($email)
    {
        $builder = $this->db->table('admin');
        $result = $builder->getWhere(array('email' => $email))->getRowArray();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    //============ Update Reset Code Function ===================
    public function update_reset_code($reset_code, $user_id)
    {
        $builder = $this->db->table('admin');
        $builder->where('id', $user_id);
        $builder->update(array('password_reset_code' => $reset_code));
    }

    //============ Reset Password ===================
    public function reset_password($id, $new_password)
    {
        $builder = $this->db->table('admin');
        $data = array(
            'password_reset_code' => '',
            'password' => $new_password
        );
        $builder->where('password_reset_code', $id);
        $builder->update($data);
        return true;
    }

    //============ Activation code for Password Reset Function ===================
    public function check_password_reset_code($code)
    {
        $builder = $this->db->table('admin');
        $result = $builder->getWhere(array('password_reset_code' => $code))->getResultArray();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
