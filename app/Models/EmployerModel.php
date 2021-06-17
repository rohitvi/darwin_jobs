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
}