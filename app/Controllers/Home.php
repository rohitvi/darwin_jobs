<?php
namespace App\Controllers;
use App\Models\HomeModel;
use App\Models\auth\HomeAuthModel;
use App\Libraries\Mailer;

class Home extends BaseController
{
    public function __construct()
    {
        $this->HomeModel = new HomeModel();
        $this->HomeAuthModel = new HomeAuthModel();
        $this->mailer = new Mailer();
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
                'email' => ['label'=>'email','rules'=>'required'],
                'password' => ['label'=>'password','rules'=>'required']
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~'.$this->validation->getErrors();
                exit;
            }
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $logindata = $this->HomeAuthModel->login_validate($email,$password);
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

    public function profile()
    {
        return view('user/profile');
    }

    //Get States
    function get_country_states()
    {
        $builder = $this->db->table('states');
        $states = $builder->where('country_id',$this->request->getPost('country'))->get()->getResultArray();
        $options = array('' => 'Select State') + array_column($states,'name','id');
        $html = form_dropdown('state',$options,'','class="form-control select2" required');
        $error =  array('msg' => $html);
        echo json_encode($error);
    }

    //Get Cities
    function get_state_cities()
    {
        $builder = $this->db->table('cities');
        $cities = $builder->where('state_id',$this->request->getPost('state'))->get()->getResultArray();

        $options = array('' => 'Select City') + array_column($cities,'name','id');
        $html = form_dropdown('city',$options,'','class="form-control select2" required');
        $error =  array('msg' => $html);
        echo json_encode($error);
    }

    // User Register

    public function register()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'firstname' => ['label'=>'firstname','rules'=>'required'],
                'lastname' => ['label'=>'lastname','rules'=>'required'],
                'email' => ['label'=>'email','rules'=>'required'],
                'password' => ['label'=>'password','rules'=>'required'],
                'cpassword' => ['label'=>'cpassword','rules'=>'required|matches[password]'],
                'termsncondition' => ['label'=>'termsncondition','rules'=>'required']
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~'.$this->validation->getErrors();
                exit;
            }
            $data = [
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'is_verify' => 0,
                'token' => md5(rand(0,1000)),
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

}