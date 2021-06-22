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
    	$builder = $this->db->table('employers');
    	$builder->where('id',$id);
        $builder->set('password' , $password);
        return $builder->update();
    }

    public function personal_info($id)
    {
        $builder = $this->db->table('employers');
        $builder->where('id',$id);
        return $builder->get()->getResultArray();
    }

    public function personal_info_update($update_info,$id){
        $builder = $this->db->table('employers');
        $update_info_row =[
            'firstname'=>$update_info['firstname'],
            'lastname' =>$update_info['lastname'],
            'email'=>$update_info['email'],
            'designation'=>$update_info['designation'],
            'mobile_no' =>$update_info['mobile_no'],
            'country'=>$update_info['country'],
            'state' =>$update_info['state'],
            'city'=>$update_info['city'],
            'profile_picture' =>$update_info['profile_picture'],
            'address'=>$update_info['address']
        ];
        $builder->where('id',$id);
        return $query=$builder->update($update_info_row);
    }
    
    public function cmp_info($id){
        $builder = $this->db->table('companies');
        return $builder->where('id',$id)->get()->getResultArray();
    }

    public function cmp_info_update($cmp_info,$id){
        $builder = $this->db->table('companies');
        $cmp_info_row =[
            'company_logo'=>$cmp_info['company_logo'],
            'company_name' =>$cmp_info['company_name'],
            'email'=>$cmp_info['email'],
            'phone_no'=>$cmp_info['phone_no'],
            'website' =>$cmp_info['website'],
            'category' =>$cmp_info['category'],
            'founded_date' =>$cmp_info['founded_date'],
            'org_type' =>$cmp_info['org_type'],
            'no_of_employers' =>$cmp_info['no_of_employers'],
            'description' =>$cmp_info['description'],
            'country'=>$cmp_info['country'],
            'state' =>$cmp_info['state'],
            'city'=>$cmp_info['city'],
            'postcode' =>$cmp_info['postcode'],
            'address'=>$cmp_info['address'],
            'facebook_link' =>$cmp_info['facebook_link'],
            'twitter_link'=>$cmp_info['twitter_link'],
            'youtube_link' =>$cmp_info['youtube_link'],
            'linkedin_link'=>$cmp_info['linkedin_link']
        ];
        $builder->where('id',$id);
        return $query=$builder->update($cmp_info_row);
    }

    public function getlastid()
    {
        $lastid = $this->db->query('SELECT MAX(id) as max_id FROM employers')->getResult();
        return $lastid;
    }

    public function register($data)
    {
        $this->db->table('employers')->insert($data);
        return $this->getlastid();
    }

    public function registercmpny($data)
    {
        return $this->db->table('companies')->insert($data);
    }
}
