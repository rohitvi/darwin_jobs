<?php
namespace App\Models;
use CodeIgniter\Model;

class EmployerModel extends Model
 {
    protected $table = NULL;

    public function getpackages()
    {
      return $this->db->table('packages')->get()->getResultArray();
    }

    public function package_confirmation($id)
    {
      return $this->db->table('packages')->where('id',$id)->get()->getResultArray();
    }

    public function last_payment_details()
    {
      $query = $this->db->query('SELECT * from payments');
      $row = $query->getLastRow('array');
      return $row;
    }

    public function payment($data)
    {
      $builder = $this->db->table('payments')->insert($data);
      $result['pay_data'] = $this->last_payment_details();
      if (count($result) == 1) {
        $array = array('status'=>1,'payment_id'=>$result['pay_data']['id'],'employer_id'=>$result['pay_data']['employer_id']);
        return $array;
      }else{
        return 0;
      }
    }

    public function packages_bought($data)
    {
      return $this->db->table('packages_bought')->insert($data);
    }

    public function mypackages($id)
    {
      return $this->db->table('packages_bought')->select('*')->join('packages','packages.id = packages_bought.package_id')->where('employer_id',$id)->get()->getResultArray();
    }

    public function mypackagedetails($id)
    {
      return $this->db->table('packages_bought')->select('*')->join('packages','packages.id = packages_bought.package_id')->where('payment_id',$id)->get()->getResultArray();
    }

    public function shortlisted($id)
    {
      return $this->db->table('cv_shortlisted')->select('*')->join('users','users.id = cv_shortlisted.user_id')->where('cv_shortlisted.employer_id',$id)->get()->getResultArray();
    } 

    public function get_countries_list() 
    {
        return $this->db->table( 'countries' )->get()->getResultArray();
    }
    public function userdetails($id)
    {
        return $this->db->table('users')->where('id',$id)->get()->getResultArray();
    }
    public function get_seeker_education($id)
    {
      return $this->db->table('seeker_education')->select('*')->join('education','education.id = seeker_education.degree')->where('user_id',$id)->get()->getResultArray();
    }
    public function get_user_experience($id)
    {
      return $this->db->table('seeker_experience')->where('user_id',$id)->get()->getResultArray();
    }
    public function get_user_language($id)
    {
      return $this->db->table('seeker_languages')->select('*')->join('languages','languages.lang_id = seeker_languages.language')->where('user_id',$id)->get()->getResultArray();
    }
    public function get_education()
    {
      return $this->db->table('education')->get()->getResultArray();
    }

    public function get_companies()
    {
      return $this->db->table('companies')->get()->getResultArray();
    }

    public function postjob($data)
    {
      return $this->db->table('job_post')->insert($data);
    }
}