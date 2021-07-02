<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Datatable;

class AdminModel extends Model
{
    protected $table = NULL;

    // Dashboard
    public function get_all_users()
    {
        $builder = $this->db->table('users');
        return $builder->countAll();
    }
    public function get_active_users()
    {
        $builder = $this->db->table('users');
        $builder->where('is_active', 1);
        return $builder->countAll();
    }
    public function get_deactive_users()
    {
        $builder = $this->db->table('users');
        $builder->where('is_active', 0);
        return $builder->countAll();
    }

    public function get_all_employers()
    {
        $builder = $this->db->table('employers');
        return $builder->countAll();
    }
    public function get_active_employers()
    {
        $builder = $this->db->table('employers');
        $builder->where('is_active', 1);
        return $builder->countAll();
    }
    public function get_deactive_employers()
    {
        $builder = $this->db->table('employers');
        $builder->where('is_active', 0);
        return $builder->countAll();
    }

    public function get_latest_users()
    {
        $builder = $this->db->table('users');
        $builder->orderBy('created_date', 'desc');
        $builder->limit(10, 0);
        return $builder->get()->getResultArray();
    }

    public function get_latest_jobs()
    {
        $builder = $this->db->table('job_post');
        $builder->select('job_post.*,companies.company_name')->join('companies', 'companies.id = job_post.company_id')->orderBy('job_post.created_date', 'desc')->limit(10, 0);
        return $builder->get()->getResultArray();
    }


    //===================Category Model Start==============================================================
    public function get_all_categories()
    {
        return $this->db->table('categories')->get()->getResultArray();
    }

    public function add_category($addcategorydata)
    {
        $builder = $this->db->table('categories');
        return $query = $builder->insert($addcategorydata);
    }

    public function get_category_by_id($id)
    {
        $builder = $this->db->table('categories');
        return $builder->where('id', $id)->get()->getResultArray();
    }

    public function edit_category($editrow, $id)
    {
        $builder = $this->db->table('categories');
        $update_row = [
            'name' => $editrow['name'],
            'slug' => $editrow['slug']
        ];
        $builder->where('id', $id);
        return $query = $builder->update($update_row);
    }

