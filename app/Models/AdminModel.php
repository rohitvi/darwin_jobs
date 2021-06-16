<?php
namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model
 {
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
//====Packers Model End========================newsletters Model start=================================
    public function get_all_newsletters(){
       return $this->db->table('subscribers')->get()->getResultArray();
    }

    public function del_newsletters($id){
        return $this->db->table('subscribers')->where('id',$id)->delete();
    }
//====newsletters Model End========================contactus Model start=================================
    public function get_all_contactus(){
        return $this->db->table('contact_us')->get()->getResultArray();
    }

    public function del_contactus($id){
        return $this->db->table('contact_us')->where('id',$id)->delete();
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
    
    public function updatecompany($id,$data)
    {
        $builder = $this->db->table('companies');
        $update_row = [
            'company_logo'=> $data['company_logo'],
            'company_name'=> $data['company_name'],
            'email'=> $data['company_email'],
            'phone_no'=> $data['phone_no'],
            'website'=> $data['website'],
            'category'=> $data['category'],
            'founded_date'=> $data['founded_date'],
            'no_of_employers'=> $data['no_of_employers'],
            'description'=> $data['description'],
            'country'=> $data['country'],
            'state'=> $data['state'],
            'city'=> $data['city'],
            'postcode'=> $data['postcode'],
            'address'=> $data['full_address'],
            'facebook_link'=> $data['facebook_link'],
            'twitter_link'=> $data['twitter_link'],
            'youtube_link'=> $data['youtube_link'],
            'linkedin_link'=> $data['linkedin_link'],
        ];
        $builder->where('id',$id);
        if ($query = $builder->update($update_row) == 1) {
            return $query;
        }
    }

    public function payment()
    {
        $builder = $this->db->table('payments');
        $builder->select('*');
        return $builder->join('packages','packages.id = purchased_plan')->get()->getResultArray();
    }

    public function deleteemployer($id)
    {
        $builder = $this->db->table('employers');
        $builder->where('id',$id);
        if($builder->delete()){
            $builder = $this->db->table('companies');
            $builder->where('employer_id',$id);
            return $builder->delete();
        }
    }

    // Get the Salary Offered Dropdown
    public function get_salary_list()
    {
        $builder = $this->db->table('expected_salary');
        return $builder->get()->getResultArray();
    }

    // Get the Education Status Dropdown
    public function get_education_list()
    {
        $builder = $this->db->table('education');
        return $builder->get()->getResultArray();
    }

    public function users()
    {
        return $this->db->table('users')->get()->getResultArray();
    }

    public function adduser($data)
    {
        $builder = $this->db->table('users');
        return $builder->insert($data);
    }

    public function edituser($id)
    {
        return $this->db->table('users')->where('id',$id)->get()->getResultArray();
    }

    public function updateuser($id,$data){
        $update_row =[
            'firstname'=>$data['firstname'],
            'lastname' => $data['lastname'],
            'email'=>$data['email'],
            'mobile_no' => $data['mobile_no'],
            'is_active'=>$data['is_active']
        ];
        $builder = $this->db->table('users');
        return $builder->where('id',$id)->update($update_row);
    }

    public function deleteuser($id)
    {
        return $this->db->table('users')->where('id',$id)->delete();
    }

    public function get_job_type()
    {
        return $this->db->table('job_type')->get()->getResultArray();
    }

    public function addjob($data)
    {
        $builder = $this->db->table('job_type');
        return $builder->insert($data);
    }

    public function editjob($id)
    {
        return $this->db->table('job_type')->where('id',$id)->get()->getResultArray();
    }

    public function updatejob($id,$data)
    {
        $update_row =[
            'type'=>$data['type']
        ];
        $builder = $this->db->table('job_type');
        return $builder->where('id',$id)->update($update_row);
    }

    public function deletejob($id)
    {
        return $this->db->table('job_type')->where('id',$id)->delete();
    }

    public function education()
    {
        return $this->db->table('education')->get()->getResultArray();
    }

    public function addeducation($data)
    {
        return $this->db->table('education')->insert($data);
    }

    public function editeducation($id)
    {
        return $this->db->table('education')->where('id',$id)->get()->getResultArray();
    }

    public function updateeducation($id,$data)
    {
        $update_row =[
            'type'=>$data['type']
        ];
        $builder = $this->db->table('education');
        return $builder->where('id',$id)->update($update_row);
    }

    public function deleteeducation($id)
    {
        return $this->db->table('education')->where('id',$id)->delete();
    }

    public function employment()
    {
        return $this->db->table('employment')->get()->getResultArray();
    }

    public function addemployment($data)
    {
        return $this->db->table('employment')->insert($data);
    }

    public function editemployment($id)
    {
        return $this->db->table('employment')->where('id',$id)->get()->getResultArray();
    }

    public function updateemployment($id,$data)
    {
        $update_row =[
            'type'=>$data['type']
        ];
        $builder = $this->db->table('employment');
        return $builder->where('id',$id)->update($update_row);
    }

    public function deleteemployment($id)
    {
        return $this->db->table('employment')->where('id',$id)->delete();
    }

    // Add new Job
    public function add_job($data)
    {
        $builder = $this->db->table('job_post');
        return $builder->insert($data);
    }

}