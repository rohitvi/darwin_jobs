<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $table = NULL;

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
        $builder->where('curdate() <  expiry_date');
        $builder->where('is_status', 'active');

        if (!empty($skills)) {
            $skills = explode(',', trim($skills));
            foreach ($skills as $skill) {
                $builder->orLike('title', $skill);
                $builder->orLike('skills', $skill);
            }
        }

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

        // search URI parameters
        unset($search['p']); //unset pagination parameter form search

        if (!empty($search['state']))
            $builder->where('state', $search['state']);

        if (!empty($search['city']))
            $builder->where('city', $search['city']);

        if (!empty($search['category']))
            $builder->where('category', $search['category']);

        if (!empty($search['experience']))
            $builder->where('experience', $search['experience']);

        if (!empty($search['job_type']))
            $builder->where('job_type', $search['job_type']);

        if (!empty($search['employment_type']))
            $builder->where('employment_type', $search['employment_type']);

        if (!empty($search['title'])) {
            $search_text = explode('-', $search['title']);
            // pre($search_text);
            foreach ($search_text as $search) {
                $builder->groupStart();
                $builder->orLike('title', $search);
                $builder->orLike('skills', $search);
                $builder->orLike('job_slug', $search);
                $builder->groupEnd();
            }
        }

        $builder->where('is_status', 'active');
        $builder->where('curdate() <  expiry_date');
        $builder->orderBy('created_date', 'desc');
        $builder->groupBy('id');
        $result = $builder->paginate(1);
        // pre($this->db->getLastQuery());
        return $result;
    }

    public function get_user_experience($id)
    {
        return $this->db->table('seeker_experience')->where('user_id',$id)->get()->getResultArray();
    }

    public function insert_user_experience($data,$id)
    {
        $builder = $this->db->table('seeker_experience');
        $builder->where('id',$id);
        if ($builder->countAllResults() > 0) {
            return $this->db->table('seeker_experience')->where('id', $id)->update($data);
        }
        else
        {
            $this->db->table('seeker_experience')->insert($data);
        }
        return true;
    }
    
    public function applied_jobs($user_id)
    {
        return $this->db->table('seeker_applied_job')->select('seeker_applied_job.seeker_id,seeker_applied_job.employer_id,job_post.title,job_post.*')->join('job_post','job_post.id = seeker_applied_job.job_id')->where('seeker_applied_job.id',$user_id)->get()->getResultArray();
    }

    public function apply_job($data)
    {
        return $this->db->table('seeker_applied_job')->insert($data);
    }

    public function delete_experience($id)
    {
        $this->db->table('seeker_experience')->where('id',$id)->delete();
    }

    public function user_info_update($update_user_info,$id)
    {
        return $this->db->table('users')->where('id', $id)->update($update_user_info);
    }

    public function get_experience_by_id($id)
    {
        return $this->db->table('seeker_experience')->where('id',$id)->get()->getRowArray();
    }

    public function update_user_resume($update_resume, $id)
    {
        return $this->db->table('users')->where('id', $id)->update(array('resume' => $update_resume));
    }

    public function update_user_experience($data,$id)
    {
        //return $this->db->table('users')->where('id', $id)->update($update_user_info);
        return $this->db->table('seeker_experience')->where('id',$id)->update($data);
    }

    public function get_user_language($id)
    {
        return $this->db->table('seeker_languages')->where('user_id',$id)->get()->getResultArray();
    }

    public function add_user_language($data)
    {
        return $this->db->table('seeker_languages')->insert($data);
    }

    public function delete_language($id)
    {
        return $this->db->table('seeker_languages')->where('id',$id)->delete();
    }

    public function get_language_by_id($id)
    {
        return $this->db->table('seeker_languages')->where('id',$id)->get()->getRowArray();
    }

    public function update_language($data,$id)
    {
        return $this->db->table('seeker_languages')->where('id',$id)->update($data);
    }

    public function get_user_education($id)
    {
        return $this->db->table('seeker_education')->where('user_id',$id)->get()->getResultArray();
    }

    public function add_education($data)
    {
        return $this->db->table('seeker_education')->insert($data);
    }

    public function delete_education($id)
    {
        return $this->db->table('seeker_education')->where('id',$id)->delete();
    }

    public function get_education_by_id($id)
    {
        return $this->db->table('seeker_education')->where('id',$id)->get()->getRowArray();
    }

    public function update_education($data,$id)
    {
        return $this->db->table('seeker_education')->where('id',$id)->update($data);
    }

    public function save_job($data)
    {
        if ($this->db->table('saved_jobs')->where(array('seeker_id'=>$data['seeker_id'],'job_id'=>$data['job_id']))->get()->getNumRows() > 0) {
            $this->db->table('saved_jobs')->where(array('seeker_id'=>$data['seeker_id'],'job_id'=>$data['job_id']))->delete();
            return 'deleted';
        } else {
            $this->db->table('saved_jobs')->insert($data);
            return 'saved';
        }
    }

    public function saved_job_search($user_id)
    {
        $data = $this->db->table('saved_jobs')->select('job_id')->where('seeker_id',$user_id)->get()->getResultArray();
        if ($data){
            foreach ($data as $key => $value) {
                $ndata[] = $value['job_id'];
            }
            return $ndata;
        }
        else
            return array();
    }

}