    public function del_category($id)
    {
        $builder = $this->db->table('categories');
        $builder->where('id', $id);
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

    public function get_industry_by_id($id)
    {
        $builder = $this->db->table('industries');
        return $builder->where('id', $id)->get()->getResultArray();
    }

    public function edit_industry($editrow, $id)
    {
        $builder = $this->db->table('industries');
        $update_row = [
            'name' => $editrow['name'],
            'slug' => $editrow['slug']
        ];
        $builder->where('id', $id);
        return $query = $builder->update($update_row);
    }

    public function del_industry($id)
    {
        $builder = $this->db->table('industries');
        $builder->where('id', $id);
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

    public function get_packages_by_id($id)
    {
        $builder = $this->db->table('packages');
        return $builder->where('id', $id)->get()->getResultArray();
    }

    public function edit_packages($editrow, $id)
    {
        $builder = $this->db->table('packages');
        $update_row = [
            'title' => $editrow['title'],
            'slug' => $editrow['slug'],
            'price' => $editrow['price'],
            'detail' => $editrow['detail'],
            'no_of_days' => $editrow['no_of_days'],
            'no_of_posts' => $editrow['no_of_posts'],
            'sort_order' => $editrow['sort_order'],
            'is_active' => $editrow['is_active']
        ];
        $builder->where('id', $id);
        return $query = $builder->update($update_row);
    }
    //====Packers Model End========================newsletters Model start=================================
    public function get_all_newsletters()
    {
        return $this->db->table('subscribers')->get()->getResultArray();
    }

    public function del_newsletters($id)
    {
        return $this->db->table('subscribers')->where('id', $id)->delete();
    }
    //====newsletters Model End========================contactus Model start=================================
    public function get_all_contactus()
    {
        return $this->db->table('contact_us')->get()->getResultArray();
    }

    public function del_contactus($id)
    {
        return $this->db->table('contact_us')->where('id', $id)->delete();
    }


    public function get_countries_list()
    {
        return $this->db->table('countries')->get()->getResultArray();
    }

	// Get Categories
    function get_categories_list()
    {
       return $this->db->table('categories')->orderBy('name')->get()->getResultArray();
    }

    public function get_states_list($id)
    {
        return $this->db->table('states')->where('country_id', $id)->get()->getResultArray();
    }

    public function get_cities_list($id)
    {
        return $this->db->table('cities')->where('state_id', $id)->get()->getResultArray();
    }

    // employer part

    public function getemployer()
    {
        $builder = $this->db->table('employers');
        $builder->select('*');
        return $builder->join('companies', 'companies.employer_id = employers.id')->orderBy('employers.id', 'ASC')->get()->getResultArray();
    }

    public function insertemployer($emp)
    {
        $builder = $this->db->table('employers')->insert($emp);
        return $this->db->insertID();
    }

    public function insertcmpny($cmpny)
    {
        return $this->db->table('companies')->insert($cmpny);
    }

    public function editemployer($id)
    {
        $builder = $this->db->table('employers');
        $builder->select('companies.city as ccity,companies.state as cstate,companies.country as ccountry,employers.country as ecountry,employers.state as estate,employers.city as eccity,employers.address as eaddress,companies.address as caddress,employers.email as eemail, companies.email as cemail,employers.*,companies.*');
        $builder->join('companies', 'companies.employer_id = employers.id');
        return $builder->where('employers.id', $id)->get()->getResultArray();
    }

    public function updateemployer($userdata, $id)
    {
        $builder = $this->db->table('employers');
        $update_row = [
            'firstname' => $userdata['firstname'],
            'lastname' => $userdata['lastname'],
            'email' => $userdata['email'],
            'designation' => $userdata['designation'],
            'mobile_no' => $userdata['mobile_no'],
            'country' => $userdata['country'],
            'state' => $userdata['state'],
            'city' => $userdata['city'],
            'address' => $userdata['address']
        ];
        $builder->where('id', $id);
        if ($query = $builder->update($update_row) == 1) {
            return $query;
        }
    }

    public function updatecompany($id, $data)
    {
        $builder = $this->db->table('companies');
        $update_row = [
            'company_logo' => $data['company_logo'],
            'company_name' => $data['company_name'],
            'email' => $data['company_email'],
            'phone_no' => $data['phone_no'],
            'website' => $data['website'],
            'category' => $data['category'],
            'founded_date' => $data['founded_date'],
            'no_of_employers' => $data['no_of_employers'],
            'description' => $data['description'],
            'country' => $data['country'],
            'state' => $data['state'],
            'city' => $data['city'],
            'postcode' => $data['postcode'],
            'address' => $data['full_address'],
            'facebook_link' => $data['facebook_link'],
            'twitter_link' => $data['twitter_link'],
            'youtube_link' => $data['youtube_link'],
            'linkedin_link' => $data['linkedin_link'],
        ];
        $builder->where('id', $id);
        if ($query = $builder->update($update_row) == 1) {
            return $query;
        }
    }

    public function payment()
    {
        $builder = $this->db->table('payments');
        $builder->select('*');
        return $builder->join('packages', 'packages.id = purchased_plan')->get()->getResultArray();
    }

    public function deleteemployer($id)
    {
        $builder = $this->db->table('employers');
        $builder->where('id', $id);
        if ($builder->delete()) {
            $builder = $this->db->table('companies');
            $builder->where('employer_id', $id);
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
        return $this->db->table('users')->where('id', $id)->get()->getResultArray();
    }

    public function updateuser($id, $data)
    {
        $update_row = [
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'mobile_no' => $data['mobile_no'],
            'is_active' => $data['is_active']
        ];
        $builder = $this->db->table('users');
        return $builder->where('id', $id)->update($update_row);
    }

    public function deleteuser($id)
    {
        return $this->db->table('users')->where('id', $id)->delete();
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
        return $this->db->table('job_type')->where('id', $id)->get()->getResultArray();
    }

    public function updatejob($id, $data)
    {
        $update_row = [
            'type' => $data['type']
        ];
        $builder = $this->db->table('job_type');
        return $builder->where('id', $id)->update($update_row);
    }

    public function deletejob($id)
    {
        return $this->db->table('job_type')->where('id', $id)->delete();
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
        return $this->db->table('education')->where('id', $id)->get()->getResultArray();
    }

    public function updateeducation($id, $data)
    {
        $update_row = [
            'type' => $data['type']
        ];
        $builder = $this->db->table('education');
        return $builder->where('id', $id)->update($update_row);
    }

    public function deleteeducation($id)
    {
        return $this->db->table('education')->where('id', $id)->delete();
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
        return $this->db->table('employment')->where('id', $id)->get()->getResultArray();
    }

    public function updateemployment($id, $data)
    {
        $update_row = [
            'type' => $data['type']
        ];
        $builder = $this->db->table('employment');
        return $builder->where('id', $id)->update($update_row);
    }

    public function deleteemployment($id)
    {
        return $this->db->table('employment')->where('id', $id)->delete();
    }

    public function GetAllJobs()
    {
        $this->datatable = new Datatable();
        $wh = array();

        if (session('job_search_industry') != '')
            $wh[] = " job_post.industry = '" . session('job_search_industry') . "'";
        if (session('job_search_category') != '')
            $wh[] = " job_post.category = '" . session('job_search_category') . "'";
        if (session('job_search_location') != '')
            $wh[] = " job_post.country = '" . session('job_search_location') . "'";

        if (session('job_search_from') != '')
            $wh[] = " job_post.created_date >= '" . date('Y-m-d', strtotime(session('job_search_from'))) . "'";
        if (session('job_search_to') != '')
            $wh[] = " job_post.created_date <= '" . date('Y-m-d', strtotime(session('job_search_to'))) . "'";

        $SQL = 'SELECT
				job_post.*, 
				Count(seeker_applied_job.seeker_id) as cand_applied, 
				SUM(CASE WHEN seeker_applied_job.is_shortlisted > 0 THEN 1 ELSE 0 END) as total_shortlisted,
				SUM(CASE WHEN seeker_applied_job.is_interviewed > 0 THEN 1 ELSE 0 END) as total_interviewed
				FROM
				  job_post left Join  seeker_applied_job 
				  On seeker_applied_job.job_id = job_post.id';

        $GROUP_BY = ' GROUP BY job_post.id ';

        if (count($wh) > 0) {
            $WHERE = implode(' and ', $wh);
            return $this->datatable->LoadJson($SQL, $WHERE, $GROUP_BY);
        } else {
            return $this->datatable->LoadJson($SQL, '', $GROUP_BY);
        }
    }

    // Add new Job
    public function add_job($data)
    {
        $builder = $this->db->table('job_post');
        return $builder->insert($data);
    }

    // Edit Job
    public function edit_job($data, $job_id)
    {
        $builder = $this->db->table('job_post');
        $builder->where('id', $job_id);
        if ($builder->update($data))
            return true;
        else
            return false;
    }

    // Get job by ID
    public function get_job_by_id($job_id)
    {
        $builder = $this->db->table('job_post');
        return $builder->getWhere(array('id' => $job_id))->getRowArray();
        // return $query->getRowArray();
    }

    // Get Shortlisted candidates
    public function get_shortlisted_applicants($job_id)
    {
        $builder = $this->db->table('seeker_applied_job');

        $builder->select('seeker_applied_job.id, 
			seeker_applied_job.applied_date as apply_date,
			users.firstname, users.lastname,
			users.email,
			users.profile_picture,
			users.city,
			users.country,
			users.category,
			users.job_title,
			users.current_salary,
			users.resume,
			seeker_applied_job.*');
        $builder->join('users', 'users.id = seeker_applied_job.seeker_id', 'left');
        $builder->where(' seeker_applied_job.job_id', $job_id);
        $builder->where(' seeker_applied_job.is_shortlisted', 1);
        $builder->orderBy("seeker_applied_job.applied_date", "DESC");
        return $builder->get()->getResultArray();
    }

    public function get_applicants($job_id)
    {
        $builder = $this->db->table('seeker_applied_job');
        $builder->select('seeker_applied_job.id,
			seeker_applied_job.job_id,
			seeker_applied_job.applied_date as apply_date, 
			users.firstname, 
			users.lastname, 
			users.job_title, 
			users.email,
			users.profile_picture,
			users.category,
			users.city,   
			users.country, 
			users.resume,
			seeker_applied_job.*');
        $builder->join('users', 'users.id = seeker_applied_job.seeker_id', 'left');
        $builder->where(' seeker_applied_job.job_id', $job_id);
        $builder->orderBy("seeker_applied_job.applied_date", "DESC");
        return $builder->get()->getResultArray();
    }

    // Shortlist
    public function do_shortlist($id)
    {
        $builder = $this->db->table('seeker_applied_job');
        $builder->where('id', $id);
        if ($builder->update(array('is_shortlisted' => 1)))
            return true;
        else
            return false;
    }

    public function update_general_settings($data)
    {
        $builder = $this->db->table('general_settings');
        return $builder->where('id', 1)->update($data);
    }

    public function fetch_general_setting()
    {

        $builder = $this->db->table('general_settings');
        return $builder->where('id', 1)->get()->getRowArray();
    }

    public function get_footer_settings()
    {
        return $this->db->table('footer_settings')->get()->getResultArray();
    }

    public function update_footer_setting($footerdata)
    {

        $builder = $this->db->table('footer_settings');
        return $query = $builder->insert($footerdata);
    }

	//----------------------------------------------------
	public function delete_footer_all_setting()
	{
        $builder = $this->db->table('footer_settings');
		$builder->truncate();
		return true;
	}

    // Short listed candidate email
    public function get_applied_candidate_email($id)
    {
        $builder = $this->db->table('seeker_applied_job');
        $builder->select('seeker_applied_job.seeker_id,users.email');
        $builder->join('users', 'users.id = seeker_applied_job.seeker_id');
        $builder->where('seeker_applied_job.id', $id);
        return $builder->get()->getRowArray()['email'];
    }

    public function get_subscribers($ids)
    {
        $builder = $this->db->table('subscribers');
        if ($ids != 'all' ) {
            $builder->whereIn('id',explode(',',$ids));
        }

        $result = $builder->get()->getResultArray();
        return array_column($result, 'email');
    }
}
