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
        if ($change) 
        {
          $this->session->setFlashdata('success', 'Account successfully updated');
          echo '1~successfully updated';
        }
        else
        {
          echo '0~Something went wrong, please try again!';
        }
      }
      $id = session('admin_id');
      $get['data'] = $this->adminAuthModel->getaccount($id);
      return view('admin/auth/account',$get);
    }

    public function registeradmin()
    {
      if ($this->request->getMethod() == 'post') {
        $rules = [
          'username'=>['label'=>'username','rules'=>'required'],
          'firstname'=>['label'=>'firstname','rules'=>'required'],
          'lastname'=>['label'=>'lastname','rules'=>'required'],
          'email'=>['label'=>'email','rules'=>'required'],
          'mobile_no'=>['label'=>'mobile_no','rules'=>'required'],
          'password'=>['label'=>'password','rules'=>'required'],
        ];
        if ($this->validate($rules) == FALSE) {
          echo '0~'.$this->validation->listErrors();exit;
        }
        $data = [
          'username' => $this->request->getPost('username'),
          'firstname' => $this->request->getPost('firstname'),
          'lastname' => $this->request->getPost('lastname'),
          'email' => $this->request->getPost('email'),
          'mobile_no' => $this->request->getPost('mobile_no'),
          'password' => $this->request->getPost('password'),
        ];
        $query = $this->adminAuthModel->register($data);
        if ($query->resultID == 1) {
          $this->session->setFlashdata('success', 'Admin successfully Registered');
          return redirect()->to(base_url('admin/showadmin'));
        }
        else
        {
          echo '0~Something went wrong, please try again!';
        }
      }
      return view('admin/auth/register');
    }

    public function deleteadmin($id)
      {
        $query = $this->adminAuthModel->deleteadmin($id);
        if ($query->resultID == 1) {
          return redirect()->to(base_url('admin/showadmin'));
        }
        else {
          echo '0~Something went wrong, please try again!';
        }
      }

      public function deleteemployer($id)
      {
        $query = $this->adminModel->deleteemployer($id);
        if ($query->resultID == 1) {
          return redirect()->to(base_url('admin/employer'));
        }
        else {
          echo '0~Something went wrong, please try again!';
        }
      }

    public function payments()
    {
      $get['data'] = $this->adminModel->payment();
      return view('admin/payment/showpayment',$get);
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
          return redirect()->to(base_url('admin/showadmin'));
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

    public function editadmin($id)
    {
      $get['data'] = $this->adminAuthModel->getaccount($id);
      return view('admin/auth/editadmin',$get);
    }

    public function updateadmin($id)
    {
      if ($this->request->getMethod() == 'post') {
        $rules = [
          'username'=>['label'=>'username','rules'=>'required'],
          'firstname'=>['label'=>'firstname','rules'=>'required'],
          'lastname'=>['label'=>'lastname','rules'=>'required'],
          'email'=>['label'=>'email','rules'=>'required'],
          'mobile_no'=>['label'=>'mobile_no','rules'=>'required']
        ];
        if ($this->validate($rules) == FALSE) {
          echo '0~'.$this->validation->listErrors();exit;
        }
        $data = [
          'username' => $this->request->getPost('username'),
          'firstname' => $this->request->getPost('firstname'),
          'lastname' => $this->request->getPost('lastname'),
          'email' => $this->request->getPost('email'),
          'mobile_no' => $this->request->getPost('mobile_no')
        ];
        $query = $this->adminAuthModel->account($data,$id);
        if ($query) 
        {
          $this->session->setFlashdata('success', 'Account successfully updated');
          return redirect()->to(base_url('admin/showadmin'));
        }
        else
        {
          echo '0~Something went wrong, please try again!';
        }
      }
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
        $data = [];
        if ( $this->request->getMethod() == 'post' ) {
            $input = $this->validate( [
                'category' => 'required|min_length[5]',
            ] );

              if ($input == true) {
                $addcategorydata=[
                  'name' => $this->request->getPost( 'category' ),
                  'slug' => $this->request->getPost( 'category' ),
              ];
                $addcategory = $this->adminModel->add_category($addcategorydata);
                //$session->setFlashdata( 'success', 'Category Added successfully' );
                return redirect()->to( '/admin/list_category' );
              } else {
                //form not validated successfully
                $data['validation'] = $this->validator;
              }
        }
        return view( 'admin/category/add_category', $data );
    }

    public function edit_category($id) 
    {
        //$session = \Config\Services::session();
        $category_row = $this->adminModel->get_category_by_id( $id );
        $data['category_row'] = $category_row;

        if ( $this->request->getMethod() == 'post' ) {
            $input = $this->validate( [
                'category' => 'required|min_length[5]',
            ] );
            if ( $input == true ) {
              $editcategory=[
                'name' => $this->request->getPost( 'category' ),
                'slug' => $this->request->getPost( 'category' ),
            ];
                $editcategorydata = $this->adminModel->edit_category($editcategory,$id);
                //$session->setFlashdata( 'success', 'Category Update successfully' );
                return redirect()->to( '/admin/list_category' );
            } else {
                //form not validated successfully
                $data['validation'] = $this->validator;
                }
        }
        return view( 'admin/category/edit_category', $data );
    }

    public function del_category($id) {
        $this->adminModel->del_category($id);
        return redirect()->to( base_url( 'admin/list_category' ) );
    }


    public function list_industry()
    {
      $data['industry'] = $this->adminModel->get_all_industry();
      return view('admin/industry/list_industry',$data);
    }

    public function add_industry()
    {
      $data = [];
      if ($this->request->getMethod() == 'post') {
        $input = $this->validate([  
          'industry' => 'required|min_length[5]'
        ]);
      if ($input == true) {
        $addindustrydata=[
          'name' => $this->request->getPost( 'industry' ),
          'slug' => $this->request->getPost( 'industry' ),
      ];
      $addindustry = $this->adminModel->add_industry($addindustrydata);
      return redirect()->to( '/admin/list_industry' );
      }
      else{
        $data['validation']= $this->validator;
          }
      }
      return view('admin/industry/add_industry', $data);
    }

    public function edit_industry($id) 
    {
      $industry_row = $this->adminModel->get_industry_by_id( $id );
      $data['industry_row'] = $industry_row;
      // pre( $data );
      if ($this->request->getMethod() == 'post') {
        $input = $this->validate([  
          'industry' => 'required|min_length[5]',
        ]);

        if ($input == true) {
          $editindustry=[
            'name' => $this->request->getPost( 'industry' ),
            'slug' => $this->request->getPost( 'industry' ),
        ];
        $editindustrydata = $this->adminModel->edit_industry($editindustry,$id);
          return redirect()->to( '/admin/list_industry' );
        }
        else{
          $data['validation']= $this->validator;
            }
      }
      return view( 'admin/industry/edit_industry', $data );
    } 

    public function del_industry($id)
    {
      $this->adminModel->del_industry($id);
      return redirect()->to( '/admin/list_industry' );
    }

    public function list_packages()
    {
      $data['packages'] = $this->adminModel->get_all_packages();
      return view('admin/packages/list_packages',$data);
    }

    public function add_packages()
    {
      $data = [];
      if ($this->request->getMethod() == 'post') {
        $input = $this->validate([  
          'title' => 'required',
          'price' => 'required',
          'detail' => 'required',
          'no_of_days' => 'required',
          'no_of_posts' => 'required',
          'sort_order' => 'required'
        ]);
      if ($input == true) {
      $addpackage=[
        'title' => $this->request->getPost( 'title' ),
        'slug' => $this->request->getPost( 'title' ),
        'price' => $this->request->getPost( 'price' ),
        'detail' => $this->request->getPost( 'detail' ),
        'no_of_days' => $this->request->getPost( 'no_of_days' ),
        'no_of_posts' => $this->request->getPost( 'no_of_posts' ),
        'sort_order' => $this->request->getPost( 'sort_order' )
    ];
      $addpack = $this->adminModel->add_packages($addpackage);
      return redirect()->to( '/admin/list_packages' );
    }
      else{
        $data['validation']= $this->validator;
        }
      }
      return view('admin/packages/add_packages',$data);
    }

    public function edit_packages($id)
    {
      $packages_row = $this->adminModel->get_packages_by_id( $id );
      $data['packages_row'] = $packages_row;

      if ($this->request->getMethod() == 'post') {
        $input = $this->validate([  
          'title' => 'required',
          'price' => 'required',
          'detail' => 'required',
          'no_of_days' => 'required',
          'no_of_posts' => 'required',
          'sort_order' => 'required',
          'status' => 'required'
        ]);
      if ($input == true) {
      $editpackage=[
        'title' => $this->request->getPost( 'title' ),
        'slug' => $this->request->getPost( 'title' ),
        'price' => $this->request->getPost( 'price' ),
        'detail' => $this->request->getPost( 'detail' ),
        'no_of_days' => $this->request->getPost( 'no_of_days' ),
        'no_of_posts' => $this->request->getPost( 'no_of_posts' ),
        'sort_order' => $this->request->getPost( 'sort_order' ),
        'is_active' => $this->request->getPost( 'status' )
    ];
      $editpack = $this->adminModel->edit_packages($editpackage,$id);
      return redirect()->to( '/admin/list_packages' );
      }
      else{
          $data['validation']= $this->validator;
          }
      }

      return view('admin/packages/edit_packages',$data);
    }

    // Job type

    public function job_type(){
      $data['types'] = $this->adminModel->get_job_type();
      return view('admin/job_attributes/job_type',$data);
    }

    public function addjob()
    {
      if ($this->request->getMethod() == 'post') {
        $rules = ['type'=> ['label'=>'type','rules'=>'required']];
        if ($this->validate($rules) == FALSE) {
          echo '0~'.$this->validation->listErrors();exit;
        }
        $data = ['type' => $this->request->getPost('type')];
        $query = $this->adminModel->addjob($data);
        if ($query->resultID == 1) {
          $this->session->setFlashdata('success', 'Job successfully added');
          return redirect()->to(base_url('admin/job_type'));
        }else
        {
          echo '0~Something went wrong, please try again!';
        }
      }
      return view('admin/job_attributes/add_job_type');
    }

    public function editjob($id)
    {
      $get['data'] = $this->adminModel->editjob($id);
      return view('admin/job_attributes/edit_job_type',$get);
    }

    public function updatejob($id)
    {
      if ($this->request->getMethod() == 'put') {
        $rules = [
          'type' => ['label'=>'type','rules'=>'required']
        ];
        if ($this->validate($rules) == FALSE) {
          echo '0~'.$this->validation->listErrors();exit;
        }
        $data = ['type' => $this->request->getPost('type')];
        $query = $this->adminModel->updatejob($id,$data);
        if ($query == 1) {
          $this->session->setFlashdata('success', 'Job successfully updated');
          return redirect()->to(base_url('admin/job_type'));
        }else
        {
          echo '0~Something went wrong, please try again!';
        }
      }
    }

    public function deletejob($id)
    {
      $query = $this->adminModel->deletejob($id);
      if ($query->resultID == 1) {
        $this->session->setFlashdata('success', 'Job successfully deleted');
          return redirect()->to(base_url('admin/job_type'));
        }else
        {
          echo '0~Something went wrong, please try again!';
        }
    }

    // Education

    public function education()
    {
      $get['data'] = $this->adminModel->education();
      return view('admin/education/education',$get);
    }

    public function addeducation()
    {
      if ($this->request->getMethod() == 'post') {
        $rules = ['type'=> ['label'=>'type','rules'=>'required']];
        if ($this->validate($rules) == FALSE) {
          echo '0~'.$this->validation->listErrors();exit;
        }
        $data = ['type' => $this->request->getPost('type')];
        $query = $this->adminModel->addeducation($data);
        if ($query->resultID == 1) {
          $this->session->setFlashdata('success', 'Education successfully added');
          return redirect()->to(base_url('admin/education'));
        }else
        {
          echo '0~Something went wrong, please try again!';
        }
      }
      return view('admin/education/add_education');
    }

    public function editeducation($id)
    {
      $get['data'] = $this->adminModel->editeducation($id);
      return view('admin/education/edit_education',$get);
    }

    public function updateeducation($id)
    {
      if ($this->request->getMethod() == 'put') {
        $rules = [
          'type' => ['label'=>'type','rules'=>'required']
        ];
        if ($this->validate($rules) == FALSE) {
          echo '0~'.$this->validation->listErrors();exit;
        }
        $data = ['type' => $this->request->getPost('type')];
        $query = $this->adminModel->updateeducation($id,$data);
        if ($query == 1) {
          $this->session->setFlashdata('success', 'Education successfully updated');
          return redirect()->to(base_url('admin/education'));
        }else
        {
          echo '0~Something went wrong, please try again!';
        }
      }
    }

    public function deleteeducation($id)
    {
      $query = $this->adminModel->deleteeducation($id);
      if ($query->resultID == 1) {
        $this->session->setFlashdata('success', 'Education successfully deleted');
          return redirect()->to(base_url('admin/education'));
        }else
        {
          echo '0~Something went wrong, please try again!';
        }
    }

    // Employment

    public function employment()
    {
      $get['data'] = $this->adminModel->employment();
      return view('admin/employment/employment',$get);
    }

    public function addemployment()
    {
      if ($this->request->getMethod() == 'post') {
        $rules = ['type'=> ['label'=>'type','rules'=>'required']];
        if ($this->validate($rules) == FALSE) {
          echo '0~'.$this->validation->listErrors();exit;
        }
        $data = ['type' => $this->request->getPost('type')];
        $query = $this->adminModel->addemployment($data);
        if ($query->resultID == 1) {
          $this->session->setFlashdata('success', 'Employment successfully added');
          return redirect()->to(base_url('admin/employment'));
        }else
        {
          echo '0~Something went wrong, please try again!';
        }
      }
      return view('admin/employment/add_employment');
    }

    public function editemployment($id)
    {
      $get['data'] = $this->adminModel->editemployment($id);
      return view('admin/employment/edit_employment',$get);
    }

    public function updateemployment($id)
    {
      if ($this->request->getMethod() == 'put') {
        $rules = [
          'type' => ['label'=>'type','rules'=>'required']
        ];
        if ($this->validate($rules) == FALSE) {
          echo '0~'.$this->validation->listErrors();exit;
        }
        $data = ['type' => $this->request->getPost('type')];
        $query = $this->adminModel->updateemployment($id,$data);
        if ($query == 1) {
          $this->session->setFlashdata('success', 'Employment successfully updated');
          return redirect()->to(base_url('admin/employment'));
        }else
        {
          echo '0~Something went wrong, please try again!';
        }
      }
    }

    public function deleteemployment($id)
    {
      $query = $this->adminModel->deleteemployment($id);
      if ($query->resultID == 1) {
        $this->session->setFlashdata('success', 'Employment successfully deleted');
          return redirect()->to(base_url('admin/employment'));
        }else
        {
          echo '0~Something went wrong, please try again!';
        }
    }

    // Employer

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
        $rules = [
          'company_logo'  => ['uploaded[company_logo]','max_size[company_logo,1024]'],
          'company_name' => ['label'=>'company_name','rules'=>'required'],
          'company_email' => ['label'=>'company_email','rules'=>'required'],
          'phone_no' => ['label'=>'phone_no','rules'=>'required'],
          'category' => ['label'=>'category','rules'=>'required'],
          'org_type' => ['label'=>'org_type','rules'=>'required'],
          'no_of_employers' => ['label'=>'no_of_employers','rules'=>'required'],
          'description' => ['label'=>'description','rules'=>'required'],
          'country' => ['label'=>'country','rules'=>'required'],
          'state' => ['label'=>'state','rules'=>'required'],
          'city' => ['label'=>'city','rules'=>'required'],
          'postcode' => ['label'=>'postcode','rules'=>'required'],
          'full_address' => ['label'=>'full_address','rules'=>'required'],
        ];
        if ($this->validate($rules) == FALSE) {
          echo '0~'.$this->validation->listErrors();exit;
        }
        $result = UploadFile($_FILES['company_logo']);
          if($result['status'] == true){
            $url = $result['result']['file_url'];
          }else{
            echo '0~'.$result['message'];exit;
          }

            $cmpny = [
              'company_logo' => $url,
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
            $query = $this->adminModel->updatecompany($id,$cmpny);
            if ($query == 1) {
              return 'success';
            }
      }
    }

    public function users()
    {
      $get['data'] = $this->adminModel->users();
      return view('admin/users/showusers.php',$get);
    }

    public function adduser()
    {
      if ($this->request->getMethod() == 'post') {
        $rules = [
          'firstname'=>['label'=>'firstname','rules'=>'required'],
          'lastname'=>['label'=>'lastname','rules'=>'required'],
          'email'=>['label'=>'email','rules'=>'required'],
          'mobile_no'=>['label'=>'mobile_no','rules'=>'required'],
          'password'=>['label'=>'password','rules'=>'required'],
          'address'=>['label'=>'address','rules'=>'required']
        ];
        if ($this->validate($rules) == FALSE) {
          echo '0~'.$this->validation->listErrors();exit;
        }
        $data = [
          'firstname' => $this->request->getPost('firstname'),
          'lastname' => $this->request->getPost('lastname'),
          'email' => $this->request->getPost('email'),
          'mobile_no' => $this->request->getPost('mobile_no'),
          'password' => $this->request->getPost('password'),
          'address' => $this->request->getPost('address')
        ];
        $query = $this->adminModel->adduser($data);
        if ($query->resultID == 1) {
          $this->session->setFlashdata('success', 'User successfully added');
          return redirect()->to(base_url('admin/users'));
        }
        else{
          echo '0~Something went wrong, please try again!';
        }
      }
      return view('admin/users/adduser');
    }

    public function edituser($id)
    {
      $get['data'] = $this->adminModel->edituser($id);
      return view('admin/users/edituser',$get);
    }

    public function updateuser($id)
    {
      if ($this->request->getMethod() == 'put') {
        $rules = [
          'firstname' => ['label'=>'firstname','rules'=>'required'],
          'lastname' => ['label'=>'lastname','rules'=>'required'],
          'email' => ['label'=>'email','rules'=>'required'],
          'mobile_no' => ['label'=>'mobile_no','rules'=>'required'],
          'is_active' => ['label'=>'is_active','rules'=>'required'],
        ];
        if ($this->validate($rules) == FALSE) {
          echo '0~'.$this->validation->listErrors();exit;
        }
        $data = [
          'firstname' => $this->request->getPost('firstname'),
          'lastname' => $this->request->getPost('lastname'),
          'email' => $this->request->getPost('email'),
          'mobile_no' => $this->request->getPost('mobile_no'),
          'is_active' => $this->request->getPost('is_active'),
        ];
        $query = $this->adminModel->updateuser($id,$data);
        if ($query == 1) {
          $this->session->setFlashdata('success', 'User successfully updated');
          return redirect()->to(base_url('admin/users'));
        }
        else{
          echo '0~Something went wrong, please try again!';
        }
      }
    }

    public function deleteuser($id)
    {
      $query = $this->adminModel->deleteuser($id);
      if ($query->resultID == 1) {
        $this->session->setFlashdata('success', 'User successfully deleted');
          return redirect()->to(base_url('admin/users'));
        }
        else{
          echo '0~Something went wrong, please try again!';
      }
    }
}