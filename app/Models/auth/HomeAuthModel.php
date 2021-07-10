<?php
namespace App\Models\auth;

use CodeIgniter\Model;

class HomeAuthModel extends Model
{
    protected $table = null;

    public function login_validate($email, $password)
    {
        $builder = $this->db->table('users');
        $result = $builder->where(array('email' => $email))->get()->getResultArray();
        if (count($result) == 1) {
            if (password_verify($password, $result[0]['password'])) {
                if ($result[0]['is_active'] == 1) {
                    $array = array('id' => $result[0]['id'], 'username' => $result[0]['firstname'],'profile_completed' => $result[0]['profile_completed'],'is_verify' => $result[0]['is_verify']);
                    return $array;
                }else{
                    return 2;
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function facebook_validate($id, $name, $email, $profile_picture)
    {
        $builder = $this->db->table('users');
        $get_id = $builder->where('fb_id', $id)->get()->getResultArray();
        $result = $builder->where('email', $email)->get()->getResultArray();
        if (count($result) == 1) {
            return $result[0];
        } else {
            if (count($get_id) == 1) {
                return $get_id[0];
            } else {
                $names = explode(' ', $name);
                $this->db->table('users')->insert(array('fb_id'=> $id,'firstname'=>$names[0],'lastname'=>$names[1],'email'=> $email,'profile_picture'=>$profile_picture));
                $lastid = $this->db->insertID();
                $reg = $builder->where('id', $lastid)->get()->getResultArray();
                return $reg[0];
            }
        }
    }

    public function register($data)
    {
        $this->db->table('users')->insert($data);
        return $this->db->insertID();
    }

    public function email_verification($token)
    {
        $builder = $this->db->table('users')->where('token', $token)->get()->getRowArray();
        if (count($builder) > 0) {
            $this->db->table('users')->where('token', $token)->update(array('is_verify'=>1,'token'=>''));
            return $builder;
        } else {
            return false;
        }
    }

    public function change_password($id, $data)
    {
        $builder = $this->db->table('users');
        $result = $builder->where('id', $id)->get()->getResultArray();
        $validPassword = password_verify($data['old_password'], $result[0]['password']);
        if ($validPassword) {
            $this->db->table('users')->where('id', $id)->update(array('password'=>$data['password']));
            return true;
        } else {
            return false;
        }
    }

    public function check_email($email)
    {
        return $this->db->table('users')->where(array('email'=>$email))->get()->getResultArray();
    }

    public function update_reset_code($reset_code, $id)
    {
        $data = array('password_reset_code' => $reset_code);
        return $this->db->table('users')->where('id', $id)->update($data);
    }

    public function check_reset_code($reset_code)
    {
        return $this->db->table('users')->where('password_reset_code', $reset_code)->get()->getResultArray();
    }

    public function update_reset_password($password, $id)
    {
        return $this->db->table('users')->where('id', $id)->update(array('password'=>$password,'password_reset_code'=>''));
    }

    public function google_validate($id, $given_name, $family_name, $email, $picture)
    {
        $builder = $this->db->table('users');
        $get_id = $builder->where('google_id', $id)->get()->getResultArray();
        $result = $builder->where('email', $email)->get()->getResultArray();
        if (count($result) == 1) {
            return $result[0];
        } else {
            if (count($get_id) == 1) {
                return $get_id[0];
            } else {
                $this->db->table('users')->insert(array('google_id'=> $id,'firstname'=>$given_name,'lastname'=>$family_name,'email'=> $email,'profile_picture'=>$picture,'is_verify'=>1));
                $lastid = $this->db->insertID();
                $reg = $builder->where('id', $lastid)->get()->getResultArray();
                return $reg[0];
            }
        }
    }

    public function profile_completed($user_id)
    {
        return $this->db->table('users')->where('id',$user_id)->update(array('profile_completed'=>1));
    }
}
