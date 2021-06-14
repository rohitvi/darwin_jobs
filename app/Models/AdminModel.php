<?php
namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model
 {
    // protected $table      = 'categories';
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['name', 'slug', 'status', 'top_category'];
    // protected $deletedField  = 'deleted_at';

    protected $table = NULL;

    public function test()
    {
        $builder = $this->db->table( 'admin' );
        $builder->orderBy( 'id', 'desc' );
        $result = $builder->get()->getResultArray();
        return $result;
    }
//===================Category Model Start==============================================================
    public function get_all_categories() 
    {
        // $result = $this->db->table( 'categories' )->get();
        return $this->db->table( 'categories' )->get()->getResultArray();
    }

    public function add_category($addcategorydata)
    {
        $builder = $this->db->table('categories');
        return $query = $builder->insert($addcategorydata);
    } 

    public function get_category_by_id($id) 
    {
        $builder = $this->db->table('categories');
		return $builder->where('id',$id)->get()->getResultArray();
    }

    public function edit_category($editrow,$id) 
    {
        $builder = $this->db->table('categories');
        $update_row =[
            'name'=>$editrow['name'],
            'slug' => $editrow['slug']
        ];
        $builder->where('id',$id);
        return $query=$builder->update($update_row);
    }

    public function del_category($id)
    {
        $builder = $this->db->table('categories');
        $builder->where('id',$id);
        return $query = $builder->delete();
    }
//====Category Model End========================Industry Model start=================================

    public function get_all_industry()
    {
      // return $this->db->table('industries')->get()->getResultArray();
      $builder = $this->db->table('industries');
      return $builder->get()->getResultArray();
    }

    public function add_industry($addindustrydata)
    {
        $builder = $this->db->table('industries');  
        return $query = $builder->insert($addindustrydata);
    }

	public function get_industry_by_id($id){
        $builder = $this->db->table('industries');
		return $builder->where('id',$id)->get()->getResultArray();
	}
    
    public function edit_industry($editrow,$id) 
    {
        $builder = $this->db->table('industries');
        $update_row =[
            'name'=>$editrow['name'],
            'slug' => $editrow['slug']
        ];
        $builder->where('id',$id);
        return $query=$builder->update($update_row);
    }

    public function del_industry($id)
    {
        $builder = $this->db->table('industries');
        $builder->where('id',$id);
        return $query = $builder->delete();
    }
//====Industry Model End========================Packers Model start=================================

    public function get_all_packages()
    {
    $builder = $this->db->table('packages');
    return $builder->get()->getResultArray();
    }

    public function add_packages($addpackage)
    {
    $builder = $this->db->table('packages');  
    return $query = $builder->insert($addpackage);
    }

    public function get_packages_by_id($id){
        $builder = $this->db->table('packages');
		return $builder->where('id',$id)->get()->getResultArray();
	}

    public function edit_packages($editrow,$id) 
    {
        $builder = $this->db->table('packages');
        $update_row =[
            'title'=>$editrow['title'],
            'slug' => $editrow['slug'],
            'price'=>$editrow['price'],
            'detail' => $editrow['detail'],
            'no_of_days'=>$editrow['no_of_days'],
            'no_of_posts' => $editrow['no_of_posts'],
            'sort_order' => $editrow['sort_order'],
            'is_active' => $editrow['is_active']
        ];
        $builder->where('id',$id);
        return $query=$builder->update($update_row);
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