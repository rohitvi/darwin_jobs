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
    }

    public function index()
    {
        // return view('admin/dashboard');
        if (session('admin_logged_in')) {
          return redirect()->to('admin/dashboard');
        }
        else
        {
          return redirect()->to('admin/login');
        }
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
            'admin_logged_in' => TRUE
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
      if ($this->request->getMethod() == 'post') {
        $rules = [
          'username' => ['label'=>'username','rules'=> 'required'],
          'firstname' => ['label'=>'firstname','rules'=> 'required'],
          'lastname' => ['label'=>'lastname','rules'=> 'required'],
          'email' => ['label'=>'email','rules'=> 'required'],
          'password' => ['label'=>'password','rules'=> 'required'],
          'mobile_no' => ['label'=>'mobile_no','rules'=> 'required']
        ];
        if ($this->validate($rules) == FALSE) {
          echo '0~'.$this->validation->listErrors();exit;
        }
        $userdata = [
          'username' => $this->request->getPost('username'),
          'firstname' => $this->request->getPost('firstname'),
          'lastname' => $this->request->getPost('lastname'),
          'email' => $this->request->getPost('email'),
          'password' => $this->request->getPost('password'),
          'mobile_no' => $this->request->getPost('mobile_no'),
        ];
        $regAdmin = $this->adminAuthModel->registeradmin($userdata);
        if($regAdmin->resultID == 1)
        {
          $this->session->setFlashdata('success', 'Admin successfully registered');
          echo '1~successfully registered';
        }else
        {
          echo '0~Something went wrong, please try again!';
        }
      }
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

    public function editadmin($id)
    {
      $query['data'] = $this->adminAuthModel->editadmin($id);
      return view('admin/auth/editadmin',$query);
    }

    public function updateadmin($id)
    {
      if ($this->request->getMethod() == 'put') {
        $data = [
          'username' => $this->request->getPost('username'),
          'firstname' => $this->request->getPost('firstname'),
          'lastname' => $this->request->getPost('lastname'),
          'email' => $this->request->getPost('email'),
          'password' => $this->request->getPost('password'),
          'mobile_no' => $this->request->getPost('mobile_no')
        ];
        if ($query = $this->adminAuthModel->updateadmin($id,$data) == 'done') {
          $this->session->setFlashdata('success', 'Admin updated successfully');
          return redirect()->to(base_url('admin/showadmin'));
        }
      }
    }

    public function deleteadmin($id)
    {
      $delete = $this->adminAuthModel->deleteadmin($id);
      if($delete->resultID == 1)
        {
          $this->session->setFlashdata('success', 'Admin successfully deleted');
          return redirect()->to(base_url('admin/showadmin'));
        }else
        {
          echo '0~Something went wrong, please try again!';
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
          'industry' => 'required|min_length[5]',
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

    public function employer()
    {
      return view('admin/employer/showemployers');
    }

    public function addemployer()
    {
      return view('admin/employer/addemployers');
    }
}