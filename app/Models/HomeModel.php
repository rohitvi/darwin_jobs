<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $table = null;

    public function add_subscriber($data)
    {
        $builder = $this->db->table('subscribers');
        $builder->where('email', $data['email']);
        if ($builder->countAllResults() > 0) {
            return true;
        } else {
            return $this->db->table('subscribers')->insert($data);
        }
    }

    public function matching_jobs($skills)
    {
        $builder =  $this->db->table('job_post')->select('job_post.id, job_post.title, job_post.company_id, job_post.job_slug, job_post.job_type, job_post.description, job_post.country, job_post.city,job_post.expiry_date, job_post.created_date, job_post.industry,job_post.min_salary,job_post.max_salary,companies.company_name,companies.company_logo')->join('companies', 'companies.id = job_post.company_id');

        if (!empty($skills)) {
            $skills = explode(',', trim($skills));
            foreach ($skills as $skill) {
                $builder->orLike('title', $skill);
                $builder->orLike('skills', $skill);
            }
        }

        $builder->where('curdate() <  expiry_date');
        $builder->where('is_status', 'active');
        $builder->orderBy('created_date', 'desc');
        $builder->groupBy('title');
        return $builder->get()->getResultArray();
    }

    public function saved_jobs($user_id)
    {
        return $this->db->table('saved_jobs')->join('job_post', 'job_post.id = saved_jobs.job_id')->where('seeker_id', $user_id)->get()->getResultArray();
    }

    public function jobdetails($id)
    {
        return $this->db->table('job_post')->select('job_post.*,companies.company_logo,companies.company_name,companies.description as cdescription,companies.website,companies.email')->join('companies', 'job_post.company_id = companies.id')->where('job_post.id =' . $id)->get()->getRowArray();
    }

    public function perinfo_by_id($id)
    {
        return $this->db->table('users')->where('id', $id)->get()->getResultArray();
    }

    // Get All Jobs
    public function get_all_jobs($search)
    {
        $builder = $this->table('job_post');

        $builder->select('id, title, company_id, job_slug, job_type, description, state, city, expiry_date, created_date, industry');

        if (!empty($search['title'])) {
            $search_text = explode('-', $search['title']);
            foreach ($search_text as $srch) {
                $builder->groupStart();
                $builder->orLike('title', $srch);
                $builder->orLike('skills', $srch);
                $builder->orLike('job_slug', $srch);
                $builder->groupEnd();
            }
        }

        if (!empty($search['state'])) {
            $builder->where('state', $search['state']);
        }

        if (!empty($search['city'])) {
            $builder->where('city', $search['city']);
        }

        if (!empty($search['category'])) {
            $builder->where('category', $search['category']);
        }

        if (!empty($search['industry'])) {
            $builder->where('industry', $search['industry']);
        }

        if (!empty($search['experience'])) {
            $builder->where('experience', $search['experience']);
        }

        if (!empty($search['job_type'])) {
            $builder->where('job_type', $search['job_type']);
        }

        if (!empty($search['employment_type'])) {
            $builder->where('employment_type', $search['employment_type']);
        }
        $builder->where('is_status', 'active');
        $builder->where('curdate() <  expiry_date');
        $builder->orderBy('created_date', 'desc');
        $builder->groupBy('id');
        $result = $builder->paginate(5);
        // pre($builder->getLastQuery());
        return $result;
    }

    public function get_user_experience($id)
    {
        return $this->db->table('seeker_experience')->where('user_id', $id)->get()->getResultArray();
    }

    public function insert_user_experience($data, $id)
    {
        $builder = $this->db->table('seeker_experience');
        $builder->where('id', $id);
        if ($builder->countAllResults() > 0) {
            return $this->db->table('seeker_experience')->where('id', $id)->update($data);
        } else {
            $this->db->table('seeker_experience')->insert($data);
        }
        return true;
    }

    public function applied_jobs($user_id)
    {
        return $this->db->table('seeker_applied_job')->select('seeker_applied_job.seeker_id,seeker_applied_job.employer_id,job_post.title,job_post.*')->join('job_post', 'job_post.id = seeker_applied_job.job_id')->where('seeker_applied_job.seeker_id', $user_id)->get()->getResultArray();
    }

    public function apply_job($data)
    {
        return $this->db->table('seeker_applied_job')->insert($data);
    }

    public function delete_experience($id,$user_id)
    {
        $this->db->table('seeker_experience')->where(array('id'=>$id,'user_id'=>$user_id))->delete();
    }

    public function user_info_update($update_user_info, $id)
    {
        return $this->db->table('users')->where('id', $id)->update($update_user_info);
    }

    public function get_experience_by_id($id)
    {
        return $this->db->table('seeker_experience')->where('id', $id)->get()->getRowArray();
    }

    public function update_user_resume($update_resume, $id)
    {
        return $this->db->table('users')->where('id', $id)->update(array('resume' => $update_resume));
    }

    public function update_user_experience($data, $id)
    {
        return $this->db->table('seeker_experience')->where('id', $id)->update($data);
    }

    public function get_user_language($id)
    {
        return $this->db->table('seeker_languages')->where('user_id', $id)->get()->getResultArray();
    }

    public function add_user_language($data)
    {
        return $this->db->table('seeker_languages')->insert($data);
    }

    public function delete_language($id,$user_id)
    {
        return $this->db->table('seeker_languages')->where(array('id'=>$id,'user_id'=>$user_id))->delete();
    }

    public function get_language_by_id($id)
    {
        return $this->db->table('seeker_languages')->where('id', $id)->get()->getRowArray();
    }

    public function update_language($data, $id)
    {
        return $this->db->table('seeker_languages')->where('id', $id)->update($data);
    }

    public function get_user_education($id)
    {
        return $this->db->table('seeker_education')->where('user_id', $id)->get()->getResultArray();
    }

    public function add_education($data)
    {
        return $this->db->table('seeker_education')->insert($data);
    }

    public function delete_education($id,$user_id)
    {
        return $this->db->table('seeker_education')->where(array('id'=>$id,'user_id'=>$user_id))->delete();

    }

    public function get_education_by_id($id)
    {
        return $this->db->table('seeker_education')->where('id', $id)->get()->getRowArray();
    }

    public function update_education($data, $id)
    {
        return $this->db->table('seeker_education')->where('id', $id)->update($data);
    }

    public function save_job($data)
    {
        if ($this->db->table('saved_jobs')->where(array('seeker_id' => $data['seeker_id'], 'job_id' => $data['job_id']))->get()->getNumRows() > 0) {
            $this->db->table('saved_jobs')->where(array('seeker_id' => $data['seeker_id'], 'job_id' => $data['job_id']))->delete();
            return '1~Removed From Save List';
        } else {
            $this->db->table('saved_jobs')->insert($data);
            return '1~Saved';
        }
    }

    public function saved_job_search($user_id)
    {
        $data = $this->db->table('saved_jobs')->select('job_id')->where('seeker_id', $user_id)->get()->getResultArray();
        if ($data) {
            foreach ($data as $key => $value) {
                $ndata[] = $value['job_id'];
            }
            return $ndata;
        } else {
            return array();
        }
    }

    public function getTopCategory()
    {
        return $this->db->table('categories')->where('featured', 1)->get(8)->getResultArray();
    }
    //----------------------------------------------------
    // Get those citites who have jobs
    public function get_cities_with_jobs()
    {
        $builder = $this->db->table('job_post');
        $builder->select('city as city_id, COUNT(city) as total_jobs');
        $builder->where(array('curdate() <' => 'expiry_date'));
        $builder->groupBy('city');
        return $builder->get()->getResultArray();
    }

    // Get those industries who have jobs
    public function get_industries_with_jobs()
    {
        $builder = $this->db->table('job_post');
        $builder->select('industry as industry_id, COUNT(industry) as total_jobs');
        $builder->where(array('is_status' => 'active', 'curdate() <' => 'expiry_date'));
        $builder->groupBy('industry');
        return $builder->get()->getResultArray();
    }

    // Get those categories who have jobs
    public function get_categories_with_jobs()
    {
        $builder = $this->db->table('job_post');
        $builder->select('category as category_id, COUNT(category) as total_jobs');
        $builder->where(array('is_status' => 'active', 'curdate() <' => 'expiry_date'));
        $builder->groupBy('category');
        return $builder->get()->getResultArray();
    }

    // Get all companies
    public function get_companies($letter)
    {
        $builder = $this->db->table('companies');
        $builder->select('id, company_name, company_slug, company_logo');
        $builder->like('company_name', $letter, 'after');
        $builder->groupBy('companies.company_slug');
        return $builder->get()->getResultArray();
    }

    // Get company detail
    public function get_company_detail($id)
    {
        $builder = $this->db->table('companies');
        $builder->Where(array('id' => $id));
        $data = $builder->get()->getResultArray();
        return $data[0];
    }

    //----------------------------------------------------
    // Get all companies
    public function get_jobs_by_companies($company_id)
    {
        $builder = $this->db->table('job_post');
        $builder->select('id, min_salary,max_salary,title, company_id, job_slug, job_type, description, country, city, created_date, industry');
        $builder->Where('company_id', $company_id);
        $builder->Where('is_status', 'active');
        $builder->Where('curdate() <  expiry_date');
        $builder->orderBy('created_date', 'desc');
        return $builder->get()->getResultArray();
    }

    public function getLastestPost()
    {
        return $this->db->table('job_post')->select('COUNT(seeker_applied_job.job_id) as job_applicants,seeker_applied_job.job_id,job_post.*')->join('seeker_applied_job','seeker_applied_job.job_id = job_post.id')->groupBy('seeker_applied_job.job_id')->orderBy('id', 'DESC')->get(8)->getResultArray();
    }

    public function contactus($data)
    {
        return $builder = $this->db->table('contact_us')->insert($data);
    }

    public function get_last_experience_by_id($id)
    {
        return $this->db->table('seeker_experience')->where('user_id',$id)->get()->getRowArray();
    }
    
    public function insert_setup_experience($data, $id)
    {
        $builder = $this->db->table('seeker_experience');
        $builder->where('user_id', $id);
        if ($builder->countAllResults() > 0) {
            return $this->db->table('seeker_experience')->where('id', $id)->update($data);
        } else {
            return $this->db->table('seeker_experience')->insert($data);
        }
    }

    public function get_last_education_by_id($user_id)
    {
        return $this->db->table('seeker_education')->where('user_id',$user_id)->get()->getRowArray();
    }

    public function insert_setup_education($data,$user_id)
    {
        $builder = $this->db->table('seeker_education');
        $builder->where('user_id', $user_id);
        if ($builder->countAllResults() > 0) {
            return $this->db->table('seeker_education')->where('id', $user_id)->update($data);
        } else {
            return $this->db->table('seeker_education')->insert($data);
        }
    }

    public function get_last_language_by_id($user_id)
    {
        return $this->db->table('seeker_languages')->where('user_id',$user_id)->get()->getRowArray();
    }

    public function insert_setup_language($data,$user_id)
    {
        $builder = $this->db->table('seeker_languages');
        $builder->where('user_id', $user_id);
        if ($builder->countAllResults() > 0) {
            return $this->db->table('seeker_languages')->where('id', $user_id)->update($data);
        } else {
            return $this->db->table('seeker_languages')->insert($data);
        }
    }

    public function no_of_count($id)
    {
        $builder = $this->db->table('seeker_applied_job');
        $builder->select('job_id,seeker_id, COUNT(job_id) as job_applicants');
        $builder->where('job_id',$id);
        $builder->groupBy('job_id');
        return $builder->get()->getResultArray();
    }

    public function no_of_job()
    {
        $builder = $this->db->table('seeker_applied_job');
        $builder->select('job_id,seeker_id, COUNT(job_id) as job_applicants');
        $builder->groupBy('job_id');
        return $builder->get()->getResultArray();
    }
}
