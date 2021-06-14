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
        helper (['form']);
    }

    public function index()
    {
        // return view('admin/dashboard');
        if (session('admin_logged_in'))
          return redirect()->to('admin/dashboard');
        else
          return redirect()->to('admin/login');
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
            'admin_logged_in' => TRUE,
            'admin_username' => $username
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
        helper( 'form' );
        $data = [];

        if ( $this->request->getMethod() == 'post' ) {
            $input = $this->validate( [
                'category' => 'required|min_length[5]',
            ] );

            if ( $input == true ) {
                //form validated successfully, so we can save values to database
                $model = new AdminModel();
                $model->save( [
                    'name' => $this->request->getPost( 'category' ),
                    'slug' => $this->request->getPost( 'category' )
                ] );

                $session->setFlashdata( 'success', 'Category Added successfully' );
                return redirect()->to( '/admin/list_category' );
                //redirect( base_url( 'admin/category' ) );

            } else {
                //form not validated successfully
                $data['validation'] = $this->validator;
            }

        }

        return view( 'admin/category/add_category', $data );
    }

    public function edit_category( $id ) {

        $session = \Config\Services::session();
        helper( 'form' );

        $model = new AdminModel();
        $category_row = $model->get_row_category( $id );

        if ( empty( $category_row ) ) {
            $session->setFlashdata( 'error', 'Record Not Found.' );
            return redirect()->to( '/admin/list_category' );
        }

        $data = [];
        $data['category_row'] = $category_row;

        if ( $this->request->getMethod() == 'post' ) {
            $input = $this->validate( [
                'category' => 'required|min_length[5]',
            ] );

            if ( $input == true ) {
                //form validated successfully, so we can save values to database
                $model = new AdminModel();
                $model->update( $id, [
                    'name' => $this->request->getPost( 'category' ),
                    'slug' => $this->request->getPost( 'category' )
                ] );

                $session->setFlashdata( 'success', 'Category Update successfully' );
                return redirect()->to( '/admin/list_category' );
                //redirect( base_url( 'admin/category' ) );

            } else {
                //form not validated successfully
                $data['validation'] = $this->validator;
            }

        }
        // pre( $data );
        return view( 'admin/category/edit_category', $data );
    }

    public function del_category( $id = null ) {
        $model = new AdminModel();
        $data['user'] = $model->where( 'id', $id )->delete();
        return redirect()->to( base_url( 'admin/list_category' ) );
    }


    public function list_industry()
    {
      //echo 'hello';    $data['categories'] = $this->am->get_all_categories();
     $data['industry'] = $this->am->get_all_industry();
     return view('admin/industry/list_industry',$data);
    }

    public function add_industry()
    {
      if ($this->request->getMethod() == 'post') {
        $input = $this->validate([  
          'category' => 'required|min_length[5]',
        ]);
      }
      return view('admin/industry/add_industry');
    }

    // Job type

    public function job_type(){
      $data['types'] = $this->adminModel->get_job_type();
      // pre($data['types']);
      return view('admin/job_attributes/job_type',$data);
}
    public function employer()
    {
      $employer['data'] = $this->adminModel->getemployer();
      return view('admin/employer/showemployers', $employer);
    }

    public function addemployer()
    {
      if ($this->request->isAJAX()) {
        $country_id = $this->request->getPost('country_id');
        // return json_encode($this->adminModel->get_states_list($country_id));
        $states = $this->adminModel->get_states_list($country_id);
        return json_encode($states);
        exit();
      }
      $data['categories'] = $this->adminModel->get_all_categories();
      $data['countries'] = $this->adminModel->get_countries_list();
      if ($this->request->getMethod() == 'post') {
        $rules = [
          'firstname' => ['label' => 'firstname', 'rules' => 'required'],
          'lastname' => ['label' => 'lastname', 'rules' => 'required'],
          'email' => ['label' => 'email', 'rules' => 'required'],
          'password' => ['label' => 'password', 'rules' => 'required'],
          'cpassword' => ['label' => 'cpassword', 'rules' => 'required|matches[password]'],
          'company_name' => ['label' => 'company_name', 'rules' => 'required'],
          'category' => ['label' => 'category', 'rules' => 'required'],
          'org_type' => ['label' => 'org_type', 'rules' => 'required'],
          'country' => ['label' => 'country', 'rules' => 'required'],
          'state' => ['label' => 'state', 'rules' => 'required'],
          'city' => ['label' => 'city', 'rules' => 'required'],
          'postcode' => ['label' => 'postcode', 'rules' => 'required'],
          'address' => ['label' => 'address', 'rules' => 'required'],
          'phone_no' => ['label' => 'phone_no', 'rules' => 'required'],
          'website' => ['label' => 'website', 'rules' => 'required'],
          'description' => ['label' => 'description', 'rules' => 'required|min_length[10]']
        ];
        if ($this->validate($rules) == FALSE) {
          echo '0~'.$this->validation->listErrors();exit;
        }
        $emp = [
          'firstname' => $this->request->getPost('firstname'),
          'lastname' => $this->request->getPost('lastname'),
          'email' => $this->request->getPost('email'),
          'password' => $this->request->getPost('password')
        ];
        $cmpny = [
        'company_name' => $this->request->getPost('company_name'),
          'category' => $this->request->getPost('category'),
          'email' => $this->request->getPost('email'),
          'org_type' => $this->request->getPost('org_type'),
          'country' => $this->request->getPost('country'),
          'state' => $this->request->getPost('state'),
          'city' => $this->request->getPost('city'),
          'postcode' => $this->request->getPost('postcode'),
          'address' => $this->request->getPost('address'),
          'phone_no' => $this->request->getPost('phone_no'),
          'website' => $this->request->getPost('website'),
          'description' => $this->request->getPost('description')
        ];
        $emp_id = $this->adminModel->insertemployer($emp);
        $cmpny['employer_id'] = $emp_id[0]->max_id;
        $result = $this->adminModel->insertcmpny($cmpny);
        if ($result->resultID == 1) {
          $this->session->setFlashdata('success', 'Employer and company successfully registered');
          return redirect()->to(base_url('admin/employer'));
        }else
        {
          echo '0~Something went wrong, please try again!';
        }
      }
      return view('admin/employer/addemployers',$data);
    }

    public function editemployer($id)
    {
      $query['data'] = $this->adminModel->editemployer($id);
      $query['categories'] = $this->adminModel->get_all_categories();
      $query['countries'] = $this->adminModel->get_countries_list();
      return view('admin/employer/editemployer',$query);
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
    public function updateemployer($id)
    {
      if ($this->request->getMethod() == 'put') {
        $rules = [
          'firstname' => ['label'=>'firstname','rules'=>'required'],
          'lastname' => ['label'=>'lastname','rules'=>'required'],
          'email' => ['label' => 'email', 'rules' => 'required'],
          'designation' => ['label'=>'designation','rules'=>'required'],
          'mobile_no' => ['label'=>'mobile_no','rules'=>'required'],
          'country' => ['label'=>'country','rules'=>'required'],
          'state' => ['label'=>'state','rules'=>'required'],
          'city' => ['label'=>'city','rules'=>'required'],
          'address' => ['label'=>'address','rules'=>'required']
        ];
        if ($this->validate($rules) == FALSE) {
          echo '0~'.$this->validation->listErrors();exit;
        }
        $data = [
          'firstname' => $this->request->getPost('firstname'),
          'lastname' => $this->request->getPost('lastname'),
          'email' => $this->request->getPost('email'),
          'designation' => $this->request->getPost('designation'),
          'mobile_no' => $this->request->getPost('mobile_no'),
          'country' => $this->request->getPost('country'),
          'state' => $this->request->getPost('state'),
          'city' => $this->request->getPost('city'),
          'address' => $this->request->getPost('address')
        ];
        $query = $this->adminModel->updateemployer($data,$id);
        if ($query == 1) {
          $this->session->setFlashdata('success', 'Employer successfully updated');
          return redirect()->to(base_url('admin/employer'));
        }
        else{
          echo '0~Something went wrong, please try again!';
        }
      }
    }

    public function updatecompany($id)
    {
      if ($this->request->isAJAX()) {
        $cmpny = [
          'company_logo' => $this->request->getPost('company_logo'),
          'company_name' => $this->request->getPost('company_name'),
          'company_email' => $this->request->getPost('company_email'),
          'phone_no' => $this->request->getPost('phone_no'),
          'website' => $this->request->getPost('website'),
          'category' => $this->request->getPost('category'),
          'founded_date' => $this->request->getPost('founded_date'),
          'org_type' => $this->request->getPost('org_type'),
          'no_of_employers' => $this->request->getPost('no_of_employers'),
          'description' => $this->request->getPost('description'),
          'country' => $this->request->getPost('country'),
          'state' => $this->request->getPost('state'),
          'city' => $this->request->getPost('city'),
          'postcode' => $this->request->getPost('postcode'),
          'full_address' => $this->request->getPost('full_address'),
          'facebook_link' => $this->request->getPost('facebook_link'),
          'twitter_link' => $this->request->getPost('twitter_link'),
          'youtube_link' => $this->request->getPost('youtube_link'),
          'linkedin_link' => $this->request->getPost('linkedin_link')
        ];
        return json_encode($cmpny);
        exit();
        // $rules = [
        //   'company_logo' => ['label'=>'company_logo','rules'=>'required'],
        //   'company_name' => ['label'=>'company_name','rules'=>'required'],
        //   'company_email' => ['label'=>'company_email','rules'=>'required'],
        //   'phone_no' => ['label'=>'phone_no','rules'=>'required'],
        //   'category' => ['label'=>'category','rules'=>'required'],
        //   'org_type' => ['label'=>'org_type','rules'=>'required'],
        //   'no_of_employers' => ['label'=>'no_of_employers','rules'=>'required'],
        //   'description' => ['label'=>'description','rules'=>'required'],
        //   'country' => ['label'=>'country','rules'=>'required'],
        //   'state' => ['label'=>'state','rules'=>'required'],
        //   'city' => ['label'=>'city','rules'=>'required'],
        //   'postcode' => ['label'=>'postcode','rules'=>'required'],
        //   'full_address' => ['label'=>'full_address','rules'=>'required'],
        // ];
        // if ($this->validate($rules) == FALSE) {
        //   echo '0~'.$this->validation->listErrors();exit;
        // }
        // $query = $this->adminModel->updatecompany($id);
        // print_r($query);
        // exit();
      }
    }
}