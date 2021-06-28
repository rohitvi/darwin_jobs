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
        $this->uri = service('uri');
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
        $html = form_dropdown('state', $options, '', 'class="form-control select2 state" required');
        $html = form_dropdown('state', $options, '', 'class="form-control select state" required');
        $error =  array('msg' => $html);
        echo json_encode($error);
    }

    // user get states
    function get_states($country_id)
    {
        $builder = $this->db->table('states')->where('country_id',$country_id)->get()->getResultArray();
        $options = array('' => 'Select State') + array_column($states, 'name', 'id');
        $html = form_dropdown('state', $options, '', ' required');
        $error =  array('msg' => $html);
        echo json_encode($error);
    }

    //Get Cities
    function get_state_cities()
    {
        $builder = $this->db->table('cities');
        $cities = $builder->where('state_id', $this->request->getPost('state'))->get()->getResultArray();

        $options = array('' => 'Select City') + array_column($cities, 'name', 'id');
        $html = form_dropdown('city', $options, '', 'class="form-control select2 city" required');
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
            if(!$user_id){
                echo '0~Something Went Wrong, Please Try Again !';
                exit;
            } else
                $this->mailer->send_verification_email($user_id, 'user');
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
                'fullname' => $result['firstname'] . ' ' . $result['lastname'],
            );
            $this->mailer->mail_template($result['email'], 'welcome', $mail_data);
            $this->session->setFlashdata('success', 'Email Successfully Verified!');
            return redirect()->to(base_url('login'));
        } else {
            $this->session->setFlashdata('error', 'Somethiung Went Wrong Try Again!');
            return redirect()->to(base_url('home'));
        }
    }

    // Advance Search functionality 
    public function search()
    {
        $search = array();
        if ($this->request->getMethod() == 'search') {

            // search job title
            if (!empty($this->request->getPost('job_title')))
                $search['title'] = make_slug($this->request->getPost('job_title'));

            // search job country
            if (!empty($this->request->getPost('country')))
                $search['country'] = $this->request->getPost('country');

            // search catagory
            if (!empty($this->request->getPost('category')))
                $search['category'] = $this->request->getPost('category');

            // search experience
            if (!empty($this->request->getPost('experience')))
                $search['experience'] = $this->request->getPost('experience');

            // search job type
            if (!empty($this->request->getPost('job_type')))
                $search['job_type'] = $this->request->getPost('job_type');

            // search employment type
            if (!empty($this->request->getPost('employment_type')))
                $search['employment_type'] = $this->request->getPost('employment_type');

            $query = $this->uri->assoc_to_uri($search);

            redirect(base_url('search/' . $query), 'refresh');
        }
        $search_array = $this->uri->getSegment(3);
        // $search_query = $this->uri->assoc_to_uri($search_array);
        echo $search_array ;exit;
        $Jobs = new HomeModel();
        $Jobs->setTable('job_post');
        $data = [
            'search_value' => $search_array,
            'jobs' => $Jobs->get_all_jobs($search_array),
            'countries' => $this->adminModel->get_countries_list(),
            'categories' => $this->adminModel->get_categories_list(),
            'title' => 'Search Results',
            'meta_description' => 'your meta description here',
            'keywords' => 'meta tags here',
            'pager' => $Jobs->pager
        ];

        return view('user/job_listing', $data);
    }


    public function add_subscriber()
    {
        if ($this->request->isAJAX()) {

            $rules = [
                'subscriber_email' => ['label' => 'subscriber_email', 'rules' => 'required']
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
            } else {
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
        return view('user/auth/matching_jobs', $data);
    }

    public function change_password()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'password' => ['label' => 'password', 'rules' => 'required'],
                'cpassword' => ['label' => 'cpassword', 'rules' => 'required|matches[password]']
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . $this->validation->listErrors();
                exit;
            }
            $id = session('user_id');
            $password =  password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $query = $this->HomeAuthModel->change_password($id, $password);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'Password successfully Updated');
                return redirect()->to(base_url('home/change_password'));
            } else {
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
        $id = session('user_id');
        $get['data'] = $this->HomeModel->perinfo_by_id($id);
        $get['experiences'] = $this->HomeModel->get_user_experience($id);

        return view('user/userprofile',$get);
    }

    public function saved_jobs()
    {
        $get['data'] = $this->HomeModel->saved_jobs(session('user_id'));
        return view('user/auth/saved_jobs', $get);
    }

    public function jobdetails($id)
    {
        $get['data'] = $this->HomeModel->jobdetails($id);
        return view('user/job_details', $get);
    }


    public function experience(){
        if ($this->request->isAJAX()) {
        
            $rules = [
                'job_title'     =>['label' => 'job_title', 'rules' => 'required'],
                'company'       =>['label' => 'company', 'rules' => 'required'],
                'country'       =>['label' => 'country', 'rules' => 'required'],
                'starting_month'=>['label' => 'starting_month', 'rules' => 'required'],
                'starting_year' =>['label' => 'starting_year', 'rules' => 'required'],
                'ending_month' =>['label' => 'ending_month', 'rules' => 'required'],
                'ending_year'    =>['label' => 'ending_year', 'rules' => 'required'],
                'description'    =>['label' => 'description', 'rules' => 'required']
            ];
            $id = session('user_id');
            $data = [       
                    'user_id' => $id,
                    'job_title' => $this->request->getPost('job_title'),
                    'company' => $this->request->getPost('company'),
                    'country' => $this->request->getPost('country'),
                    'starting_month' => $this->request->getPost('starting_month'),
                    'starting_year' => $this->request->getPost('starting_year'),
                    'ending_month' => $this->request->getPost('ending_month'),
                    'ending_year' => $this->request->getPost('ending_year'),
                    'description' => $this->request->getPost('description'),
                    'updated_date' => date('Y-m-d : h:m:s')
                ];
            $query = $this->HomeModel->update_user_experience($data,$id);
            if ($query == 1) {
                echo '1~ Experience Updated';
                exit;
            }else{
                echo '0~ Something Went Wrong, Please Try Again !';
                exit;
            }
           }
    }
    public function applied_jobs()
    {
        $user_id = session('user_id');
        $get['data'] = $this->HomeModel->applied_jobs($user_id);
        return view('user/auth/applied_jobs',$get);
    }

    public function apply_job()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'job_id' => ['label'=>'job_id','rules'=>'required'],
                'cover_letter' => ['label'=>'cover_letter','rules'=>'required'],
                'username' => ['label'=>'username','rules'=>'required'],
                'email' => ['label'=>'email','rules'=>'required'],
                'job_title' => ['label'=>'job_title','rules'=>'required'],
                'job_actual_link' => ['label'=>'job_actual_link','rules'=>'required'],
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~' . $this->validation->getErrors();
                exit;
            }
            
            $data = [
                'user_id' => session('user_id'),
                'emp_id' => $this->request->getPost('emp_id'),
                'job_id' => $this->request->getPost('job_id'),
                'cover_letter' => $this->request->getPost('cover_letter'),
                'applied_date' => date('Y-m-d : h:m:s')
            ];
            $result = $this->HomeModel->apply_job($data);
            if ($result->resultID == 1) {
                $emp = get_employer_by_id($data['emp_id']);
                $job = get_job_detail($data['job_id']);
                $emp_to = $emp['email'];

                $user_to = get_user_email($data['user_id']);

                // Send Email to Employer
                $mail_data = ['job_title'=>$job['title']];

                // Job Seeker
                $this->mailer->mail_template($user_to,'job-applied',$mail_data);

                // Employer Alert
                $this->mailer->mail_template($emp_to,'applicant-applied',$mail_data);
                echo '1~ You Have Successfully Applied for Job';
                exit;
            }else{
                echo '0~Something Went Wrong, Please Try Again !';
                exit;
            }
        }
    }
}
