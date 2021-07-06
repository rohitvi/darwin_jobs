<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\HomeModel;
use App\Models\auth\HomeAuthModel;
use App\Models\AdminModel;
use App\Libraries\Mailer;

class Home extends BaseController
{
    private $facebook = NULL;
    private $fb_helper = NULL;
    public function __construct()
    {
        require_once APPPATH . 'Libraries/vendor/autoload.php';
        $this->facebook = new \Facebook\Facebook([
            'app_id' => '2995803240742072',
            'app_secret' => '2cee320baf4567f0ccf4f4eca6f4a5be',
            'default_graph_version' => 'v2.3'
        ]);

        $this->fb_helper = $this->facebook->getRedirectLoginHelper();
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

    public function checkProfileCompleted()
    {
        if (session('profile_completed') == 0) {
            return redirect()->to(base_url('home/profile'));
        }
    }

    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        $data['states'] = $this->adminModel->get_states_list(101);
        return view('users/index', $data);
        $this->checkProfileCompleted();
        return view('users/index');
    }

    public function login()
    {
        $fb_permission = ['email'];
        $data['fb_btn'] = $this->fb_helper->getLoginUrl('https://jobs.darwindevs.com/home/authWithFb?',$fb_permission);

        $google_client = new \Google_Client();
        $google_client->setClientId('192651661990-ivaf8o78h2caano4r29uktnl1l9oapc8.apps.googleusercontent.com');
        $google_client->setClientSecret('-3ouIrk2EgJ6x9y2aZ4YQBmz');
        $google_client->setRedirectUri(base_url().'/login');
        $google_client->addScope('email');
        $google_client->addScope('profile');

        if ($this->request->getVar('code')) {
            $token = $google_client->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
            if (!isset($token['error'])) {
                $google_client->setAccessToken($token['access_token']);
                $this->session->set('access_token',$token['access_token']);
                //to get profile data
                $google_service = new \Google_Service_Oauth2($google_client);
                $g_data = $google_service->userinfo->get();
                if(!empty($g_data['id'])){
                    $logindata = $this->HomeAuthModel->google_validate($g_data['id'],$g_data['given_name'],$g_data['family_name'],$g_data['email'],$g_data['picture']);
                    //pre($logindata);
                    $employerdata=[
                        'user_id' =>$logindata['id'],
                        'user_logged_in' => true,
                        'profile_pic'=> $logindata['profile_picture'],
                        'username'=>$logindata['firstname'].' '.$logindata['lastname'],
                        'profile_completed' => $logindata['profile_completed']
                    ];
                    session()->set($employerdata);
                    session()->setFlashData('success','Login Success!');
                    return redirect()->to(base_url('home/profile'));
                }

            }
        }

        if ($this->request->isAJAX()) {
            $rules = [
                'email' => ['label' => 'email', 'rules' => 'required'],
                'password' => ['label' => 'password', 'rules' => 'required']
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . arrayToList($this->validation->getErrors());
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
                    'profile_completed' => $logindata['profile_completed'],
                    'is_verify' => $logindata['is_verify']
                ];
                $this->session->set($employerdata);
                echo '1~You Have Successfully Logged in';
                exit;
            }
        }
        if (!$this->session->get('access_token')) {
            $data['loginButton'] = $google_client->createAuthUrl();
        }

