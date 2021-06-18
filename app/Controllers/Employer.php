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

    public function personal_info(){
        return view('employer/profile/profile_page');
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

    public function package_confirmation($id)
    {
        $get['data'] = $this->EmployerModel->package_confirmation($id);
        return view('employer/packages/package_confirmation',$get);
    }

    public function payment()
    {
        if ($this->request->getMethod() == 'post') {
            if (session('employer_logged_in')) {
                 $rules = [
                    'fullname' => ['label'=>'fullname','rules'=>'required'],
                    'payer_email' => ['label'=>'payer_email','rules'=>'required'],
                    'card_no' => ['label'=>'card_no','rules'=>'required'],
                    'mm' => ['label'=>'mm','rules'=>'required'],
                    'yy' => ['label'=>'yy','rules'=>'required'],
                    'cvv' => ['label'=>'cvv','rules'=>'required'],
                    'emp_id' => ['label'=>'emp_id','rules'=>'required']
                ];
                if ($this->validate($rules) == FALSE) {
                    echo '0~'.$this->validation->listErrors();exit;
                }
                $data = [
                    'payment_method' => 'credit card',
                    'txn_id' => 'txn_1FXkFpHDx7jzBoS98m5C2Jpl',
                    'user_id' => '0',
                    'employer_id' => session('employer_id'),
                    'payment_amount' => $this->request->getPost('payment_amount'),
                    'payer_email' => $this->request->getPost('payer_email'),
                    'payment_status' => 'succeeded',
                    'purchased_plan' => $this->request->getPost('purchased_plan')
                ];
                $query = $this->EmployerModel->payment($data);
                if($query == 0){
                    echo '0~Something went wrong, please try again!';
                }elseif($query['status'] == 1){
                    $date = date("y-m-d G.i:s");
                    if ($this->request->getPost('package_days') == 45) {
                        $exp_date = date('y-m-d G.i:s', strtotime(' + 45 days'));
                    }elseif($this->request->getPost('package_days') == 30){
                        $exp_date = date('y-m-d G.i:s', strtotime(' + 30 days'));
                    }elseif($this->request->getPost('package_days') == 90){
                        $exp_date = date('y-m-d G.i:s', strtotime(' + 90 days'));
                    }
                    $package_info = [
                        'payment_id'=>$query['payment_id'],
                        'employer_id'=>$query['employer_id'],
                        'user_id'=>0,
                        'package_id'=>$this->request->getPost('package_id'),
                        'is_renewal'=>0,
                        'is_upgrade'=>0,
                        'buy_date'=>$date,
                        'expire_date'=> $exp_date,
                        'is_active'=>1
                    ];
                    $pay_query = $this->EmployerModel->packages_bought($package_info);
                    if ($pay_query->resultID == 1) {
                      $this->session->setFlashdata('success', 'Package successfully purchased');
                      return redirect()->to(base_url('employer'));
                    }else
                    {
                      echo '0~Something went wrong, please try again!';
                    }
                }
            }else{
                return redirect()->to(base_url('employer/login'));
            }
        }
    }

    public function mypackages()
    {   
        $id = session('employer_id');
        $get['data'] = $this->EmployerModel->mypackages($id);
        return view('employer/packages/my_packages',$get);
    }

    public function mypackagedetails($id)
    {
        $get['data'] = $this->EmployerModel->mypackagedetails($id);
        return view('employer/packages/my_package_details',$get);
    }

    public function register()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'firstname' => ['label'=>'firstname','rules'=>'required'],
                'company_name' => ['label'=>'company_name','rules'=>'required'],
                'email' => ['label'=>'email','rules'=>'required'],
                'password' => ['label'=>'password','rules'=>'required'],
                'cpassword' => ['label'=>'cpassword','rules'=>'required|matches[password]']
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~'.$this->validation->listErrors();exit;
            }
            $user_details = [
                'firstname' => $this->request->getPost('firstname'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password')
            ];
            $cmpny = [
                'company_name' => $this->request->getPost('company_name')
            ];
            $query = $this->EmployerAuthModel->register($user_details);
            $cmpny['employer_id'] = $query[0]->max_id;
            $result = $this->EmployerAuthModel->registercmpny($cmpny);
            if ($result->resultID == 1) {
                $this->session->setFlashdata('success', 'Employer successfully registered');
                return redirect()->to(base_url('employer'));
            }else
            {
              echo '0~Something went wrong, please try again!';
            }
        }
    }

    public function shortlisted()
    {   
        $id = session('employer_id');
        $get['data'] = $this->EmployerModel->shortlisted($id);
     //   pre($get);
        return view('employer/resume/shortlisted_resume',$get);
    }

    public function userdetails()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('user_id');
            $query = $this->EmployerModel->userdetails($id);
            $html = '<div class="row">
                        <div class="col-6">
                            <h4>Personal Details</h4>
                            <hr>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Full Name</td>
                                        <td>Full Name</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>Email</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>Phone</td>
                                    </tr>
                                    <tr>
                                        <td>Date Of Birth</td>
                                        <td>Date Of Birth</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>Category</td>
                                    </tr>
                                    <tr>
                                        <td>User Job Title</td>
                                        <td>User Job Title</td>
                                    </tr>
                                    <tr>
                                        <td>Experience</td>
                                        <td>Experience</td>
                                    </tr>
                                    <tr>
                                        <td>Skills</td>
                                        <td>Skills</td>
                                    </tr>
                                    <tr>
                                        <td>Current Salary (INR)</td>
                                        <td>Current Salary (INR)</td>
                                    </tr>
                                    <tr>
                                        <td>Nationality</td>
                                        <td>Nationality</td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td>Country</td>
                                    </tr>
                                    <tr>
                                        <td>City / Town</td>
                                        <td>City / Town</td>
                                    </tr>
                                    <tr>
                                        <td>Postcode</td>
                                        <td>Postcode</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>Address</td>
                                    </tr>
                                    <tr>
                                        <td>Objectives</td>
                                        <td>Objectives</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <h4>Education</h4>
                            <hr>
                            <p>Bachelor′s degree, Accounting</p>
                            <h4>Experience</h4>
                            <hr>
                            <p>Senior Accountant</p>
                            <h4>Languages</h4>
                            <hr>
                            <p>English (Beginner)</p>
                        </div>            
                    </div>';
            return ($html);
        }
    }
}