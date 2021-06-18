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
                echo '0~Something went wrong, please try again!';
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
}