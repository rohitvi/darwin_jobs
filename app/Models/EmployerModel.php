<?php
namespace App\Models;

use App\Libraries\Datatable;
use CodeIgniter\Model;

class EmployerModel extends Model
{
    protected $table = null;

    public function getpackages()
    {
        return $this->db->table('packages')->get()->getResultArray();
    }

    public function package_confirmation($id)
    {
        return $this->db->table('packages')->where('id', $id)->get()->getResultArray();
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
            $array = array('status' => 1, 'payment_id' => $result['pay_data']['id'], 'employer_id' => $result['pay_data']['employer_id']);
            return $array;
        } else {
            return 0;
        }
    }

    public function packages_bought($data)
    {
        return $this->db->table('packages_bought')->insert($data);
    }

    public function mypackages($id)
    {
        return $this->db->table('packages_bought')->select('*')->join('packages', 'packages.id = packages_bought.package_id')->where('employer_id', $id)->get()->getResultArray();
    }

    public function mypackagedetails($id)
    {
        return $this->db->table('packages_bought')->select('*')->join('packages', 'packages.id = packages_bought.package_id')->where('payment_id', $id)->get()->getResultArray();
    }

    public function shortlisted($id)
    {
        return $this->db->table('cv_shortlisted')->select('*')->join('users', 'users.id = cv_shortlisted.user_id')->where('cv_shortlisted.employer_id', $id)->get()->getResultArray();
    }

    public function get_countries_list()
    {
        return $this->db->table('countries')->get()->getResultArray();
    }
    public function userdetails($id)
    {
        return $this->db->table('users')->where('id', $id)->get()->getResultArray();
    }
    public function get_seeker_education($id)
    {
        return $this->db->table('seeker_education')->select('*')->join('education', 'education.id = seeker_education.degree')->where('user_id', $id)->get()->getResultArray();
    }
    public function get_user_experience($id)
    {
        return $this->db->table('seeker_experience')->where('user_id', $id)->get()->getResultArray();
    }
    public function get_user_language($id)
    {
        return $this->db->table('seeker_languages')->select('*')->join('languages', 'languages.lang_id = seeker_languages.language')->where('user_id', $id)->get()->getResultArray();
    }
    public function get_education()
    {
        return $this->db->table('education')->get()->getResultArray();
    }

    public function get_companies($id)
    {
        return $this->db->table('companies')->where('id', $id)->get()->getResultArray();
    }

    public function postjob($data)
    {
        return $this->db->table('job_post')->insert($data);
    }

    // public function list_jobs($id)
    // {
    //   return $this->db->table('job_post')->where('employer_id',$id)->get()->getResultArray();
    // }

    public function list_jobs()
    {
        $this->datatable = new Datatable();
        $wh = array();

        if (session('job_search_industry') != '') {
            $wh[] = " job_post.industry = '" . session('job_search_industry') . "'";
        }

        if (session('job_search_category') != '') {
            $wh[] = " job_post.category = '" . session('job_search_category') . "'";
        }

        if (session('job_search_location') != '') {
            $wh[] = " job_post.country = '" . session('job_search_location') . "'";
        }

        if (session('job_search_from') != '') {
            $wh[] = " job_post.created_date >= '" . date('Y-m-d', strtotime(session('job_search_from'))) . "'";
        }

        if (session('job_search_to') != '') {
            $wh[] = " job_post.created_date <= '" . date('Y-m-d', strtotime(session('job_search_to'))) . "'";
        }

        $wh[] = " job_post.employer_id ='" . session('employer_id') . "'";

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

    public function edit_job($id)
    {
        return $this->db->table('job_post')->where('id', $id)->get()->getResultArray();
    }

    public function updatejob($id, $data)
    {
        return $this->db->table('job_post')->where('id', $id)->update($data);
    }

    public function delete_job($id)
    {
        return $this->db->table('job_post')->where('id', $id)->delete();
    }

    public function get_applicants($job_id)
    {
        $array = array('seeker_applied_job.job_id' => $job_id, 'employer_id' => session('employer_id'));
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
        $builder->where($array);
        $builder->orderBy("seeker_applied_job.applied_date", "DESC");
        return $builder->get()->getResultArray();
    }

    public function do_shortlist($id)
    {
        $builder = $this->db->table('seeker_applied_job');
        $builder->where('id', $id);
        if ($builder->update(array('is_shortlisted' => 1))) {
            return true;
        } else {
            return false;
        }

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

    //-------------------------------------------------------------------
    // All CV Search Result
    public function get_user_profiles($search)
    {
        $builder = $this->db->table('users');

        // search URI parameters
        if (!empty($search['country'])) {
            $builder->where('country', $search['country']);
        }

        if (!empty($search['category'])) {
            $builder->where('category', $search['category']);
        }

        if (!empty($search['expected_salary'])) {
            $builder->where('expected_salary', $search['expected_salary']);
        }

        if (!empty($search['education_level'])) {
            $builder->where('education_level', $search['education_level']);
        }

        if (!empty($search['experience'])) {
            $builder->where('experience', $search['experience']);
        }

        if (!empty($search['job_title'])) {
            $search_text = explode('-', $search['job_title']);
            foreach ($search_text as $search) {
                $builder->groupStart();
                $builder->like('job_title', $search);
                $builder->orLike('skills', $search);
                $builder->groupEnd();
            }
        }
        $builder->where('is_active', '1');
        $builder->where('profile_completed', '1');
        $builder->orderBy('created_date', 'desc');
        $builder->groupBy('job_title');
        return $builder->get()->getResultArray();
    }

}
