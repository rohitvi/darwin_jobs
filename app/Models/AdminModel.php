<?php
namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model
 {
    // protected $table      = 'categories';
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['name', 'slug', 'status', 'top_category'];
    // protected $deletedField  = 'deleted_at';

    //protected $table = NULL;

    public function test()
    {
        $builder = $this->db->table( 'admin' );
        $builder->orderBy( 'id', 'desc' );
        $result = $builder->get()->getResultArray();
        return $result;
    }

    public function get_all_categories() 
    {
        // $result = $this->db->table( 'categories' )->get();
        return $this->db->table( 'categories' )->get()->getResultArray();
    }

    public function get_row_category( $id ) 
    {
        return $this->where( 'id', $id )->first();
    }

    public function get_all_industry()
    {
      // return $this->db->table('industries')->get()->getResultArray();
      //$builder = $this->db->table('industries');
      return $builder->get()->getResultArray();

    }

    public function get_countries_list() 
    {
        return $this->db->table( 'countries' )->get()->getResultArray();
    }

    public function get_states_list($id) 
    {
        return $this->db->table( 'states' )->where('country_id',$id)->get()->getResultArray();
    }

    public function get_cities_list($id) 
    {
        return $this->db->table( 'cities' )->where('state_id',$id)->get()->getResultArray();
    }

    // employer part

    public function getemployer()
    {
        $builder = $this->db->table('employers');
        $builder->select('*');
        return $builder->join('companies','companies.employer_id = employers.id')->orderBy('employers.id', 'ASC')->get()->getResultArray();
    }

    public function last_id()
    {
        $lastid = $this->db->query('SELECT MAX(id) as max_id FROM employers')->getResult();
        return $lastid;
    }

    public function insertemployer($emp)
    {
        $builder = $this->db->table('employers')->insert($emp);
        $last_id = $this->last_id();
        return $last_id;
    }

    public function insertcmpny($cmpny)
    {
        return $this->db->table('companies')->insert($cmpny);
    }

    public function editemployer($id)
    {
        $builder = $this->db->table('employers');
        $builder->join('companies' ,'companies.employer_id = employers.id');
        return $builder->where('employers.id',$id)->get()->getResultArray();
    }

    public function updateemployer($userdata,$id)
    {
        $builder = $this->db->table('employers');
        $update_row = [
            'firstname'=> $userdata['firstname'],
            'lastname' => $userdata['lastname'],
            'email' => $userdata['email'],
            'designation'=> $userdata['designation'],
            'mobile_no'=> $userdata['mobile_no'],
            'country' => $userdata['country'],
            'state' => $userdata['state'],
            'city' => $userdata['city'],
            'address' => $userdata['address']
        ];
        $builder->where('id', $id );
        if ($query = $builder->update($update_row) == 1) {
            return $query;
        }
    }

    public function updatecompany($id)
    {
        return $id;
    }
}