        return view('users/auth/login',$data);
    }

    public function authWithFb()
    {
        if ($this->request->getVar('state')) {
            $this->fb_helper->getPersistentDataHandler()->set('state', $this->request->getVar('state'));
        }
        if ($this->request->getVar('code')) {
            if (session()->get('access_token')) {
                $access_token = session()->get('access_token');
            } else {
                $access_token = $this->fb_helper->getAccessToken();
                session()->set('access_token', $access_token);
                $this->facebook->setDefaultAccessToken(session()->get('access_token'));
            }
            $graph_response = $this->facebook->get('/me?fields=name,email,picture.width(800).height(800)', $access_token);
            $fb_user_info = $graph_response->getGraphUser();
            $profilep = 'http://graph.facebook.com/' . $fb_user_info['id'] . '/picture';
            if (!empty($fb_user_info['id'])) {
                $logindata = $this->HomeAuthModel->facebook_validate($fb_user_info['id'], $fb_user_info['name'], $fb_user_info['email'], $profilep);
                $employerdata = [
                    'user_id' => $logindata['id'],
                    'user_logged_in' => true,
                    'profile_pic' => $logindata['profile_picture'],
                    'username' => $logindata['firstname'] . ' ' . $logindata['lastname'],
                    'profile_completed' => $logindata['profile_completed']
                ];
                session()->set($employerdata);
            }
        } else {
            session()->setFlashData('error', 'Something went wrong, Please try again!');
            return redirect()->to(base_url('login'));
        }
        session()->setFlashData('success', 'Login Success!');
        return redirect()->to(base_url('home/profile'));
    }

    //Get States
    public function get_country_states()
    {
        $builder = $this->db->table('states');
        $states = $builder->where('country_id', $this->request->getPost('country'))->get()->getResultArray();
        $options = array('' => 'Select State') + array_column($states, 'name', 'id');
        $html = form_dropdown('state', $options, '', 'class="form-control select2 state" required');
        $error =  array('msg' => $html);
        echo json_encode($error);
    }

    // user get states
    public function get_states($country_id)
    {
        $builder = $this->db->table('states')->where('country_id', $country_id)->get()->getResultArray();
        $options = array('' => 'Select State') + array_column($states, 'name', 'id');
        $html = form_dropdown('state', $options, '', ' required');
        $error =  array('msg' => $html);
        echo json_encode($error);
    }

    //Get Cities
    public function get_state_cities()
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
                'password' => ['label' => 'Password', 'rules' => 'required'],
                'cpassword' => ['label' => 'Password', 'rules' => 'required|matches[password]'],
                'termsncondition' => ['label' => 'termsncondition', 'rules' => 'required']
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . arrayToList($this->validation->getErrors());
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
            if (!$user_id) {
                echo '0~Something Went Wrong, Please Try Again !';
                exit;
            } else {
                $this->mailer->send_verification_email($user_id, 'user');
                echo '1~User Successfully Registered  !';
                exit;
            }
        }
        return view('users/auth/registration');
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
            $this->session->set('is_verify', 1);
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
        // pre($_POST);
        $search = array();
        if ($this->request->getMethod() == 'post') {
            // search job title
            if (!empty($this->request->getPost('job_title'))) {
                $search['title'] = make_slug($this->request->getPost('job_title'));
            }

            // search job state
            if (!empty($this->request->getPost('state'))) {
                $search['state'] = $this->request->getPost('state');
            }

            // search job city
            if (!empty($this->request->getPost('city'))) {
                $search['city'] = $this->request->getPost('city');
            }

            // search catagory
            if (!empty($this->request->getPost('category'))) {
                $search['category'] = $this->request->getPost('category');
            }

            // search industry
            if (!empty($this->request->getPost('industry'))) {
                $search['industry'] = $this->request->getPost('industry');
            }

            // search experience
            if (!empty($this->request->getPost('experience'))) {
                $search['experience'] = $this->request->getPost('experience');
            }

            // search job type
            if (!empty($this->request->getPost('job_type'))) {
                $search['job_type'] = $this->request->getPost('job_type');
            }

            // search employment type
            if (!empty($this->request->getPost('employment_type'))) {
                $search['employment_type'] = $this->request->getPost('employment_type');
            }
            // $query = assoc_to_uri($search);
            $query = http_build_query($search);
            return redirect()->to(base_url('search?' . $query));
        }
        // $uri = new \CodeIgniter\HTTP\URI(current_url(true));
        $query_str = parse_url(current_url(true), PHP_URL_QUERY);
        parse_str($query_str, $search);
        // pre($search);
        $Jobs = new HomeModel();
        $Jobs->setTable('job_post');
        $data = [
            'search_value' => $search,
            'jobs' => $Jobs->get_all_jobs($search),
            'states' => $this->adminModel->get_states_list(101),
            'categories' => $this->adminModel->get_categories_list(),
            'title' => 'Search Results',
            'meta_description' => 'your meta description here',
            'keywords' => 'meta tags here',
            'pager' => $Jobs->pager,
            'saved_job' => $this->HomeModel->saved_job_search(session('user_id'))
        ];
        // pre($data['jobs']);
        return view('users/job_listing', $data);
    }


    public function add_subscriber()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'subscriber_email' => ['label' => 'subscriber_email', 'rules' => 'required']
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . arrayToList($this->validation->getErrors());
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
        return view('users/auth/matching_jobs', $data);
    }

    public function change_password()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'old_password' => ['label' => 'old_password', 'rules' => 'required'],
                'new_password' => ['label' => 'new_password', 'rules' => 'required'],
                'confirm_password' => ['label' => 'confirm_password', 'rules' => 'required|matches[new_password]']
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('employer/change_password'));
            }
            $id = session('user_id');
            $data = array(
                'id' => $id,
                'old_password' => $this->request->getPost('old_password'),
                'password' =>  password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT)
            );
            // $password =  password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $query = $this->HomeAuthModel->change_password($id, $data);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'Password successfully Updated');
                return redirect()->to(base_url('home/change_password'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('home/change_password'));
            }
        }
        return view('users/auth/change_password');
    }

    public function profile()
    {
        $get['categories'] = $this->adminModel->get_all_categories();
        $get['countries'] = $this->adminModel->get_countries_list();
        $id = session('user_id');
        $get['data'] = $this->HomeModel->perinfo_by_id($id);
        $get['experiences'] = $this->HomeModel->get_user_experience($id);
        $get['languages'] = $this->HomeModel->get_user_language($id);
        $get['education'] = $this->HomeModel->get_user_education($id);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'firstname'     => ['label' => 'First Name', 'rules' => 'required'],
                'lastname'     => ['label' => 'Last Name', 'rules' => 'required'],
                'email'         => ['label' => 'Email', 'rules' => 'required|valid_email'],
                'mobile_no'     => ['label' => 'Phone Number', 'rules' => 'required|min_length[10]'],
                'dob'           => ['label' => 'Date of Birth', 'rules' => 'required'],
                'age'           => ['label' => 'Age', 'rules' => 'required'],
                'category'      => ['label' => 'Category', 'rules' => 'required'],
                'job_title'      => ['label' => 'Job Title', 'rules' => 'required'],
                'experience'      => ['label' => 'Experience', 'rules' => 'required'],
                'skills'          => ['label' => 'Skills', 'rules' => 'required'],
                'current_salary'  => ['label' => 'Current Salary', 'rules' => 'required'],
                'expected_salary' => ['label' => 'Expected Salary', 'rules' => 'required'],
                'country'          => ['label' => 'Country', 'rules' => 'required'],
                'state'            => ['label' => 'State', 'rules' => 'required'],
                'city'             => ['label' => 'City', 'rules' => 'required'],
                'address'          => ['label' => 'Address', 'rules' => 'required'],
                // 'profile_picture' => ['uploaded[profile_picture]', 'max_size[profile_picture,1024]'],
            ];
            if ($this->validate($rules) == false) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('home/profile'));
            }
            if ($_FILES['profile_picture']['name'] != '') {
                $result = UploadFile($_FILES['profile_picture']);
                if ($result['status'] == true) {
                    $url = $result['result']['file_url'];
                } else {
                    $this->session->setFlashdata('error', $result['message']);
                    return redirect()->to(base_url('home/profile'));
                }
            }
            $update_user_info = array(
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'mobile_no' => $this->request->getPost('mobile_no'),
                'dob' => $this->request->getPost('dob'),
                'age' => $this->request->getPost('age'),
                'category' => $this->request->getPost('category'),
                'job_title' => $this->request->getPost('job_title'),
                'experience' => $this->request->getPost('experience'),
                'skills' => $this->request->getPost('skills'),
                'current_salary' => $this->request->getPost('current_salary'),
                'expected_salary' => $this->request->getPost('expected_salary'),
                'country' => $this->request->getPost('country'),
                'state' => $this->request->getPost('state'),
                'city' => $this->request->getPost('city'),
                'address' => $this->request->getPost('address'),
                'profile_completed' => 1,
            );
            if ($_FILES['profile_picture']['name'] != '') {
                $update_user_info['profile_picture'] = $url;
            }
            $id = session('user_id');
            // pre($update_user_info );
            $update_per = $this->HomeModel->user_info_update($update_user_info, $id);

            if ($update_per == 1) {
                $this->session->set('profile_completed', 1);
                $this->session->setFlashdata('success', 'Personal Information successfully Updated');
                return redirect()->to(base_url('home/profile'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('home/profile'));
            }
        }
        return view('users/auth/profile', $get);
    }

    public function saved_jobs()
    {
        $get['data'] = $this->HomeModel->saved_jobs(session('user_id'));
        return view('users/auth/saved_jobs', $get);
    }

    public function jobdetails($id)
    {
        $get['data'] = $this->HomeModel->jobdetails($id);
        $get['saved_job'] = $this->HomeModel->saved_job_search(session('user_id'));
        return view('users/job_details', $get);
    }


    public function insert_user_experience()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'job_title'     => ['label' => 'Job Title', 'rules' => 'required'],
                'company'       => ['label' => 'Company', 'rules' => 'required'],
                'country'       => ['label' => 'Country', 'rules' => 'required'],
                'starting_month' => ['label' => 'Starting Month', 'rules' => 'required'],
                'starting_year' => ['label' => 'Starting Year', 'rules' => 'required'],
                'ending_month' => ['label' => 'Ending Month', 'rules' => 'trim'],
                'ending_year'    => ['label' => 'Ending Year', 'rules' => 'trim'],
                'currently_working_here'    => ['label' => 'Currently Working Here', 'rules' => 'trim'],
                'description'    => ['label' => 'Description', 'rules' => 'required']
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . arrayToList($this->validation->getErrors());
                exit;
            }
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
                'currently_working_here' => $this->request->getPost('currently_working_here'),
                'description' => $this->request->getPost('description'),
                'updated_date' => date('Y-m-d : h:m:s')
            ];
            $query = $this->HomeModel->insert_user_experience($data, $id);
            if ($query == 1) {
                echo '1~ Experience Updated';
                exit;
            } else {
                echo '0~ Something Went Wrong, Please Try Again !';
                exit;
            }
        }
    }
    public function applied_jobs()
    {
        $user_id = session('user_id');
        $get['data'] = $this->HomeModel->applied_jobs($user_id);
        return view('users/auth/applied_jobs', $get);
    }

    public function apply_job()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'job_id' => ['label' => 'job_id', 'rules' => 'required'],
                'cover_letter' => ['label' => 'cover_letter', 'rules' => 'required'],
                'username' => ['label' => 'username', 'rules' => 'required'],
                'email' => ['label' => 'email', 'rules' => 'required'],
                'job_title' => ['label' => 'job_title', 'rules' => 'required'],
                'job_actual_link' => ['label' => 'job_actual_link', 'rules' => 'required'],
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . arrayToList($this->validation->getErrors());
                exit;
            }
            $data = [
                'seeker_id' => session('user_id'),
                'employer_id' => $this->request->getPost('employer_id'),
                'job_id' => $this->request->getPost('job_id'),
                'cover_letter' => $this->request->getPost('cover_letter'),
                'applied_date' => date('Y-m-d : h:m:s')
            ];
            $result = $this->HomeModel->apply_job($data);
            if ($result->resultID == 1) {
                $emp = get_employer_by_id($data['employer_id']);
                $job = get_job_detail($data['job_id']);
                $emp_to = $emp['email'];

                $user_to = get_user_email($data['seeker_id']);

                // Send Email to Employer
                $mail_data = ['job_title' => $job['title']];

                // Job Seeker
                $this->mailer->mail_template($user_to, 'job-applied', $mail_data);

                // Employer Alert
                $this->mailer->mail_template($emp_to, 'applicant-applied', $mail_data);
                echo '1~ You Have Successfully Applied for Job';
                exit;
            } else {
                echo '0~Something Went Wrong, Please Try Again !';
                exit;
            }
        }
    }

    public function delete_experience($id)
    {
        $query = $this->HomeModel->delete_experience($id);
        if ($query == 1) {
            $this->session->setFlashdata('success', 'Experience successfully deleted');
            return redirect()->to(base_url('home/profile'));
        } else {
            $this->session->setFlashdata('error', 'Something went wrong, please try again');
            return redirect()->to(base_url('home/profile'));
        }
    }

    public function get_experience_by_id()
    {
        if ($this->request->getPost('exp_id')) {
            $exp_id = $this->request->getPost('exp_id');
            $data['expedit'] = $this->HomeModel->get_experience_by_id($exp_id);
            $data['countries'] = $this->adminModel->get_countries_list();
            return view('users/auth/user_experience_edit', $data);
        }
    }

    public function resume()
    {
        if ($this->request->getMethod() == 'post') {
            if ($_FILES['user_resume']['name'] != '') {
                $rules = [
                    'user_resume' => ['uploaded[user_resume]', 'max_size[user_resume,1024]'],
                ];
            }
            if ($this->validate($rules) == false) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('home/profile'));
            }
            $result = UploadFile($_FILES['user_resume']);
            if ($result['status'] == true) {
                $url = $result['result']['file_url'];
            } else {
                $this->session->setFlashdata('error', $result['message']);
                return redirect()->to(base_url('home/profile'));
            }
            if ($_FILES['user_resume']['name'] != '') {
                $update_resume['user_resume'] = $url;
            }
            $id = session('user_id');
            $userresume = $this->HomeModel->update_user_resume($update_resume, $id);
            if ($userresume == 1) {
                $this->session->setFlashdata('success', 'Update Success');
                return redirect()->to(base_url('home/profile'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('home/profile'));
            }
        }
    }


    public function user_experience_update()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'job_title'     => ['label' => 'job_title', 'rules' => 'required'],
                'company'       => ['label' => 'company', 'rules' => 'required'],
                'country'       => ['label' => 'country', 'rules' => 'required'],
                'starting_month' => ['label' => 'starting_month', 'rules' => 'required'],
                'starting_year' => ['label' => 'starting_year', 'rules' => 'required'],
                'ending_month' => ['label' => 'ending_month', 'rules' => 'trim'],
                'ending_year'    => ['label' => 'ending_year', 'rules' => 'trim']
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('home/profile'));
            }
            $user_id = session('user_id');
            $data = [
                'user_id' => $user_id,
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
            $id = $this->request->getPost('exp_id');
            $query = $this->HomeModel->update_user_experience($data, $id);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'Experience Updated');
                return redirect()->to(base_url('home/profile'));
            } else {
                $this->session->setFlashdata('error', 'Something Went Wrong, Please Try Again !');
                return redirect()->to(base_url('home/profile'));
            }
        }
    }
    public function password_reset()
    {
        if ($this->request->isAJAX()) {
            $email = trim($this->request->getPost('email'));
            $response = $this->HomeAuthModel->check_email($email);
            if ($response) {
                $rand_no = rand(0, 1000);
                $pwd_reset_code = md5($rand_no . $response[0]['id']);
                $query = $this->HomeAuthModel->update_reset_code($pwd_reset_code, $response[0]['id']);
                // Sending Email
                $name = $response[0]['firstname'] . ' ' . $response[0]['lastname'];
                $email = $response[0]['email'];
                $reset_link = base_url('home/reset_password/' . $pwd_reset_code);
                $body = $this->mailer->pwd_reset_link($name, $reset_link);

                $mail_data['receiver_email'] = $email;
                $mail_data['mail_subject'] = 'Reset your password';
                $mail_data['mail_body'] = $body;

                if (sendEmail($mail_data)) {
                    echo '1~Email has been sent successfully !';
                    exit;
                }
            } else {
                echo '0~Email does not exist!';
                exit;
            }
        }
        return view('users/auth/password_reset');
    }

    public function reset_password($reset_code)
    {
        $check_reset['data'] = $this->HomeAuthModel->check_reset_code($reset_code);
        return view('users/auth/reset_password', $check_reset);
    }

    public function update_reset_password()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'id' => ['label' => 'id', 'rules' => 'required'],
                'password' => ['label' => 'password', 'rules' => 'required'],
                'cpassword' => ['label' => 'cpassword', 'rules' => 'required|matches[password]'],
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . arrayToList($this->validation->getErrors());
                exit;
            }
            $id = $this->request->getPost('id');
            $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $query = $this->HomeAuthModel->update_reset_password($password, $id);
            if ($query) {
                echo '1~Password changed successfully !';
                exit;
            } else {
                echo '0~Something went wrong, please try again !';
                exit;
            }
        }
    }

    public function add_language()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'language' =>  ['label' => 'Language', 'rules' => 'required'],
                'lang_level' => ['label' => 'Proficiency with this language', 'rules' => 'required']
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('home/profile'));
            }
            $user_id = session('user_id');
            $data = [
                'user_id' => $user_id,
                'language' => $this->request->getPost('language'),
                'proficiency' => $this->request->getPost('lang_level'),
                'updated_date' => date('Y-m-d'),
            ];
            $query = $this->HomeModel->add_user_language($data);
            if ($query) {
                $this->session->setFlashdata('success', 'Language Added Successfully!');
                return redirect()->to(base_url('home/profile'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('home/profile'));
            }
        }
    }

    public function delete_language($id)
    {
        $query = $this->HomeModel->delete_language($id);
        if ($query == true) {
            $this->session->setFlashdata('success', 'Language successfully deleted');
            return redirect()->to(base_url('home/profile'));
        } else {
            $this->session->setFlashdata('error', 'Something went wrong, please try again');
            return redirect()->to(base_url('home/profile'));
        }
    }

    public function get_language_by_id()
    {
        if ($this->request->getPost('lang_id')) {
            $lang_id = $this->request->getPost('lang_id');
            $data['userlang'] = $this->HomeModel->get_language_by_id($lang_id);
            return view('users/auth/user_language_edit', $data);
        }
    }

    public function update_language()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'language' =>  ['label' => 'Language', 'rules' => 'required'],
                'lang_level' => ['label' => 'Proficiency with this language', 'rules' => 'required']
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('home/profile'));
            }
            $user_id = session('user_id');
            $data = [
                'user_id' => $user_id,
                'language' => $this->request->getPost('language'),
                'proficiency' => $this->request->getPost('lang_level'),
                'updated_date' => date('Y-m-d'),
            ];
            $id = $this->request->getPost('lang_id');
            $query = $this->HomeModel->update_language($data, $id);
            if ($query == true) {
                $this->session->setFlashdata('success', 'Language Updated !');
                return redirect()->to(base_url('home/profile'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again !');
                return redirect()->to(base_url('home/profile'));
            }
        }
    }

    public function add_education()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'level' =>  ['label' => 'Degree Level', 'rules' => 'required'],
                'title' => ['label' => 'Degree Title', 'rules' => 'required'],
                'majors' =>  ['label' => 'Major Subjects', 'rules' => 'required'],
                'institution' => ['label' => 'Institution', 'rules' => 'required'],
                'country' =>  ['label' => 'Country', 'rules' => 'required'],
                'year' => ['label' => 'Completion Year', 'rules' => 'required']
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('home/profile'));
            }
            $user_id = session('user_id');
            $data = [
                'user_id' => $user_id,
                'degree' => $this->request->getPost('level'),
                'degree_title' => $this->request->getPost('title'),
                'major_subjects' => $this->request->getPost('majors'),
                'institution' => $this->request->getPost('institution'),
                'country' => $this->request->getPost('country'),
                'completion_year' => $this->request->getPost('year'),
                'updated_date' => date('Y-m-d')
            ];
            $query = $this->HomeModel->add_education($data);
            if ($query) {
                $this->session->setFlashdata('success', 'Education Added Successfully');
                return redirect()->to(base_url('home/profile'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again !');
                return redirect()->to(base_url('home/profile'));
            }
        }
    }

    public function delete_education($id)
    {
        $query = $this->HomeModel->delete_education($id);
        if ($query) {
            $this->session->setFlashdata('success', 'Education successfully deleted');
            return redirect()->to(base_url('home/profile'));
        } else {
            $this->session->setFlashdata('error', 'Something went wrong, please try again');
            return redirect()->to(base_url('home/profile'));
        }
    }

    public function get_education_by_id()
    {
        if ($this->request->getPost('edu_id')) {
            $edu_id = $this->request->getPost('edu_id');
            $data['edu'] = $this->HomeModel->get_education_by_id($edu_id);
            $data['countries'] = $this->adminModel->get_countries_list();
            return view('users/auth/user_education_edit', $data);
        }
    }

    public function update_education()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'level' =>  ['label' => 'Degree Level', 'rules' => 'required'],
                'title' => ['label' => 'Degree Title', 'rules' => 'required'],
                'majors' =>  ['label' => 'Major Subjects', 'rules' => 'required'],
                'institution' => ['label' => 'Institution', 'rules' => 'required'],
                'country' =>  ['label' => 'Country', 'rules' => 'required'],
                'year' => ['label' => 'Completion Year', 'rules' => 'required']
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('home/profile'));
            }
            $user_id = session('user_id');
            $data = [
                'user_id' => $user_id,
                'degree' => $this->request->getPost('level'),
                'degree_title' => $this->request->getPost('title'),
                'major_subjects' => $this->request->getPost('majors'),
                'institution' => $this->request->getPost('institution'),
                'country' => $this->request->getPost('country'),
                'completion_year' => $this->request->getPost('year'),
                'updated_date' => date('Y-m-d')
            ];
            $id = $this->request->getPost('edu_id');
            $query = $this->HomeModel->update_education($data, $id);
            if ($query) {
                $this->session->setFlashdata('success', 'Education Updated !');
                return redirect()->to(base_url('home/profile'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again!');
                return redirect()->to(base_url('home/profile'));
            }
        }
    }

    public function save_job()
    {
        if ($this->request->isAjax()) {
            $rules = [
                'job_id' => ['label' => 'job_id', 'rules' => 'required'],
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . arrayToList($this->validation->getErrors());
                exit;
            }
            $data = [
                'seeker_id' => session('user_id'),
                'job_id' => $this->request->getPost('job_id')
            ];
            $query = $this->HomeModel->save_job($data);
            return $query;
        }
    }

    // Jobs by category
    public function jobs_by_category()
    {
        $data['categories'] = $this->HomeModel->get_categories_with_jobs();
        $data['title'] = 'label_jobs_by_cat';
        $data['meta_description'] = 'your meta description here';
        $data['keywords'] = 'meta tags here';
        // pre($data);
        return view('users/jobs_category_page', $data);
    }

    // Jobs by Industry
    public function jobs_by_industry()
    {
        $data['industries'] = $this->HomeModel->get_industries_with_jobs();

        $data['title'] = 'label_jobs_by_industry';
        $data['meta_description'] = 'your meta description here';
        $data['keywords'] = 'meta tags here';

        return view('users/jobs_industry_page', $data);
    }

    // Jobs by loccation
    public function jobs_by_location()
    {
        $data['cities'] = $this->HomeModel->get_cities_with_jobs();

        $data['title'] = 'label_jobs_by_loc';
        $data['meta_description'] = 'your meta description here';
        $data['keywords'] = 'meta tags here';

        return view('users/jobs_location_page', $data);
    }

    // Jobs by loccation
    public function companies($letter='A')
    {
        $data['companies'] = $this->HomeModel->get_companies($letter);

        $data['title'] = 'top_companies';
        $data['meta_description'] = 'your meta description here';
        $data['keywords'] = 'meta tags here';
        // pre($data);
        return view('users/companies', $data);
    }

	// Company Detail
	public function company_detail($company_id)
	{
		$data['company_info'] = $this->HomeModel->get_company_detail($company_id);

		$data['jobs'] = $this->HomeModel->get_jobs_by_companies($company_id);
		$data['saved_job'] = $this->HomeModel->saved_job_search(session('user_id'));

		$data['title'] = 'company_details';
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		// pre($data['company_info']);
        return view('users/company-details', $data);
	}

}
