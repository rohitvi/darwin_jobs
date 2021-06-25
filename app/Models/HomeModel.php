<?php
namespace App\Models;
use CodeIgniter\Model;
class HomeModel extends Model
{
    protected $table = NULL;

    public function add_subscriber($data)
    {
        $builder = $this->db->table('subscribers');
        $builder->where('email',$data['email']);
        if ($builder->countAllResults() > 0) {
            return true;
        }
        else
        {
            return $this->db->table('subscribers')->insert($data);
        }
    }

    public function matching_jobs($skills)
    {
        $builder =  $this->db->table('job_post')->select('job_post.id, job_post.title, job_post.company_id, job_post.job_slug, job_post.job_type, job_post.description, job_post.country, job_post.city,job_post.expiry_date, job_post.created_date, job_post.industry,job_post.min_salary,job_post.max_salary,companies.company_name,companies.company_logo')->join('companies','companies.id = job_post.company_id');
        $builder->where('curdate() <  expiry_date');
        $builder->where('is_status','active');

        if(!empty($skills)){
            $skills = explode(',', trim($skills));
            foreach($skills as $skill){
                $builder->orLike('title', $skill);
                $builder->orLike('skills', $skill);
            }
        }

        $builder->orderBy('created_date','desc');
        $builder->groupBy('title');
        return $builder->get()->getResultArray();
    }

    public function saved_jobs($user_id)
    {
        return $this->db->table('saved_jobs')->join('job_post','job_post.id = saved_jobs.job_id')->where('seeker_id',$user_id)->get()->getResultArray();
    }

    public function jobdetails($id)
    {
        return $this->db->table('job_post')->select('job_post.*,companies.company_logo,companies.company_name,companies.description as cdescription,companies.website,companies.email')->join('companies','job_post.company_id = companies.id')->where('job_post.id ='.$id)->get()->getRowArray();
    }

    public function perinfo_by_id($id)
    {
        return $this->db->table('users')->where('id',$id)->get()->getResultArray();
    }

}