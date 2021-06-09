<?php
namespace App\Controllers;
use App\Models\AdminModel;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->am = new AdminModel();
    }


    public function index()
    {
        return view('admin/dashboard');
        echo 'shree vyas';
        
    }

    public function list_category()
    {
        $data['categories'] = $this->am->get_all_categories();
        //$data['categories'] = $model->get_all_categories();
        return view('admin/category/list_category',$data);
    }

    public function add_category()
    {
      $session = \Config\Services::session();
      helper('form');

      if($this->request->getMethod() == 'post'){
        $input = $this->validate([
          'category' => 'required|min_length[5]',
        ]);

        if($input == true){
          //form validated successfully, so we can save values to database
        }else{
          //form not validated successfully

          $data['validation'] = $this->validator;
        }

      }
    
      return view('admin/category/add_category');
    }


    public function del_category($id = null){
		$model = new AdminModel();
		$data['user'] = $model->where('id', $id)->delete();
		return redirect()->to( base_url('admin/list_category') );
    }


}