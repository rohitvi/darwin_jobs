<?php

namespace App\Controllers;

use App\Models\HomeModel;
use App\Models\auth\HomeAuthModel;
use App\Models\AdminModel;
use App\Libraries\Mailer;

class Home extends BaseController
{
    public function __construct()
    {
        $this->HomeModel = new HomeModel();
        $this->HomeAuthModel = new HomeAuthModel();
        $this->adminModel = new AdminModel();
        $this->mailer = new Mailer();
        $helpers = ['date'];
    }

    public function checklogin()
    {
        if (session('user_logged_in')) {
            return redirect()->to('home/dashboard');
        } else {
            return redirect()->to('home/login');
        }
    }

    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        return view('user/index');
    }

    public function login()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'email' => ['label' => 'email', 'rules' => 'required'],
                'password' => ['label' => 'password', 'rules' => 'required']
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~' . $this->validation->getErrors();
                exit;
            }
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $logindata = $this->HomeAuthModel->login_validate($email, $password);
            if ($logindata == 0) {
                echo '0~Invalid email or password';
                exit;
            } else {
                $employerdata = [
                    'user_id' => $logindata['id'],
                    'user_logged_in' => true,
                    'username' => $logindata['username'],
                ];
                $this->session->set($employerdata);
                echo '1~ You Have Successfully Logged in';
                exit;
            }
        }
        return view('user/auth/login');
    }

    public function updateProfileImage()
    {
        if ($this->request->isAJAX()) {
            if ($_FILES['profile_picture']['name'] == '') {
                echo '0~Select Profile Picture';
                exit;
            }
            $result = UploadFile($_FILES['profile_picture']);
            if ($result['status'] == true) {
                $url = $result['result']['file_url'];
                $builder = $this->db->table('users');
                $builder->where('id', session('user_id'));
                if ($builder->update(array('profile_picture' => $url))) {
                    echo '1~' . $url;
                    exit;
                }
            } else {
                echo '0~' . $result['message'];
                exit;
            }
        }
    }

    //Get States
    function get_country_states()
    {
        $builder = $this->db->table('states');
        $states = $builder->where('country_id', $this->request->getPost('country'))->get()->getResultArray();
        $options = array('' => 'Select State') + array_column($states, 'name', 'id');
        $html = form_dropdown('state', $options, '', 'class="form-control select2" required');
        $error =  array('msg' => $html);
        echo json_encode($error);
    }

    //Get Cities
    function get_state_cities()
    {
        $builder = $this->db->table('cities');
        $cities = $builder->where('state_id', $this->request->getPost('state'))->get()->getResultArray();

        $options = array('' => 'Select City') + array_column($cities, 'name', 'id');
        $html = form_dropdown('city', $options, '', 'class="form-control select2" required');
        $error =  array('msg' => $html);
        echo json_encode($error);
    }

    // User Register

    public function register()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'firstname' => ['label' => 'firstname', 'rules' => 'required'],
                'lastname' => ['label' => 'lastname', 'rules' => 'required'],
                'email' => ['label' => 'email', 'rules' => 'required'],
                'password' => ['label' => 'password', 'rules' => 'required'],
                'cpassword' => ['label' => 'cpassword', 'rules' => 'required|matches[password]'],
                'termsncondition' => ['label' => 'termsncondition', 'rules' => 'required']
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~' . $this->validation->getErrors();
                exit;
            }
            $data = [
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'is_verify' => 0,
                'token' => md5(rand(0, 1000)),
                'created_date' => date('Y-m-d : h:m:s'),
                'updated_date' => date('Y-m-d : h:m:s')
            ];
            $user_id = $this->HomeAuthModel->register($data);
            if($user_id == ''){
                echo '0~Something Went Wrong, Please Try Again !';
                exit;
            }else
                $this->mailer->send_verification_email($user_id,'user');
                echo '1~User Successfully Registered  !';
                exit;
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('home'));
    }

    public function verify($token)
    {
        $result = $this->HomeAuthModel->email_verification($token);
        if (count($result) > 0) {
            // Send Mail Data
            $mail_data = array(
                'fullname' => $result['firstname'].' '.$result['lastname'],
            );
            $this->mailer->mail_template($result['email'],'welcome',$mail_data);
            $this->session->setFlashdata('success','Email Successfully Verified!');
            return redirect()->to(base_url('login'));
        }else{
            $this->session->setFlashdata('error','Somethiung Went Wrong Try Again!');
            return redirect()->to(base_url('home'));
        }
    }

    public function add_subscriber()
    {
       if ($this->request->isAJAX()) {
        
        $rules = [
            'subscriber_email' =>['label' => 'subscriber_email', 'rules' => 'required']
        ];
        if ($this->validate($rules) == FALSE) {
            echo '0~' . $this->validation->getErrors();
            exit;
        }
        $data = [       
                'email' => $this->request->getPost('subscriber_email'),
                'created_at' => date('Y-m-d h:i:s')      
            ];
        $query = $this->HomeModel->add_subscriber($data);
        if ($query) {
            echo '1~ Congratulations! You have been Subscribed';
            exit;
        }else{
            echo '0~ Something Went Wrong, Please Try Again !';
            exit;
        }
       }
    }

    public function matching_jobs()
    {
        $this->checklogin();
        $user_id = session('user_id');
        $skills = get_user_skills($user_id); // helper function

        $data['jobs'] = $this->HomeModel->matching_jobs($skills);
        return view('user/auth/matching_jobs',$data);
    }

    public function change_password()
    {
        if ($this->request->getMethod() =='post') {
            $rules= [
                'password' => ['label' => 'password','rules' => 'required'],
                'cpassword' => ['label' => 'cpassword','rules' => 'required|matches[password]']
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . $this->validation->listErrors();
                exit;
            }
            $id = session('user_id');
            $password =  password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $query = $this->HomeAuthModel->change_password($id, $password);
            if ($query == 1){
                $this->session->setFlashdata('success', 'Password successfully Updated');
                return redirect()->to(base_url('home/change_password'));
            }else{
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                exit;
            }
        }
        return view('user/auth/change_password');
    }

    public function profile()
    {
        $get['categories'] = $this->adminModel->get_all_categories();
        $get['countries'] = $this->adminModel->get_countries_list();
        return view('user/userprofile',$get);
    }


    

    public function saved_jobs()
    {   
        $get['data'] = $this->HomeModel->saved_jobs(session('user_id'));
        return view('user/auth/saved_jobs',$get);
    }

    public function jobdetails($id)
    {   
        $get['data'] = $this->HomeModel->jobdetails($id);
        return view('user/job_details',$get);
    }
}
