<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\auth\AuthModel;
use App\Libraries\Mailer;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->adminAuthModel = new AuthModel();
        $this->adminModel = new AdminModel();
        $this->mailer = new Mailer();
        helper(['form']);
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
        $data['title'] = 'Dashboard';
        return view('admin/dashboard',$data);
    }

    public function login()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'username' => ['label' => 'username', 'rules' => 'required'],
                'password' => ['label' => 'password', 'rules' => 'required']
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~' . arrayToList($this->validation->getErrors());
                exit;
            }
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $logindata = $this->adminAuthModel->login_validate($username, $password);
            if ($logindata == 0) {
                echo '0~Invalid email or password';
                exit;
            } elseif ($logindata['id'] == 1) {
                $admindata = [
                    'admin_id' => $logindata['id'],
                    'admin_logged_in' => TRUE,
                    'admin_username' => $username
                ];
                $this->session->set($admindata);
                echo '1~ You Have Successfully Logged in';
                exit;
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
            $change = $this->adminAuthModel->account($data, $id);
            if ($change) {
                $this->session->setFlashdata('success', 'Account successfully updated');
                echo '1~successfully updated';
            } else {
                echo '0~Something went wrong, please try again!';
            }
        }
        $id = session('admin_id');
        $get['data'] = $this->adminAuthModel->getaccount($id);
        $get['title'] = 'My Profile';
        return view('admin/auth/account', $get);
    }

    public function registeradmin()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => ['label' => 'username', 'rules' => 'required'],
                'firstname' => ['label' => 'firstname', 'rules' => 'required'],
                'lastname' => ['label' => 'lastname', 'rules' => 'required'],
                'email' => ['label' => 'email', 'rules' => 'required'],
                'mobile_no' => ['label' => 'mobile_no', 'rules' => 'required'],
                'password' => ['label' => 'password', 'rules' => 'required'],
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~' . $this->validation->listErrors();
                exit;
            }
            $data = [
                'username' => $this->request->getPost('username'),
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'mobile_no' => $this->request->getPost('mobile_no'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            $query = $this->adminAuthModel->register($data);
            if ($query->resultID == 1) {
                $this->session->setFlashdata('success', 'Admin successfully Registered');
                return redirect()->to(base_url('admin/showadmin'));
            } else {
                echo '0~Something went wrong, please try again!';
            }
        }
        $data['title'] = 'Register Admin';
        return view('admin/auth/register',$data);
    }

    public function deleteadmin($id)
    {
        $query = $this->adminAuthModel->deleteadmin($id);
        if ($query->resultID == 1) {
            return redirect()->to(base_url('admin/showadmin'));
        } else {
            echo '0~Something went wrong, please try again!';
        }
    }

    public function deleteemployer($id)
    {
        $query = $this->adminModel->deleteemployer($id);
        if ($query->resultID == 1) {
            return redirect()->to(base_url('admin/employer'));
        } else {
            echo '0~Something went wrong, please try again!';
        }
    }

    public function payments()
    {
        $get['data'] = $this->adminModel->payment();
        $get['title'] = 'Payments';
        return view('admin/payment/showpayment', $get);
    }

    public function changepassword()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'password' => ['label' => 'password', 'rules' => 'required'],
                'cpassword' => ['label' => 'password', 'rules' => 'required|matches[password]']
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~' . $this->validation->listErrors();
                exit;
            }
            $id = session('admin_id');
            $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $update = $this->adminAuthModel->changepassword($password, $id);
            if ($update == 'done') {
                $this->session->setFlashdata('success', 'Password changed successfully');
                return redirect()->to(base_url('admin/showadmin'));
            } else {
                $this->session->setFlashdata('error', 'Please try again');
                return redirect()->to('/');
            }
        }
        $data['title'] = 'Change Password';
        return view('admin/auth/changepassword',$data);
    }

    public function showadmin()
    {
        $result['admin'] = $this->adminAuthModel->showadmin();
        $result['title'] = 'Admin List';
        return view('admin/showadmin.php', $result);
    }

    public function editadmin($id)
    {
        $get['data'] = $this->adminAuthModel->getaccount($id);
        $get['title'] = 'Edit Admin';
        return view('admin/auth/editadmin', $get);
    }

    public function updateadmin($id)
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => ['label' => 'username', 'rules' => 'required'],
                'firstname' => ['label' => 'firstname', 'rules' => 'required'],
                'lastname' => ['label' => 'lastname', 'rules' => 'required'],
                'email' => ['label' => 'email', 'rules' => 'required'],
                'mobile_no' => ['label' => 'mobile_no', 'rules' => 'required']
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~' . $this->validation->listErrors();
                exit;
            }
            $data = [
                'username' => $this->request->getPost('username'),
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'mobile_no' => $this->request->getPost('mobile_no')
            ];
            $query = $this->adminAuthModel->account($data, $id);
            if ($query) {
                $this->session->setFlashdata('success', 'Account successfully updated');
                return redirect()->to(base_url('admin/showadmin'));
            } else {
                echo '0~Something went wrong, please try again!';
            }
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }

    public function list_category()
    {
        $data['categories'] = $this->adminModel->get_all_categories();
        //$data['categories'] = $model->get_all_categories();
        $data['title'] = 'List Category';
        return view('admin/category/list_category', $data);
    }

    public function add_category()
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $input = $this->validate([
                'category' => 'required|min_length[5]',
            ]);

            if ($input == true) {
                $addcategorydata = [
                    'name' => $this->request->getPost('category'),
                    'slug' => $this->request->getPost('category'),
                ];
                $addcategory = $this->adminModel->add_category($addcategorydata);
                $this->session->setFlashdata('status', 'Category Added successfully');
                return redirect()->to('/admin/list_category')->with('status_icon', 'success');
            } else {
                //form not validated successfully
                $data['validation'] = $this->validator;
            }
        }
        $data['title'] = 'Add Category';
        return view('admin/category/add_category', $data);
    }

    public function edit_category($id)
    {
        $category_row = $this->adminModel->get_category_by_id($id);
        $data['category_row'] = $category_row;

        if ($this->request->getMethod() == 'post') {
            $input = $this->validate([
                'category' => 'required|min_length[5]',
            ]);
            if ($input == true) {
                $editcategory = [
                    'name' => $this->request->getPost('category'),
                    'slug' => $this->request->getPost('category'),
                ];
                $editcategorydata = $this->adminModel->edit_category($editcategory, $id);
                $this->session->setFlashdata('status', 'Category Updated Successfully');
                return redirect()->to('/admin/list_category')->with('status_icon', 'success');
            } else {
                //form not validated successfully
                $data['validation'] = $this->validator;
            }
        }
        $data['title'] = 'Edit Category';
        return view('admin/category/edit_category', $data);
    }

    public function del_category($id)
    {
        $this->adminModel->del_category($id);
        return redirect()->to(base_url('admin/list_category'));
    }

    public function list_industry()
    {
        $data['industry'] = $this->adminModel->get_all_industry();
        $data['title'] = 'List Industry';
        return view('admin/industry/list_industry', $data);
    }

    public function add_industry()
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $input = $this->validate([
                'industry' => 'required|min_length[5]'
            ]);
            if ($input == true) {
                $addindustrydata = [
                    'name' => $this->request->getPost('industry'),
                    'slug' => $this->request->getPost('industry'),
                ];
                $addindustry = $this->adminModel->add_industry($addindustrydata);
                $this->session->setFlashdata('status', 'Industry Added Successfully');
                return redirect()->to('/admin/list_industry')->with('status_icon', 'success');
            } else {
                $data['validation'] = $this->validator;
            }
        }
        $data['title'] = 'Add Industry';
        return view('admin/industry/add_industry', $data);
    }

    public function edit_industry($id)
    {
        $industry_row = $this->adminModel->get_industry_by_id($id);
        $data['industry_row'] = $industry_row;
        // pre( $data );
        if ($this->request->getMethod() == 'post') {
            $input = $this->validate([
                'industry' => 'required|min_length[5]',
            ]);

            if ($input == true) {
                $editindustry = [
                    'name' => $this->request->getPost('industry'),
                    'slug' => $this->request->getPost('industry'),
                ];
                $editindustrydata = $this->adminModel->edit_industry($editindustry, $id);
                $this->session->setFlashdata('status', 'Industry Updated Successfully');
                return redirect()->to('/admin/list_industry')->with('status_icon', 'success');
            } else {
                $data['validation'] = $this->validator;
            }
        }
        $data['title'] = 'Edit Industry';
        return view('admin/industry/edit_industry', $data);
    }

    public function del_industry($id)
    {
        $this->adminModel->del_industry($id);
        $this->session->setFlashdata('status', 'Industry Deleted Successfully');
        return redirect()->to('/admin/list_industry')->with('status_icon', 'success');
    }

    public function list_packages()
    {
        $data['packages'] = $this->adminModel->get_all_packages();
        $data['title'] = 'List Packages';
        return view('admin/packages/list_packages', $data);
    }

    public function add_packages()
    {
        $data = [];
        $data['title'] = 'Add Packages';
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
                $addpackage = [
                    'title' => $this->request->getPost('title'),
                    'slug' => $this->request->getPost('title'),
                    'price' => $this->request->getPost('price'),
                    'detail' => $this->request->getPost('detail'),
                    'no_of_days' => $this->request->getPost('no_of_days'),
                    'no_of_posts' => $this->request->getPost('no_of_posts'),
                    'sort_order' => $this->request->getPost('sort_order')
                ];
                $addpack = $this->adminModel->add_packages($addpackage);
                return redirect()->to('/admin/list_packages');
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('admin/packages/add_packages', $data);
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
                $addpackage = [
                    'title' => $this->request->getPost('title'),
                    'slug' => $this->request->getPost('title'),
                    'price' => $this->request->getPost('price'),
                    'detail' => $this->request->getPost('detail'),
                    'no_of_days' => $this->request->getPost('no_of_days'),
                    'no_of_posts' => $this->request->getPost('no_of_posts'),
                    'sort_order' => $this->request->getPost('sort_order')
                ];
                $addpack = $this->adminModel->add_packages($addpackage);
                $this->session->setFlashdata('status', 'Packages Added Successfully');
                return redirect()->to('/admin/list_packages')->with('status_icon', 'success');
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('admin/packages/add_packages', $data);
    }

    public function edit_packages($id)
    {
        $data['title'] = 'Edit Packages';
        $packages_row = $this->adminModel->get_packages_by_id($id);
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
                $editpackage = [
                    'title' => $this->request->getPost('title'),
                    'slug' => $this->request->getPost('title'),
                    'price' => $this->request->getPost('price'),
                    'detail' => $this->request->getPost('detail'),
                    'no_of_days' => $this->request->getPost('no_of_days'),
                    'no_of_posts' => $this->request->getPost('no_of_posts'),
                    'sort_order' => $this->request->getPost('sort_order'),
                    'is_active' => $this->request->getPost('status')
                ];
                $editpack = $this->adminModel->edit_packages($editpackage, $id);
                return redirect()->to('/admin/list_packages');
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('admin/packages/edit_packages', $data);
        $packages_row = $this->adminModel->get_packages_by_id($id);
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
                $editpackage = [
                    'title' => $this->request->getPost('title'),
                    'slug' => $this->request->getPost('title'),
                    'price' => $this->request->getPost('price'),
                    'detail' => $this->request->getPost('detail'),
                    'no_of_days' => $this->request->getPost('no_of_days'),
                    'no_of_posts' => $this->request->getPost('no_of_posts'),
                    'sort_order' => $this->request->getPost('sort_order'),
                    'is_active' => $this->request->getPost('status')
                ];
                $editpack = $this->adminModel->edit_packages($editpackage, $id);
                $this->session->setFlashdata('status', 'Packages Updated Successfully');
                return redirect()->to('/admin/list_packages')->with('status_icon', 'success');
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('admin/packages/edit_packages', $data);
    }

    public function list_newsletters()
    {
        $data['newsletters'] = $this->adminModel->get_all_newsletters();
        $data['title'] = 'Newsletters';
        return view('admin/newsletters/list_newsletters', $data);
    }

    public function del_newsletters($id)
    {
        $this->adminModel->del_newsletters($id);
        return redirect()->to('/admin/list_newsletters');
    }

    public function list_contact()
    {
        $data['contact'] = $this->adminModel->get_all_contactus();
        $data['title'] = 'List Contacts';
        return view('admin/contact/list_contact', $data);
    }

    public function del_contactus($id)
    {
        $this->adminModel->del_contactus($id);
        return redirect()->to('/admin/list_contact');
    }

    // Job type

    public function job_type()
    {
        $data['types'] = $this->adminModel->get_job_type();
        $data['title'] = 'Job Types';
        return view('admin/job_attributes/job_type', $data);
    }


    public function addjob()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = ['type' => ['label' => 'type', 'rules' => 'required']];
            if ($this->validate($rules) == FALSE) {
                echo '0~' . $this->validation->listErrors();
                exit;
            }
            $data = ['type' => $this->request->getPost('type')];
            $query = $this->adminModel->addjob($data);
            if ($query->resultID == 1) {
                $this->session->setFlashdata('success', 'Job successfully added');
                return redirect()->to(base_url('admin/job_type'));
            } else {
                echo '0~Something went wrong, please try again!';
            }
        }
        $data['title'] = 'Add Job Type';
        return view('admin/job_attributes/add_job_type');
    }

    public function editjob($id)
    {
        $get['data'] = $this->adminModel->editjob($id);
        $data['title'] = 'Edit Job Type';
        return view('admin/job_attributes/edit_job_type', $get);
    }

    public function updatejob($id)
    {
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'type' => ['label' => 'type', 'rules' => 'required']
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~' . $this->validation->listErrors();
                exit;
            }
            $data = ['type' => $this->request->getPost('type')];
            $query = $this->adminModel->updatejob($id, $data);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'Job successfully updated');
                return redirect()->to(base_url('admin/job_type'));
            } else {
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
        } else {
            echo '0~Something went wrong, please try again!';
        }
    }

    // Education

    public function education()
    {
        $get['data'] = $this->adminModel->education();
        $get['title'] = 'Education';
        return view('admin/education/education', $get);
    }

    public function addeducation()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = ['type' => ['label' => 'type', 'rules' => 'required']];
            if ($this->validate($rules) == FALSE) {
                echo '0~' . $this->validation->listErrors();
                exit;
            }
            $data = ['type' => $this->request->getPost('type')];
            $query = $this->adminModel->addeducation($data);
            if ($query->resultID == 1) {
                $this->session->setFlashdata('success', 'Education successfully added');
                return redirect()->to(base_url('admin/education'));
            } else {
                echo '0~Something went wrong, please try again!';
            }
        }
        $get['title'] = 'Add Education';
        return view('admin/education/add_education',$get);
    }

    public function editeducation($id)
    {
        $get['data'] = $this->adminModel->editeducation($id);
        $get['title'] = 'Edit Education';
        return view('admin/education/edit_education', $get);
    }

    public function updateeducation($id)
    {
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'type' => ['label' => 'type', 'rules' => 'required']
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~' . $this->validation->listErrors();
                exit;
            }
            $data = ['type' => $this->request->getPost('type')];
            $query = $this->adminModel->updateeducation($id, $data);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'Education successfully updated');
                return redirect()->to(base_url('admin/education'));
            } else {
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
        } else {
            echo '0~Something went wrong, please try again!';
        }
    }

    // Employment

    public function employment()
    {
        $get['data'] = $this->adminModel->employment();
        $get['title'] = 'Employment';
        return view('admin/employment/employment', $get);
    }

    public function addemployment()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = ['type' => ['label' => 'type', 'rules' => 'required']];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/employment'));
            }
            $data = ['type' => $this->request->getPost('type')];
            $query = $this->adminModel->addemployment($data);
            if ($query->resultID == 1) {
                $this->session->setFlashdata('success', 'Employment successfully added');
                return redirect()->to(base_url('admin/employment'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again!');
                return redirect()->to(base_url('admin/employment'));
            }
        }
        $get['title'] = 'Add Employment';
        return view('admin/employment/add_employment',$get);
    }

    public function editemployment($id)
    {
        $get['data'] = $this->adminModel->editemployment($id);
        $get['title'] = 'Edit Employment';
        return view('admin/employment/edit_employment', $get);
    }

    public function updateemployment($id)
    {
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'type' => ['label' => 'type', 'rules' => 'required']
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~' . $this->validation->listErrors();
                exit;
            }
            $data = ['type' => $this->request->getPost('type')];
            $query = $this->adminModel->updateemployment($id, $data);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'Employment successfully updated');
                return redirect()->to(base_url('admin/employment'));
            } else {
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
        } else {
            echo '0~Something went wrong, please try again!';
        }
    }

    // Employer

    public function employer()
    {
        $employer['data'] = $this->adminModel->getemployer();
        $employer['title'] = 'Employer';
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
                echo '0~' . $this->validation->listErrors();
                exit;
            }
            $emp = [
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
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
            } else {
                echo '0~Something went wrong, please try again!';
            }
        }
        $data['title'] = 'Add Employer';
        return view('admin/employer/addemployers', $data);
    }

    public function editemployer($id)
    {
        $query['data'] = $this->adminModel->editemployer($id);
        $query['categories'] = $this->adminModel->get_all_categories();
        $query['countries'] = $this->adminModel->get_countries_list();
        $query['title'] = 'Edit Employer';
        return view('admin/employer/editemployer', $query);
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
                'firstname' => ['label' => 'firstname', 'rules' => 'required'],
                'lastname' => ['label' => 'lastname', 'rules' => 'required'],
                'email' => ['label' => 'email', 'rules' => 'required'],
                'designation' => ['label' => 'designation', 'rules' => 'required'],
                'mobile_no' => ['label' => 'mobile_no', 'rules' => 'required'],
                'country' => ['label' => 'country', 'rules' => 'required'],
                'state' => ['label' => 'state', 'rules' => 'required'],
                'city' => ['label' => 'city', 'rules' => 'required'],
                'address' => ['label' => 'address', 'rules' => 'required']
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~' . $this->validation->listErrors();
                exit;
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
            $query = $this->adminModel->updateemployer($data, $id);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'Employer successfully updated');
                return redirect()->to(base_url('admin/employer'));
            } else {
                echo '0~Something went wrong, please try again!';
            }
        }
    }

    public function updatecompany($id)
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'company_logo'  => ['uploaded[company_logo]', 'max_size[company_logo,1024]'],
                'company_name' => ['label' => 'company_name', 'rules' => 'required'],
                'company_email' => ['label' => 'company_email', 'rules' => 'required'],
                'phone_no' => ['label' => 'phone_no', 'rules' => 'required'],
                'category' => ['label' => 'category', 'rules' => 'required'],
                'org_type' => ['label' => 'org_type', 'rules' => 'required'],
                'no_of_employers' => ['label' => 'no_of_employers', 'rules' => 'required'],
                'description' => ['label' => 'description', 'rules' => 'required'],
                'country' => ['label' => 'country', 'rules' => 'required'],
                'state' => ['label' => 'state', 'rules' => 'required'],
                'city' => ['label' => 'city', 'rules' => 'required'],
                'postcode' => ['label' => 'postcode', 'rules' => 'required'],
                'full_address' => ['label' => 'full_address', 'rules' => 'required'],
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~' . $this->validation->listErrors();
                exit;
            }
            $result = UploadFile($_FILES['company_logo']);
            if ($result['status'] == true) {
                $url = $result['result']['file_url'];
            } else {
                echo '0~' . $result['message'];
                exit;
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
            $query = $this->adminModel->updatecompany($id, $cmpny);
            if ($query == 1) {
                return 'success';
            }
        }
    }

    public function users()
    {
        $get['data'] = $this->adminModel->users();
        return view('admin/users/showusers.php', $get);
    }

    public function adduser()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'firstname' => ['label' => 'firstname', 'rules' => 'required'],
                'lastname' => ['label' => 'lastname', 'rules' => 'required'],
                'email' => ['label' => 'email', 'rules' => 'required'],
                'mobile_no' => ['label' => 'mobile_no', 'rules' => 'required'],
                'password' => ['label' => 'password', 'rules' => 'required'],
                'address' => ['label' => 'address', 'rules' => 'required']
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~' . $this->validation->listErrors();
                exit;
            }
            $data = [
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'mobile_no' => $this->request->getPost('mobile_no'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'address' => $this->request->getPost('address')
            ];
            $query = $this->adminModel->adduser($data);
            if ($query->resultID == 1) {
                $this->session->setFlashdata('success', 'User successfully added');
                return redirect()->to(base_url('admin/users'));
            } else {
                echo '0~Something went wrong, please try again!';
            }
        }
        $data['title'] = 'Add User';
        return view('admin/users/adduser',$data);
    }

    public function edituser($id)
    {
        $get['data'] = $this->adminModel->edituser($id);
        $get['title'] = 'Edit User';
        return view('admin/users/edituser', $get);
    }

    public function updateuser($id)
    {
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'firstname' => ['label' => 'firstname', 'rules' => 'required'],
                'lastname' => ['label' => 'lastname', 'rules' => 'required'],
                'email' => ['label' => 'email', 'rules' => 'required'],
                'mobile_no' => ['label' => 'mobile_no', 'rules' => 'required'],
                'is_active' => ['label' => 'is_active', 'rules' => 'required'],
            ];
            if ($this->validate($rules) == FALSE) {
                echo '0~' . $this->validation->listErrors();
                exit;
            }
            $data = [
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'mobile_no' => $this->request->getPost('mobile_no'),
                'is_active' => $this->request->getPost('is_active'),
            ];
            $query = $this->adminModel->updateuser($id, $data);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'User successfully updated');
                return redirect()->to(base_url('admin/users'));
            } else {
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
        } else {
            echo '0~Something went wrong, please try again!';
        }
    }


    // Jobs
    public function search()
    {
        $this->session->set('job_search_from', $this->request->getPost('job_search_from'));
        $this->session->set('job_search_to', $this->request->getPost('job_search_to'));
        $this->session->set('job_search_industry', $this->request->getPost('job_search_industry'));
        $this->session->set('job_search_category', $this->request->getPost('job_search_category'));
        $this->session->set('job_search_location', $this->request->getPost('job_search_location'));
    }

    public function list_job()
    {
        $this->session->remove('job_search_type');
        $this->session->remove('job_search_from');
        $this->session->remove('job_search_to');
        $this->session->remove('job_search_industry');
        $this->session->remove('job_search_category');
        $this->session->remove('job_search_location');

        $data['categories'] = $this->adminModel->get_all_categories();
        $data['industries'] = $this->adminModel->get_all_industry();
        $data['countries']  = $this->adminModel->get_countries_list();

        $data['title'] = 'Job List';
        return view('admin/job/job_list', $data);
    }

    public function datatable_json()
    {
        $records = $this->adminModel->GetAllJobs();
        $data = array();

        $i = 1;
        foreach ($records['data']  as $row) {
            $buttoncontroll = '<a class="btn btn-xs btn-success" href=' . base_url("admin/edit_post/" . $row['id']) . ' title="View" >
				 <i class="fa fa-eye"></i></a>&nbsp;&nbsp;

				  <a class="edit btn btn-xs btn-primary" href=' . base_url("admin/edit_post/" . $row['id']) . ' title="Edit" > 
				 <i class="fa fa-edit"></i></a>&nbsp;&nbsp;

				 <a class="btn-delete btn btn-xs btn-danger" href=' . base_url("admin/delete_post/" . $row['id']) . ' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> 
				 <i class="fa fa-trash"></i></a>';

            $data[] = array(
                $i++,
                $row['title'],
                '<a class="edit btn btn-xs btn-info mb-3" href=' . base_url("admin/view_job_applicants/" . $row['id']) . ' title="Applicants" > 
				 Applied [ ' . $row['cand_applied'] . ' ]
				</a>
				<a class="edit btn btn-xs btn-info" href=' . base_url("admin/shortlisted/" . $row['id']) . ' title="Applicants" > 
				 Shortlisted [ ' . $row['total_shortlisted'] . ' ]
				</a>',
                get_industry_name($row['industry']),  //  helper function
                get_country_name($row['country']), // same as above
                date_time($row['created_date']),
                $row['is_status'],
                $buttoncontroll
            );
        }
        $records['data'] = $data;
        echo json_encode($records);
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

    // Delete the job
    public function delete_post($id = 0)
    {
        $builder = $this->db->table('job_post');
        $builder->where('id', $id);
        if ($query = $builder->delete())
            $this->session->setFlashdata('success', 'Congratulation! Job has been Deleted successfully');
        else
            $this->session->setFlashdata('error', 'Oops! Failed to Delete Job');
        return redirect()->to(base_url('admin/list_job'));
    }

    public function post()
    {
        $admin_id  = session('admin_id');
        $data['categories'] = $this->adminModel->get_all_categories();
        $data['industries'] = $this->adminModel->get_all_industry();
        $data['countries']  = $this->adminModel->get_countries_list();
        $data['salaries']   = $this->adminModel->get_salary_list();
        $data['educations'] = $this->adminModel->get_education_list();
        $data['companies']  = $this->adminModel->getemployer();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                "employer_id"       => ["label" => "employer id", "rules" => "trim|required|min_length[3]"],
                "job_title"         => ["label" => "job title", "rules" => "trim|required"],
                "category"          => ["label" => "category", "rules" => "trim|required"],
                "industry"          => ["label" => "industry", "rules" => "trim|required"],
                "min_experience"    => ["label" => "min experience", "rules" => "trim|required"],
                "max_experience"    => ["label" => "max experience", "rules" => "trim|required"],
                "salary_period"     => ["label" => "salary period", "rules" => "trim|required"],
                "min_salary"        => ["label" => "min salary", "rules" => "trim|required"],
                "max_salary"        => ["label" => "max salary", "rules" => "trim|required"],
                "skills"            => ["label" => "skills", "rules" => "trim|required"],
                "description"       => ["label" => "description", "rules" => "trim|required|min_length[3]"],
                "total_positions"   => ["label" => "total positions", "rules" => "trim|required"],
                "gender"            => ["label" => "gender", "rules" => "trim|required"],
                "employment_type"   => ["label" => "employment type", "rules" => "trim|required"],
                "education"         => ["label" => "education", "rules" => "trim|required"],
                "country"           => ["label" => "country", "rules" => "trim|required"],
                "city"              => ["label" => "city", "rules" => "trim|required"],
                "location"          => ["label" => "location", "rules" => "trim|required"],
            ];
            if ($this->validate($rules) == FALSE) {
                // $this->session->setFlashdata('error', $this->validation->listErrors());
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/post'));
            } else {
                $data = array(
                    'admin_id'      => $admin_id,
                    'employer_id'   => get_direct_value('companies', 'employer_id', 'id', $this->request->getPost('employer_id')),
                    'company_id'    => $this->request->getPost('employer_id'),
                    'title'         => $this->request->getPost('job_title'),
                    'job_type'      => $this->request->getPost('job_type'),
                    'category'      => $this->request->getPost('category'),
                    'industry'      => $this->request->getPost('industry'),
                    'experience'    => $this->request->getPost('min_experience') . '-' . $this->request->getPost('max_experience'),
                    'min_salary'    => $this->request->getPost('min_salary'),
                    'max_salary'    => $this->request->getPost('max_salary'),
                    'salary_period' => $this->request->getPost('salary_period'),
                    'description'   => $this->request->getPost('description'),
                    'skills'        => $this->request->getPost('skills'),
                    'total_positions' => $this->request->getPost('total_positions'),
                    'gender'        => $this->request->getPost('gender'),
                    'education'     => $this->request->getPost('education'),
                    'employment_type' => $this->request->getPost('employment_type'),
                    'country'       => $this->request->getPost('country'),
                    'state'         => $this->request->getPost('state'),
                    'city'          => $this->request->getPost('city'),
                    'location'      => $this->request->getPost('location'),
                    'created_date'  => date('Y-m-d : H:i:s'),
                    'updated_date'  => date('Y-m-d : H:i:s')
                );

                $data['job_slug'] = $this->make_job_slug($this->request->getPost('job_title'), $this->request->getPost('city'));

                $result = $this->adminModel->add_job($data);
                if ($result) {
                    $this->session->setFlashdata('success', 'Congratulation! Job has been Posted successfully');
                    return redirect()->to(base_url('admin/view_jobs'));
                } else {
                    $this->session->setFlashdata('error', 'Oops Somthing went wrong, please try gain letter');
                    return redirect()->to(base_url('admin/post'));
                }
            }
        } else {
            $data['title'] = 'Post Job';
            return view('admin/job/job_add', $data);
        }
    }

    public function edit_post($job_id = 0)
    {
        $admin_id  = session('admin_id');
        $data['categories'] = $this->adminModel->get_all_categories();
        $data['industries'] = $this->adminModel->get_all_industry();
        $data['countries']  = $this->adminModel->get_countries_list();
        $data['salaries']   = $this->adminModel->get_salary_list();
        $data['educations'] = $this->adminModel->get_education_list();
        $data['companies']  = $this->adminModel->getemployer();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                "job_title"         => ["label" => "job title", "rules" => "trim|required|min_length[3]"],
                "category"          => ["label" => "category", "rules" => "trim|required"],
                "industry"          => ["label" => "industry", "rules" => "trim|required"],
                "min_experience"    => ["label" => "min experience", "rules" => "trim|required"],
                "max_experience"    => ["label" => "max experience", "rules" => "trim|required"],
                "salary_period"     => ["label" => "salary period", "rules" => "trim|required"],
                "min_salary"        => ["label" => "min salary", "rules" => "trim|required"],
                "max_salary"        => ["label" => "max salary", "rules" => "trim|required"],
                "skills"            => ["label" => "skills", "rules" => "trim|required"],
                "description"       => ["label" => "description", "rules" => "trim|required|min_length[3]"],
                "total_positions"   => ["label" => "total positions", "rules" => "trim|required"],
                "gender"            => ["label" => "gender", "rules" => "trim|required"],
                "employment_type"   => ["label" => "employment type", "rules" => "trim|required"],
                "education"         => ["label" => "education", "rules" => "trim|required"],
                "country"           => ["label" => "country", "rules" => "trim|required"],
                "city"              => ["label" => "city", "rules" => "trim|required"],
                "location"          => ["label" => "location", "rules" => "trim|required"],
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/post'));
            } else {
                $data = array(
                    'title'         => $this->request->getPost('job_title'),
                    'job_type'      => $this->request->getPost('job_type'),
                    'category'      => $this->request->getPost('category'),
                    'industry'      => $this->request->getPost('industry'),
                    'experience'    => $this->request->getPost('min_experience') . '-' . $this->request->getPost('max_experience'),
                    'min_salary'    => $this->request->getPost('min_salary'),
                    'max_salary'    => $this->request->getPost('max_salary'),
                    'salary_period' => $this->request->getPost('salary_period'),
                    'description'   => $this->request->getPost('description'),
                    'skills'        => $this->request->getPost('skills'),
                    'total_positions' => $this->request->getPost('total_positions'),
                    'gender'        => $this->request->getPost('gender'),
                    'education'     => $this->request->getPost('education'),
                    'employment_type' => $this->request->getPost('employment_type'),
                    'country'       => $this->request->getPost('country'),
                    'state'         => $this->request->getPost('state'),
                    'city'          => $this->request->getPost('city'),
                    'location'      => $this->request->getPost('location'),
                    'updated_date'  => date('Y-m-d : H:i:s')
                );

                $data['job_slug'] = $this->make_job_slug($this->request->getPost('job_title'), $this->request->getPost('city'));

                $result = $this->adminModel->edit_job($data, $job_id);
                if ($result) {
                    $this->session->setFlashdata('success', 'Congratulation! Job has been Updated successfully');
                    return redirect()->to(base_url('admin/list_job'));
                } else {
                    $this->session->setFlashdata('error', 'Oops Somthing went wrong, please try gain letter');
                    return redirect()->to(base_url('admin/post'));
                }
            }
        } else {
            $data['job_detail'] = $this->adminModel->get_job_by_id($job_id);
            $data['title'] = 'Edit Job';
            return view('admin/job/job_edit', $data);
        }
    }

    // Shortlisted Applicant
    public function shortlisted($job_id)
    {
        $data['applicants'] = $this->adminModel->get_shortlisted_applicants($job_id);
        $data['title'] = 'Shortlisted Applicants';
        // pre($data);
        return view('admin/job/shortlist_applicants', $data);
    }

    // Applicants who have applied for the job
    public function view_job_applicants($job_id)
    {
        $data['applicants'] = $this->adminModel->get_applicants($job_id);
        $data['title'] = 'Job Applicants';
        // pre($data);
        return view('admin/job/view_job_applicants', $data);
    }

    // Make Shortlist Applicant
    public function make_shortlist($id, $job_id)
    {
        if ($this->adminModel->do_shortlist($id)) {
            $user_email = $this->adminModel->get_applied_candidate_email($id);

            $job = get_job_detail($job_id);

            // sending shortlisted email 
            $mail_data = array(
                'job_title' => $job['title']
            );

            $this->mailer->mail_template($user_email, 'candidate-shortlisted', $mail_data);

            $this->session->setFlashdata('success', 'Congratulation! Applicant Shortlisted successfully');
            return redirect()->to(base_url('admin/shortlisted/' . $job_id));
        } else {
            $this->session->setFlashdata('error', 'Oops Somthing went wrong, please try gain letter');
            return redirect()->to(base_url('admin/view_job_applicants/' . $job_id));
        }
    }

    // Sending Email to applicant
    public function send_interview_email()
    {
        $email = trim($this->request->getPost('email'));
        $title = trim($this->request->getPost('subject'));
        $message = trim($this->request->getPost('message'));

        $subject = 'Interview Message | Darwin Jobs';
        $message =  '<p>Subject: ' . $title . '</p>
		<p>Message: ' . $message . '</p>';

        $mail_data['receiver_email'] = $email;
        $mail_data['mail_subject'] = $subject;
        $mail_data['mail_body'] = $message;

        if (sendEmail($mail_data)) {
            echo 'Email has been sent successfully !';
        } else {
            echo 'There is a problem while sending email !';
        }
    }
}
