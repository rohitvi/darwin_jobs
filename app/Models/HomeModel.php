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
        else{
            return $this->db->table('subscribers')->insert($data);
            }
    }

    public function matching_jobs($skills)
    {
        return $this->db->table('job_post')->select('id, title, company_id, job_slug, job_type, description, country, city,expiry_date, created_date, industry')->where(array('curdate() < expiry_date','is_status'=>1))->get()->getResultArray();
    }

}