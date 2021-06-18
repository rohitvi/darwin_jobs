<?php
namespace App\Controllers;
use App\Models\EmployerModel;
use App\Models\auth\EmployerAuthModel;
use App\Models\AdminModel;


class Employer extends BaseController
{
   public function __construct()
   {
       $this->EmployerModel = new EmployerModel();
       $this->EmployerAuthModel = new EmployerAuthModel();
       $this->adminModel = new AdminModel();
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

    public function personal_info_update(){

        $rules = [
            'profile_picture'  => ['uploaded[profile_picture]','max_size[profile_picture,1024]']
        ];
            $result = UploadFile($_FILES['profile_picture']);
            if($result['status'] == true){
                $url = $result['result']['file_url'];
            }else{
                echo '0~'.$result['message'];exit;
                }
        if ($this->request->getMethod() == 'post') {
                    $update_per_info=[
                        'firstname' => $this->request->getPost( 'fname' ),
                        'lastname' => $this->request->getPost( 'lastname' ),
                        'email' => $this->request->getPost( 'email' ),
                        'designation' => $this->request->getPost( 'designation' ),
                        'mobile_no' => $this->request->getPost( 'phoneno' ),
                        'country' => $this->request->getPost( 'country' ),
                        'state' => $this->request->getPost( 'state' ),
                        'city' => $this->request->getPost( 'city' ),
                        'profile_picture' => $url,
                        'address' => $this->request->getPost( 'address' )
                    ];
                    $id = session('employer_id');
                    $update_per = $this->EmployerAuthModel->personal_info_update($update_per_info,$id);
                    return redirect()->to(base_url('employer/profile'));
        }
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
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('admin/changepassword'));
            }
        }
        return view('employer/auth/changepassword');
    }

    public function profile()
    {
        if ($this->request->isAJAX()) {
            $country_id = $this->request->getPost('country_id');
            $states = $this->adminModel->get_states_list($country_id);
            return json_encode($states);
            exit();
        }
        $id = session('employer_id');

        $get['categories'] = $this->adminModel->get_all_categories();
        $get['countries'] = $this->adminModel->get_countries_list(); 
        $get['data'] = $this->EmployerAuthModel->personal_info($id);
        $get['cmpinfo']= $this->EmployerAuthModel->cmp_info($id);
        return view('employer/auth/profile',$get);
    }

    public function getcities()
    {
      if ($this->request->isAJAX()) {
        $state = $this->request->getPost('state_id');
        $cities = $this->adminModel->get_cities_list($state);
        return json_encode($cities);
        exit();
      }
    }

    public function cmp_info_update(){

        $rules = [
            'company_logo'  => ['uploaded[company_logo]','max_size[company_logo,1024]']
        ];

            $result = UploadFile($_FILES['company_logo']);
            if($result['status'] == true){
                $url = $result['result']['file_url'];
            }else{
                echo '0~'.$result['message'];exit;
                }
        if ($this->request->getMethod() == 'post') {
            $cmp_info_update=[
                'company_logo' => $url,
                'company_name' => $this->request->getPost( 'company_name' ),
                'email' => $this->request->getPost( 'company_email' ),
                'phone_no' => $this->request->getPost( 'phone_no' ),
                'website' => $this->request->getPost( 'website' ),
                'category' => $this->request->getPost( 'category' ),
                'founded_date' => $this->request->getPost( 'founded_date' ),
                'org_type' => $this->request->getPost( 'org_type' ),
                'no_of_employers' => $this->request->getPost( 'no_of_employers' ),
                'description' => $this->request->getPost( 'description' ),
                'country' => $this->request->getPost( 'country' ),
                'state' => $this->request->getPost( 'state' ),
                'city' => $this->request->getPost( 'city' ),
                'postcode' => $this->request->getPost( 'postcode' ),
                'address' => $this->request->getPost( 'full_address' ),
                'facebook_link' => $this->request->getPost( 'facebook_link' ),
                'twitter_link' => $this->request->getPost( 'twitter_link' ),
                'youtube_link' => $this->request->getPost( 'youtube_link' ),
                'linkedin_link' => $this->request->getPost( 'linkedin_link' )
            ];
            $id = session('employer_id');
            $update_per = $this->EmployerAuthModel->cmp_info_update($cmp_info_update,$id);
            return redirect()->to(base_url('employer/profile'));
        }
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
                    $this->session->setFlashdata('error', 'Something went wrong, please try again');
                    return redirect()->to(base_url('admin/packages'));
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
                      $this->session->setFlashdata('error', 'Something went wrong, please try again');
                        return redirect()->to(base_url('admin/packages'));
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
              $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('admin/login'));
            }
        }
    }

    public function shortlisted()
    {   
        $id = session('employer_id');
        $get['data'] = $this->EmployerModel->shortlisted($id);
        return view('employer/resume/shortlisted_resume',$get);
    }

    public function userdetails()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('user_id');
            $education = $this->EmployerModel->get_seeker_education($id);
            $experience = $this->EmployerModel->get_user_experience($id);
            $language = $this->EmployerModel->get_user_language($id);
            $query = $this->EmployerModel->userdetails($id);
            $html = '<div class="row">
                        <div class="col-6">
                            <h4>Personal Details</h4>
                            <hr>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Full Name</td>
                                        <td>'.$query[0]["firstname"].' '.$query[0]["lastname"].'</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>'.$query[0]["email"].'</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>'.$query[0]["mobile_no"].'</td>
                                    </tr>
                                    <tr>
                                        <td>Date Of Birth</td>
                                        <td>'.$query[0]["dob"].'</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>'.get_category_name($query[0]["category"]).'</td>
                                    </tr>
                                    <tr>
                                        <td>User Job Title</td>
                                        <td>'.($query[0]["job_title"]).'</td>
                                    </tr>
                                    <tr>
                                        <td>Experience</td>
                                        <td>'.$query[0]["experience"].' years</td>
                                    </tr>
                                    <tr>
                                        <td>Skills</td>
                                        <td>'.$query[0]["skills"].'</td>
                                    </tr>
                                    <tr>
                                        <td>Current Salary (INR)</td>
                                        <td>'.$query[0]["current_salary"].' (INR)</td>
                                    </tr>
                                    <tr>
                                        <td>Nationality</td>
                                        <td>'.get_country_name($query[0]["nationality"]).'</td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td>'.get_country_name($query[0]["country"]).'</td>
                                    </tr>
                                    <tr>
                                        <td>City / Town</td>
                                        <td>'.get_city_name($query[0]["city"]).'</td>
                                    </tr>
                                    <tr>
                                        <td>Postcode</td>
                                        <td>'.$query[0]["postcode"].'</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>'.$query[0]["address"].'</td>
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
                            <p>'.$education[0]["type"].','.$education[0]["degree_title"].'</p>
                            <p>'.$education[0]["institution"].'</p>
                            <p>'.$education[0]["completion_year"].'</p>
                            <h4>Experience</h4>
                            <hr>
                            <p>'.$experience[0]["job_title"].'</p>
                            <p>'.$experience[0]["company"].'</p>
                            <p>'.get_month($experience[0]["starting_month"]).' '.$experience[0]["starting_year"].' - '.$experience[0]["ending_month"].' '.$experience[0]["ending_year"].' | '.get_country_name($experience[0]["country"]).'</p>
                            <p>'.$experience[0]["job_title"].'</p>
                            <p>'.$experience[0]["description"].'</p>
                            <h4>Languages</h4>
                            <hr>
                            <p>'.$language[0]["lang_name"].'</p>
                        </div>            
                    </div>';
            return ($html);
        }
    }

    public function getstates()
    {
        if ($this->request->isAJAX()) {
            $country_id = $this->request->getPost('country_id');
            $states = get_country_states($country_id);
            return json_encode($states);
            exit();
        }
    }

    // make job slugon
    private function make_job_slug($job_title, $city)
    {
        $final_job_url = '';
        $job_title = trim($job_title);
        $city = get_city_name($city);
        $job_title_slug = make_slug($job_title) . '-job-in-' . make_slug($city);  // make slug is a helper function
        $final_job_url = $job_title_slug;
        return $final_job_url;
    }

    public function post()
    {   
        $get['companies'] = $this->EmployerModel->get_companies();
        $get['job_type'] = get_job_type_list();
        $get['job_category'] = get_category_list();
        $get['industry'] = get_industry_list();
        $get['employment'] = get_employment_type_list();
        $get['educations'] = $this->EmployerModel->get_education();
        $get['countries'] = $this->EmployerModel->get_countries_list();
        return view('employer/job/post',$get);
    }

    public function postjob()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                "employer_id"       => ["label" => "employer_id", "rules" => "trim|required"],
                "company_id"       => ["label" => "company_id", "rules" => "trim|required"],
                "job_title"         => ["label" => "job_title", "rules" => "trim|required"],
                "category"          => ["label" => "category", "rules" => "trim|required"],
                "industry"          => ["label" => "industry", "rules" => "trim|required"],
                "min_experience"    => ["label" => "min_experience", "rules" => "trim|required"],
                "max_experience"    => ["label" => "max_experience", "rules" => "trim|required"],
                "salary_period"     => ["label" => "salary period", "rules" => "trim|required"],
                "min_salary"        => ["label" => "min_salary", "rules" => "trim|required"],
                "max_salary"        => ["label" => "max_salary", "rules" => "trim|required"],
                "skills"            => ["label" => "skills", "rules" => "trim|required"],
                "description"       => ["label" => "description", "rules" => "trim|required|min_length[3]"],
                "total_positions"   => ["label" => "total_positions", "rules" => "trim|required"],
                "gender"            => ["label" => "gender", "rules" => "trim|required"],
                "employment_type"   => ["label" => "employment type", "rules" => "trim|required"],
                "education"         => ["label" => "education", "rules" => "trim|required"],
                "country"           => ["label" => "country", "rules" => "trim|required"],
                "state"              => ["label" => "state", "rules" => "trim|required"],
                "city"              => ["label" => "city", "rules" => "trim|required"],
                "location"          => ["label" => "location", "rules" => "trim|required"],
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~'.$this->validation->listErrors();exit;
            }
            $data = array(
                    'employer_id'   => $this->request->getPost('employer_id'),
                    'company_id'    => $this->request->getPost('company_id'),
                    'title'         => $this->request->getPost('job_title'),
                    'job_type'      => $this->request->getPost('job_type'),
                    'category'      => $this->request->getPost('category'),
                    'employment_type' => $this->request->getPost('employment_type'),
                    'industry'      => $this->request->getPost('industry'),
                    'description'   => $this->request->getPost('description'),
                    'salary_period' => $this->request->getPost('salary_period'),
                    'min_salary'    => $this->request->getPost('min_salary'),
                    'max_salary'    => $this->request->getPost('max_salary'),
                    'education'     => $this->request->getPost('education'),
                    'experience'    => $this->request->getPost('min_experience') . '-' . $this->request->getPost('max_experience'),
                    'gender'        => $this->request->getPost('gender'),
                    'total_positions' => $this->request->getPost('total_positions'),
                    'skills'        => $this->request->getPost('skills'),
                    'country'       => $this->request->getPost('country'),
                    'state'         => $this->request->getPost('state'),
                    'city'          => $this->request->getPost('city'),
                    'location'      => $this->request->getPost('location'),
                    'created_date'  => date('Y-m-d : H:i:s'),
                    'updated_date'  => date('Y-m-d : H:i:s')
                );
            $data['job_slug'] = $this->make_job_slug($this->request->getPost('job_title'),$this->request->getPost('city'));
            $query = $this->EmployerModel->postjob($data);
            if ($query->resultID == 1) {
                $this->session->setFlashdata('success', 'Job successfully posted');
                return redirect()->to(base_url('employer/list_jobs'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('employer/post'));
            }
        }
    }

    public function list_jobs()
    {
        return view('employer/job/job_list');
    }
}