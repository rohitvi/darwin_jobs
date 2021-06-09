<?php
namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model
 {
    protected $table      = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'slug', 'status', 'top_category'];
    protected $deletedField  = 'deleted_at';

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
      return $this->db->table('industries')->get()->getResultArray();
      //$builder = $this->db->table('industries');
      //return $builder->get()->getResultArray();

    }

}