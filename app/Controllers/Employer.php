<?php
namespace App\Controllers;
use App\Models\EmployerModel;
use App\Models\auth\EmployerAuthModel;


class Employer extends BaseController
{
   public function __construct()
   {
       $this->EmployerModel = new EmployerModel();
       $this->EmployerAuthModel = new EmployerAuthModel();
   }

   public function checklogin()
   {
        if (session('employer_logged_in')){
                return redirect()->to('employer/dashboard');
            }
        else{
            return redirect()->to('employer/login');
        }
   }

    public function index()
    {
        return $this->checklogin();
        return $this->dashboard();
    }

    public function dashboard()
    {
        return view('employer/dashboard');
    }

    public function login()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' =>['label'=>'email','rules'=>'required'],
                'password' =>['label'=>'password','rules'=>'required']
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~'.$this->validation->listErrors();exit;
            }
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $logindata = $this->EmployerAuthModel->login_validate($email,$password);
            if ($logindata == 0) {
              echo '0~Invalid email or password';
            } elseif ($logindata['id'] > 1)
            {
              $employerdata = [
                'employer_id' => $logindata['id'],
                'employer_logged_in' => TRUE,
                'employer_username' => $logindata['username']
              ];
              $this->session->set($employerdata);
              return redirect()->to(base_url('employer'));
            }
        }
        return view('employer/auth/login');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('employer'));
    }

    public function changepassword()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'password' => ['label'=>'password','rules'=>'required'],
                'cpassword' => ['label'=>'cpassword','rules'=>'required|matches[password]']
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~'.$this->validation->listErrors();exit;
            }
            $id = session('employer_id');
            $password = $this->request->getPost('password');
            $query = $this->EmployerAuthModel->changepassword($id,$password);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'Password successfully Updated');
                return redirect()->to(base_url('employer/profile'));
            }
            else
            {
                echo '0~Something went wrong, please try again!';
            }
        }
        return view('employer/auth/changepassword');
    }

    public function profile()
    {
        return view('employer/auth/profile');
    }

    // Packages Part

    public function packages()
    {
        $get['data'] = $this->EmployerModel->getpackages();
        return view('employer/packages/packages',$get);
    }
}