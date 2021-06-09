<?php
namespace App\Controllers;
use App\Models\AdminModel;
use App\Models\auth\AuthModel;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->adminAuthModel = new AuthModel();
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        // return view('admin/dashboard');
        if (session('admin_logged_in')) {
          return redirect()->to('admin/dashboard');
        }
        else
        {
          return redirect()->to('admin/login');
        }
    }

    public function dashboard()
    {
      return view('admin/dashboard');
    }

    public function login()
    {
      if($this->request->getMethod() == 'post')
      {
        $rules = [
          'username' => ['label' => 'username', 'rules' => 'required'],
          'password' => ['label' => 'password', 'rules' => 'required']
        ];
        if ($this->validate($rules) == FALSE) {
          echo '0~'.$this->validation->listErrors();exit;
        }
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $logindata = $this->adminAuthModel->login_validate($username,$password);
        if ($logindata == 0) {
          echo '0~Invalid email or password';
        } elseif ($logindata['id'] == 1)
        {
          $admindata = [
            'admin_id' => $logindata['id'],
            'admin_logged_in' => TRUE
          ];
          $this->session->set($admindata);
          return redirect()->to('/');
        }
      }
      return view('admin/auth/login');
    }

    public function account()
    {
      if ($this->request->getMethod() == 'post') {
        $data = [
          'firstname' => $this->request->getPost('firstname'),
          'lastname' => $this->request->getPost('lastname'),
          'email' => $this->request->getPost('email'),
          'username' => $this->request->getPost('username'),
          'mobile_no' => $this->request->getPost('mobileno')
        ];
        $id = session('admin_id');
        $change = $this->adminAuthModel->account($data,$id);
        if ($change == 'done') {
          $this->session->setFlashdata('success', 'Account successfully updated');
          echo '1~successfully updated';
        }
        else{
          echo '0~Something went wrong, please try again!';
        }
      }
      return view('admin/auth/account');
    }

    public function registeradmin()
    {
      return view('admin/auth/register');
    }

    public function changepassword()
    {
      if ($this->request->getMethod() == 'post') {
        $rules = [
          'password' => ['label' => 'password', 'rules' => 'required'],
          'cpassword' => ['label' => 'password', 'rules' => 'required|matches[password]']
        ];
        if ($this->validate($rules) == FALSE) {
          echo '0~'.$this->validation->listErrors();exit;
        }
        $id = session('admin_id');
        $password = $this->request->getPost('password');
        $update = $this->adminAuthModel->changepassword($password,$id);
        if ($update == 'done') {
          $this->session->setFlashdata('success', 'Password changed successfully');
          return redirect()->to('changepassword');
        }else {
          $this->session->setFlashdata('error', 'Please try again');
          return redirect()->to('/');
        }
      }
      return view('admin/auth/changepassword');
    }

    public function showadmin()
    {
      $result['admin'] = $this->adminAuthModel->showadmin();
      return view('admin/showadmin.php', $result);
    }

    public function logout(){
      $this->session->destroy();
      return redirect()->to('/');
    }

    public function list_category()
    {
        $data['categories'] = $this->adminModel->get_all_categories();
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