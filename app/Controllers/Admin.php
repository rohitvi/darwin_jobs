<?php

namespace App\Controllers;

use App\Libraries\Mailer;
use App\Models\AdminModel;
use App\Models\auth\AuthModel;

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
        if (session('admin_logged_in')) {
            return redirect()->to('admin/dashboard');
        } else {
            return redirect()->to('admin/login');
        }
    }

    public function dashboard()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $data['all_users'] = $this->adminModel->get_all_users();
        $data['active_users'] = $this->adminModel->get_active_users();
        $data['deactive_users'] = $this->adminModel->get_deactive_users();

        $data['all_employers'] = $this->adminModel->get_all_employers();
        $data['active_employers'] = $this->adminModel->get_active_employers();
        $data['deactive_employers'] = $this->adminModel->get_deactive_employers();

        $data['latest_users'] = $this->adminModel->get_latest_users();
        $data['latest_jobs'] = $this->adminModel->get_latest_jobs();

        $data['title'] = 'Dashboard';
        return view('admin/dashboard', $data);
    }

    public function login()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'username' => ['label' => 'Username', 'rules' => 'required'],
                'password' => ['label' => 'Password', 'rules' => 'required'],
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . arrayToList($this->validation->getErrors());
                exit;
            }
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $logindata = $this->adminAuthModel->login_validate($username, $password);
            if ($logindata == 0) {
                echo '0~Invalid Username or Password';
                exit;
            } elseif ($logindata['status'] == 1) {
                $admindata = [
                    'admin_id' => $logindata['id'],
                    'admin_logged_in' => true,
                    'admin_username' => $username,
                ];
                $this->session->set($admindata);
                echo '1~You Have Successfully Logged in';
                exit;
            } else {
                echo '2~Your Account is Blocked';
                exit;
            }
        }
        return view('admin/auth/login');
    }

    public function forgot_password()
    {   
        if (session('admin_logged_in')) {
            return redirect()->to('admin/dashboard');
        }

        if ($this->request->isAJAX()) {
            //checking server side validation
            $rules = [
                'email' => ['label' => 'Email', 'rules' => 'required'],
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . arrayToList($this->validation->getErrors());
                exit;
            }
            $email = $this->request->getPost('email');
            $response = $this->adminAuthModel->check_user_mail($email);
            if ($response) {
                $rand_no = rand(0, 1000);
                $pwd_reset_code = md5($rand_no . $response['id']);
                $this->adminAuthModel->update_reset_code($pwd_reset_code, $response['id']);

                // --- sending email
                $name = $response['firstname'] . ' ' . $response['lastname'];
                $email = $response['email'];
                $reset_link = base_url('admin/reset_password/' . $pwd_reset_code);
                $mail_data['mail_body'] = $this->mailer->pwd_reset_link($name, $reset_link);
                $mail_data['receiver_email'] = $email;
                $mail_data['mail_subject'] = 'Reset your password';
                if (sendEmail($mail_data)) {
                    echo '1~We have sent instructions for resetting your password to your email';
                    exit;
                } else {
                    echo '0~There is the problem on your email';
                    exit;
                }
            } else {
                echo '0~The Email that you provided are invalid';
                exit;
            }
        } else {
            $data['title'] = 'Forget Password';
            return view('admin/auth/forget_password', $data);
        }
    }

    //----------------------------------------------------------------		
    public function reset_password($id = 0)
    {
        if (session('admin_logged_in')) {
            return redirect()->to('admin/dashboard');
        }
        if ($this->request->isAJAX()) {
            // check the activation code in database
            $rules = [
                'password' => ['label' => 'Password', 'rules' => 'trim|required|min_length[5]'],
                'confirm_password' => ['label' => 'Password Confirmation', 'rules' => 'trim|required|matches[password]'],
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . arrayToList($this->validation->getErrors());
                exit;
            } else {
                $new_password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
                $this->adminAuthModel->reset_password($id, $new_password);
                $this->session->setFlashdata('success', 'New password has been Updated successfully.Please login below');
                echo '1~New password has been Updated successfully.Please login below';
                exit;
            }
        } else {
            $result = $this->adminAuthModel->check_password_reset_code($id);
            if ($result) {
                $data['reset_code'] = $id;
                $data['title'] = 'Reset Password';
                return view('admin/auth/reset_password', $data);
            } else {
                $this->session->setFlashdata('error', 'Password Reset Code is either invalid or expired.');
                return redirect()->to(base_url('admin/forgot_password'));
            }
        }
    }

    public function account()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        if ($this->request->getMethod() == 'post') {
            $data = [
                'firstname' => ucwords($this->request->getPost('firstname')),
                'lastname' => ucwords($this->request->getPost('lastname')),
                'email' => $this->request->getPost('email'),
                'username' => ucwords($this->request->getPost('username')),
                'mobile_no' => $this->request->getPost('mobileno'),
            ];
            $id = session('admin_id');
            $change = $this->adminAuthModel->account($data, $id);
            if ($change) {
                $this->session->setFlashdata('success', 'Account successfully updated');
                return redirect()->to(base_url('admin/showadmin'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('admin/account'));
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
                'username' => ['label' => 'Username', 'rules' => 'required'],
                'firstname' => ['label' => 'Firstname', 'rules' => 'required'],
                'lastname' => ['label' => 'Lastname', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required'],
                'mobile_no' => ['label' => 'Mobile No', 'rules' => 'required'],
                'password' => ['label' => 'Password', 'rules' => 'required'],
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/registeradmin'));
            }
            $data = [
                'username' => ucwords($this->request->getPost('username')),
                'firstname' => ucwords($this->request->getPost('firstname')),
                'lastname' => ucwords($this->request->getPost('lastname')),
                'email' => $this->request->getPost('email'),
                'mobile_no' => $this->request->getPost('mobile_no'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            $query = $this->adminAuthModel->register($data);
            if ($query->resultID == 1) {
                $this->session->setFlashdata('success', 'Admin successfully Registered');
                return redirect()->to(base_url('admin/showadmin'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('admin/registeradmin'));
            }
        }
        $data['title'] = 'Register Admin';
        return view('admin/auth/register', $data);
    }

    public function deleteadmin($id)
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $query = $this->adminAuthModel->deleteadmin($id);
        if ($query->resultID == 1) {
            return redirect()->to(base_url('admin/showadmin'));
        } else {
            $this->session->setFlashdata('error', 'Something went wrong, please try again');
            return redirect()->to(base_url('admin/showadmin'));
        }
    }

    public function deleteemployer($id)
    {   
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $query = $this->adminModel->deleteemployer($id);
        if ($query->resultID == 1) {
            return redirect()->to(base_url('admin/employer'));
        } else {
            $this->session->setFlashdata('error', 'Something went wrong, please try again');
            return redirect()->to(base_url('admin/employer'));
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
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'password' => ['label' => 'Password', 'rules' => 'required'],
                'cpassword' => ['label' => 'Confirm Password', 'rules' => 'required|matches[password]'],
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/showadmin'));
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
        return view('admin/auth/changepassword', $data);
    }

    public function showadmin()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $result['admin'] = $this->adminAuthModel->showadmin();
        $result['title'] = 'Admin List';
        return view('admin/showadmin.php', $result);
    }

    public function editadmin($id)
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $get['data'] = $this->adminAuthModel->getaccount($id);
        $get['title'] = 'Edit Admin';
        return view('admin/auth/editadmin', $get);
    }

    public function updateadmin($id)
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => ['label' => 'Username', 'rules' => 'required'],
                'firstname' => ['label' => 'Firstname', 'rules' => 'required'],
                'lastname' => ['label' => 'Lastname', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required'],
                'mobile_no' => ['label' => 'Mobile No', 'rules' => 'required'],
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/editadmin'));
            }
            $data = [
                'username' => ucwords($this->request->getPost('username')),
                'firstname' => ucwords($this->request->getPost('firstname')),
                'lastname' => ucwords($this->request->getPost('lastname')),
                'email' => $this->request->getPost('email'),
                'mobile_no' => $this->request->getPost('mobile_no'),
            ];
            $query = $this->adminAuthModel->account($data, $id);
            if ($query) {
                $this->session->setFlashdata('success', 'Account successfully updated');
                return redirect()->to(base_url('admin/showadmin'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('admin/editadmin'));
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
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $data['categories'] = $this->adminModel->get_all_categories();
        $data['title'] = 'List Category';
        return view('admin/category/list_category', $data);
    }

    public function add_category()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'category' => ['label' =>'Category Name', 'rules' => 'required'],
                'iconfield' => ['label' =>'Add Icon', 'rules' => 'required']
                    ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/add_category'));
            }

                $addcategorydata = [
                    'name' => ucwords($this->request->getPost('category')),
                    'slug' => $this->request->getPost('category'),
                    'iconfield' => $this->request->getPost('iconfield'),
                ];
                $addcategory = $this->adminModel->add_category($addcategorydata);
                if ($addcategory == true) {
                    $this->session->setFlashdata('success', 'Category Added successfully');
                    return redirect()->to(base_url('/admin/list_category'));
                    } else {
                    $this->session->setFlashdata('error', 'Something Went Wrong, Please Try Again !');
                    return redirect()->to(base_url('/admin/add_category'));
                    }
                
        }
        $data['title'] = 'Add Category';
        return view('admin/category/add_category', $data);
    }


    public function edit_category($id)
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $category_row = $this->adminModel->get_category_by_id($id);
        $data['category_row'] = $category_row;

        if ($this->request->getMethod() == 'post') {
            $rules = [
            'category' => ['label' =>'Category Name', 'rules' => 'required'],
            'iconfield' => ['label' =>'Add Icon', 'rules' => 'required'],
            'status' => ['label' =>'Status', 'rules' => 'required']
                ];

            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/edit_category/'.$id));
            }
                $editcategory = [
                    'name' => ucwords($this->request->getPost('category')),
                    'slug' => $this->request->getPost('category'),
                    'iconfield' => $this->request->getPost('iconfield'),
                    'status' => $this->request->getPost('status'),
                ];
                $editcategorydata = $this->adminModel->edit_category($editcategory, $id);
                if ($editcategorydata == 1) {
                $this->session->setFlashdata('success', 'Category Updated Successfully');
                return redirect()->to(base_url('/admin/list_category'));
                } else {
                    $this->session->setFlashdata('error', 'Something Went Wrong, Please Try Again !');
                        return redirect()->to(base_url('/admin/edit_category'));
                }
        }
        $data['title'] = 'Edit Category';
        return view('admin/category/edit_category', $data);
    }

    public function del_category($id)
    {
        $query = $this->adminModel->del_category($id);
        if ($query == true) {
            $this->session->setFlashdata('success', 'Category Deleted Successfully');
            return redirect()->to(base_url('/admin/list_category'));
            }
    }

    public function list_industry()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $data['industry'] = $this->adminModel->get_all_industry();
        $data['title'] = 'List Industry';
        return view('admin/industry/list_industry', $data);
    }

    public function add_industry()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'industry' => ['label' =>'Industry Name', 'rules' => 'required']
                    ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/add_industry'));
            }
                $addindustrydata = [
                    'name' => ucwords($this->request->getPost('industry')),
                    'slug' => $this->request->getPost('industry')
                ];
                $addindustry = $this->adminModel->add_industry($addindustrydata);
                if ($addindustry == true) {
                    $this->session->setFlashdata('success', 'Industry Added successfully');
                    return redirect()->to(base_url('/admin/list_industry'));
                    } else {
                    $this->session->setFlashdata('error', 'Something Went Wrong, Please Try Again !');
                    return redirect()->to(base_url('/admin/add_industry'));
                    }
        }
        $data['title'] = 'Add Industry';
        return view('admin/industry/add_industry', $data);
    }

    public function edit_industry($id)
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $industry_row = $this->adminModel->get_industry_by_id($id);
        $data['industry_row'] = $industry_row;
        // pre( $data );
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'industry' => ['label' =>'Industry Name', 'rules' => 'required']
                    ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/add_industry'));
            }
                $editindustry = [
                    'name' => ucwords($this->request->getPost('industry')),
                    'slug' => $this->request->getPost('industry')
                ];
                $editindustrydata = $this->adminModel->edit_industry($editindustry, $id);
                if ($editindustrydata == true) {
                    $this->session->setFlashdata('success', 'Industry Updated Successfully');
                    return redirect()->to(base_url('/admin/list_industry'));
                    } else {
                    $this->session->setFlashdata('error', 'Something Went Wrong, Please Try Again !');
                    return redirect()->to(base_url('/admin/edit_industry'));
                    }
        }
        $data['title'] = 'Edit Industry';
        return view('admin/industry/edit_industry', $data);
    }

    public function del_industry($id)
    {
        $query = $this->adminModel->del_industry($id);
        if ($query == true) {
            $this->session->setFlashdata('success', 'Industry Deleted Successfully');
            return redirect()->to(base_url('/admin/list_industry'));
            }
    }

    public function list_packages()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $data['packages'] = $this->adminModel->get_all_packages();
        $data['title'] = 'List Packages';
        return view('admin/packages/list_packages', $data);
    }

    public function add_packages()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $input = $this->validate([
                'title'         => ['label' =>'Title', 'rules' => 'required'],
                'price'         => ['label' =>'Price', 'rules' => 'required'],
                'detail'        => ['label' =>'Package Detail', 'rules' => 'required'],
                'no_of_days'    => ['label' =>'No of Days', 'rules' => 'required'],
                'no_of_posts'   => ['label' =>'No of Posts', 'rules' => 'required'],
                'sort_order'    => ['label' =>'Sort Order', 'rules' => 'required'],
            ]);
            if ($input == true) {
                $addpackage = [
                    'title' => ucwords($this->request->getPost('title')),
                    'slug' => $this->request->getPost('title'),
                    'price' => $this->request->getPost('price'),
                    'detail' => $this->request->getPost('detail'),
                    'no_of_days' => $this->request->getPost('no_of_days'),
                    'no_of_posts' => $this->request->getPost('no_of_posts'),
                    'sort_order' => $this->request->getPost('sort_order'),
                ];
                $addpack = $this->adminModel->add_packages($addpackage);
                return redirect()->to('/admin/list_packages');
            } else {
                $data['validation'] = $this->validator;
            }
        }
        $data['title'] = 'Add Packages';
        return view('admin/packages/add_packages', $data);
    }

    public function edit_packages($id)
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $data['title'] = 'Edit Packages';
        $packages_row = $this->adminModel->get_packages_by_id($id);
        $data['packages_row'] = $packages_row;

        if ($this->request->getMethod() == 'post') {
            $input = $this->validate([
                'title'         => ['label' =>'Title', 'rules' => 'required'],
                'price'         => ['label' =>'Price', 'rules' => 'required'],
                'detail'        => ['label' =>'Package Detail', 'rules' => 'required'],
                'no_of_days'    => ['label' =>'No of Days', 'rules' => 'required'],
                'no_of_posts'   => ['label' =>'No of Posts', 'rules' => 'required'],
                'sort_order'    => ['label' =>'Sort Order', 'rules' => 'required'],
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
                    'is_active' => $this->request->getPost('status'),
                ];
                $editpack = $this->adminModel->edit_packages($editpackage, $id);
                return redirect()->to('/admin/list_packages');
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('admin/packages/edit_packages', $data);
    }

    public function list_newsletters()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $data['newsletters'] = $this->adminModel->get_all_newsletters();
        $data['title'] = 'Newsletters';
        return view('admin/newsletters/list_newsletters', $data);
    }

    public function del_newsletters($id)
    {
        $query = $this->adminModel->del_newsletters($id);
        if ($query == true) {
            $this->session->setFlashdata('success', 'Subscribers Mail ID Deleted Successfully');
            return redirect()->to(base_url('/admin/list_newsletters'));
            }
    }

    public function list_contact()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $data['contact'] = $this->adminModel->get_all_contactus();
        $data['title'] = 'List Contacts';
        return view('admin/contact/list_contact', $data);
    }

    public function del_contactus($id)
    {
        $query = $this->adminModel->del_contactus($id);
        if ($query == true) {
            $this->session->setFlashdata('success', 'Contact Us Deleted Successfully');
            return redirect()->to(base_url('/admin/list_contact'));
            }
    }

    // Job type

    public function job_type()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $data['types'] = $this->adminModel->get_job_type();
        $data['title'] = 'Job Types';
        return view('admin/job_attributes/job_type', $data);
    }

    public function addjob()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        if ($this->request->getMethod() == 'post') {
            $rules = ['type' => ['label' => 'Type', 'rules' => 'required']];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/job_type'));
            }
            $data = ['type' => ucwords($this->request->getPost('type'))];
            $query = $this->adminModel->addjob($data);
            if ($query->resultID == 1) {
                $this->session->setFlashdata('success', 'Job successfully added');
                return redirect()->to(base_url('admin/job_type'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('admin/job_type'));
            }
        }
        $data['title'] = 'Add Job Type';
        return view('admin/job_attributes/add_job_type');
    }

    public function editjob($id)
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $get['data'] = $this->adminModel->editjob($id);
        $data['title'] = 'Edit Job Type';
        return view('admin/job_attributes/edit_job_type', $get);
    }

    public function updatejob($id)
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'type' => ['label' => 'Type', 'rules' => 'required'],
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/editjob'));
            }
            $data = ['type' => ucwords($this->request->getPost('type'))];
            $query = $this->adminModel->updatejob($id, $data);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'Job successfully updated');
                return redirect()->to(base_url('admin/job_type'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('admin/editjob'));
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
            $this->session->setFlashdata('error', 'Something went wrong, please try again');
            return redirect()->to(base_url('admin/job_type'));
        }
    }

    // Education

    public function education()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $get['data'] = $this->adminModel->education();
        $get['title'] = 'Education';
        return view('admin/education/education', $get);
    }

    public function addeducation()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        if ($this->request->getMethod() == 'post') {
            $rules = ['type' => ['label' => 'type', 'rules' => 'required']];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/addeducation'));
            }
            $data = ['type' => ucwords($this->request->getPost('type'))];
            $query = $this->adminModel->addeducation($data);
            if ($query->resultID == 1) {
                $this->session->setFlashdata('success', 'Education successfully added');
                return redirect()->to(base_url('admin/education'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('admin/addeducation'));
            }
        }
        $get['title'] = 'Add Education';
        return view('admin/education/add_education', $get);
    }

    public function editeducation($id)
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $get['data'] = $this->adminModel->editeducation($id);
        $get['title'] = 'Edit Education';
        return view('admin/education/edit_education', $get);
    }

    public function updateeducation($id)
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'type' => ['label' => 'Type', 'rules' => 'required'],
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/editeducation'));
            }
            $data = ['type' => ucwords($this->request->getPost('type'))];
            $query = $this->adminModel->updateeducation($id, $data);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'Education successfully updated');
                return redirect()->to(base_url('admin/education'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('admin/editeducation'));
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
            $this->session->setFlashdata('error', 'Something went wrong, please try again');
            return redirect()->to(base_url('admin/education'));
        }
    }

    // Employment

    public function employment()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $get['data'] = $this->adminModel->employment();
        $get['title'] = 'Employment';
        return view('admin/employment/employment', $get);
    }

    public function addemployment()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        if ($this->request->getMethod() == 'post') {
            $rules = ['type' => ['label' => 'type', 'rules' => 'required']];
            if ($this->validate($rules) == false) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/employment'));
            }
            $data = ['type' => ucwords($this->request->getPost('type'))];
            $query = $this->adminModel->addemployment($data);
            if ($query->resultID == 1) {
                $this->session->setFlashdata('success', 'Employment successfully added');
                return redirect()->to(base_url('admin/employment'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('admin/addemployment'));
            }
        }
        $get['title'] = 'Add Employment';
        return view('admin/employment/add_employment', $get);
    }

    public function editemployment($id)
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $get['data'] = $this->adminModel->editemployment($id);
        $get['title'] = 'Edit Employment';
        return view('admin/employment/edit_employment', $get);
    }

    public function updateemployment($id)
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'type' => ['label' => 'Type', 'rules' => 'required'],
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/editemployment'));
            }
            $data = ['type' => ucwords($this->request->getPost('type'))];
            $query = $this->adminModel->updateemployment($id, $data);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'Employment successfully updated');
                return redirect()->to(base_url('admin/employment'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('admin/editemployment'));
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
            $this->session->setFlashdata('error', 'Something went wrong, please try again');
            return redirect()->to(base_url('admin/employment'));
        }
    }

    // Employer

    public function employer()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $employer['data'] = $this->adminModel->getemployer();
        $employer['title'] = 'Employer';
        return view('admin/employer/showemployers', $employer);
    }

    public function addemployer()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
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
                'firstname' => ['label' => 'Firstname', 'rules' => 'required'],
                'lastname' => ['label' => 'Lastname', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required'],
                'password' => ['label' => 'Password', 'rules' => 'required'],
                'cpassword' => ['label' => 'Confirm Password', 'rules' => 'required|matches[password]'],
                'company_name' => ['label' => 'Company Name', 'rules' => 'required'],
                'category' => ['label' => 'Category', 'rules' => 'required'],
                'org_type' => ['label' => 'Organization Type', 'rules' => 'required'],
                'country' => ['label' => 'Country', 'rules' => 'required'],
                'state' => ['label' => 'State', 'rules' => 'required'],
                'city' => ['label' => 'City', 'rules' => 'required'],
                'postcode' => ['label' => 'Postcode', 'rules' => 'required'],
                'address' => ['label' => 'Address', 'rules' => 'required'],
                'phone_no' => ['label' => 'Phone_no', 'rules' => 'required'],
                'website' => ['label' => 'Website', 'rules' => 'required'],
                'description' => ['label' => 'Description', 'rules' => 'required|min_length[10]'],
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/addemployers'));
            }
            $emp = [
                'firstname' => ucwords($this->request->getPost('firstname')),
                'lastname' => ucwords($this->request->getPost('lastname')),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            $cmpny = [
                'company_name' => ucwords($this->request->getPost('company_name')),
                'category' => $this->request->getPost('category'),
                'email' => $this->request->getPost('email'),
                'org_type' => $this->request->getPost('org_type'),
                'country' => $this->request->getPost('country'),
                'state' => $this->request->getPost('state'),
                'city' => $this->request->getPost('city'),
                'postcode' => $this->request->getPost('postcode'),
                'address' => ucwords($this->request->getPost('address')),
                'phone_no' => $this->request->getPost('phone_no'),
                'website' => $this->request->getPost('website'),
                'description' => ucfirst($this->request->getPost('description')),
            ];
            $cmpny['employer_id'] = $this->adminModel->insertemployer($emp);
            $result = $this->adminModel->insertcmpny($cmpny);
            if ($result->resultID == 1) {
                $this->session->setFlashdata('success', 'Employer and company successfully registered');
                return redirect()->to(base_url('admin/employer'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('admin/addemployers'));
            }
        }
        $data['title'] = 'Add Employer';
        return view('admin/employer/addemployers', $data);
    }

    public function editemployer($id)
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
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
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'firstname' => ['label' => 'Firstname', 'rules' => 'required'],
                'lastname' => ['label' => 'Lastname', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required'],
                'designation' => ['label' => 'Designation', 'rules' => 'required'],
                'mobile_no' => ['label' => 'Mobile No', 'rules' => 'required'],
                'country' => ['label' => 'Country', 'rules' => 'required'],
                'state' => ['label' => 'State', 'rules' => 'required'],
                'city' => ['label' => 'City', 'rules' => 'required'],
                'address' => ['label' => 'Address', 'rules' => 'required'],
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/addemployers'));
            }
            $data = [
                'firstname' => ucwords($this->request->getPost('firstname')),
                'lastname' => ucwords($this->request->getPost('lastname')),
                'email' => $this->request->getPost('email'),
                'designation' => ucwords($this->request->getPost('designation')),
                'mobile_no' => $this->request->getPost('mobile_no'),
                'country' => $this->request->getPost('country'),
                'state' => $this->request->getPost('state'),
                'city' => $this->request->getPost('city'),
                'address' => ucwords($this->request->getPost('address')),
            ];
            $query = $this->adminModel->updateemployer($data, $id);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'Employer successfully updated');
                return redirect()->to(base_url('admin/employer'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('admin/editemployer'));
            }
        }
    }

    public function updatecompany($id)
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        if ($this->request->getMethod() == 'post') {

            if ($_FILES['company_logo']['name'] != "") {
                $rules=[ 'company_logo' =>['uploaded[company_logo]','max_size[company_logo,1024]' ]
                ];
                if ($this->validate($rules) == false) {
                    $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                    return redirect()->to(base_url('admin/employer'));
                }

                $result = UploadFile($_FILES['company_logo']);
                if ($result['status'] == true) {
                    $company_logo = $result['result']['file_url'];
                } else {
                    $this->session->setFlashdata('error', $result['message']);
                    return redirect()->to(base_url('admin/employer'));
                }
            }

            $rules = [
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
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/employer'));
            }

            $cmpny = [
                'company_name' => ucwords($this->request->getPost('company_name')),
                'email' => $this->request->getPost('company_email'),
                'phone_no' => $this->request->getPost('phone_no'),
                'website' => $this->request->getPost('website'),
                'category' => $this->request->getPost('category'),
                'org_type' => $this->request->getPost('org_type'),
                'no_of_employers' => $this->request->getPost('no_of_employers'),
                'description' => ucfirst($this->request->getPost('description')),
                'country' => $this->request->getPost('country'),
                'state' => $this->request->getPost('state'),
                'city' => $this->request->getPost('city'),
                'postcode' => $this->request->getPost('postcode'),
                'address' => ucwords($this->request->getPost('full_address')),
                'facebook_link' => $this->request->getPost('facebook_link'),
                'twitter_link' => $this->request->getPost('twitter_link'),
                'youtube_link' => $this->request->getPost('youtube_link'),
                'linkedin_link' => $this->request->getPost('linkedin_link'),
            ];

            if ($_FILES['company_logo']['name'] != "") {
                $cmpny['company_logo'] = $company_logo;
            }

             $query = $this->adminModel->updatecompany($id, $cmpny);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'Company Information Successfully Updated');
                return redirect()->to(base_url('admin/employer'));
            } else {
                $this->session->setFlashdata('error', 'Something Went Wrong, Please Try Again!');
                return redirect()->to(base_url('admin/employer'));
            }
        }
    }

    public function users()
    {
        $get['data'] = $this->adminModel->users();
        $get['title'] = 'Users';
        return view('admin/users/showusers.php', $get);
    }

    public function adduser()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'firstname' => ['label' => 'Firstname', 'rules' => 'required'],
                'lastname' => ['label' => 'Lastname', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required'],
                'mobile_no' => ['label' => 'Mobile No', 'rules' => 'required'],
                'password' => ['label' => 'Password', 'rules' => 'required'],
                'address' => ['label' => 'Address', 'rules' => 'required'],
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/adduser'));
            }
            $data = [
                'firstname' => ucwords($this->request->getPost('firstname')),
                'lastname' => ucwords($this->request->getPost('lastname')),
                'email' => $this->request->getPost('email'),
                'mobile_no' => $this->request->getPost('mobile_no'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'address' => ucwords($this->request->getPost('address')),
            ];
            $query = $this->adminModel->adduser($data);
            if ($query->resultID == 1) {
                $this->session->setFlashdata('success', 'User successfully added');
                return redirect()->to(base_url('admin/users'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('admin/adduser'));
            }
        }
        $data['title'] = 'Add User';
        return view('admin/users/adduser', $data);
    }

    public function edituser($id)
    {
        $get['data'] = $this->adminModel->edituser($id);
        $get['title'] = 'Edit User';
        return view('admin/users/edituser', $get);
    }

    public function updateuser($id)
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'firstname' => ['label' => 'Firstname', 'rules' => 'required'],
                'lastname' => ['label' => 'Lastname', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required'],
                'mobile_no' => ['label' => 'Mobile No', 'rules' => 'required'],
                'is_active' => ['label' => 'Status', 'rules' => 'required'],
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/edituser'));
            }
            $data = [
                'firstname' => ucwords($this->request->getPost('firstname')),
                'lastname' => ucwords($this->request->getPost('lastname')),
                'email' => $this->request->getPost('email'),
                'mobile_no' => $this->request->getPost('mobile_no'),
                'is_active' => $this->request->getPost('is_active'),
            ];
            $query = $this->adminModel->updateuser($id, $data);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'User successfully updated');
                return redirect()->to(base_url('admin/users'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('admin/edituser'));
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
            $this->session->setFlashdata('error', 'Something went wrong, please try again');
            return redirect()->to(base_url('admin/users'));
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
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $this->session->remove('job_search_type');
        $this->session->remove('job_search_from');
        $this->session->remove('job_search_to');
        $this->session->remove('job_search_industry');
        $this->session->remove('job_search_category');
        $this->session->remove('job_search_location');

        $data['categories'] = $this->adminModel->get_all_categories();
        $data['industries'] = $this->adminModel->get_all_industry();
        $data['countries'] = $this->adminModel->get_countries_list();

        $data['title'] = 'Job List';
        return view('admin/job/job_list', $data);
    }

    public function datatable_json()
    {
        $records = $this->adminModel->GetAllJobs();
        $data = array();

        $i = 1;
        foreach ($records['data'] as $row) {
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
                get_industry_name($row['industry']), //  helper function
                get_country_name($row['country']), // same as above
                date_time($row['created_date']),
                $row['is_status'],
                $buttoncontroll,
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
        $job_title_slug = make_slug($job_title) . '-job-in-' . make_slug($city); // make slug is a helper function
        $final_job_url = $job_title_slug;
        return $final_job_url;
    }

    // Delete the job
    public function delete_post($id = 0)
    {
        $builder = $this->db->table('job_post');
        $builder->where('id', $id);
        if ($query = $builder->delete()) {
            $this->session->setFlashdata('success', 'Congratulation! Job has been Deleted successfully');
        } else {
            $this->session->setFlashdata('error', 'Oops! Failed to Delete Job');
        }

        return redirect()->to(base_url('admin/list_job'));
    }

    public function post()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $admin_id = session('admin_id');
        $data['categories'] = $this->adminModel->get_all_categories();
        $data['industries'] = $this->adminModel->get_all_industry();
        $data['countries'] = $this->adminModel->get_countries_list();
        $data['salaries'] = $this->adminModel->get_salary_list();
        $data['educations'] = $this->adminModel->get_education_list();
        $data['companies'] = $this->adminModel->getemployer();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                "employer_id" => ["label" => "Employer Id", "rules" => "trim|required"],
                "job_title" => ["label" => "Job Title", "rules" => "trim|required"],
                "category" => ["label" => "Category", "rules" => "trim|required"],
                "industry" => ["label" => "Industry", "rules" => "trim|required"],
                "min_experience" => ["label" => "Minimum Experience", "rules" => "trim|required"],
                "max_experience" => ["label" => "Maximum Experience", "rules" => "trim|required"],
                "salary_period" => ["label" => "Salary Period", "rules" => "trim|required"],
                "min_salary" => ["label" => "Minimum Salary", "rules" => "trim|required"],
                "max_salary" => ["label" => "Maximum Salary", "rules" => "trim|required"],
                "skills" => ["label" => "Skills", "rules" => "trim|required"],
                "description" => ["label" => "Description", "rules" => "trim|required|min_length[3]"],
                "total_positions" => ["label" => "Total Positions", "rules" => "trim|required"],
                "gender" => ["label" => "Gender", "rules" => "trim|required"],
                "employment_type" => ["label" => "Employment Type", "rules" => "trim|required"],
                "education" => ["label" => "Education", "rules" => "trim|required"],
                "country" => ["label" => "Country", "rules" => "trim|required"],
                "city" => ["label" => "City", "rules" => "trim|required"],
                "location" => ["label" => "Location", "rules" => "trim|required"],
            ];
            if ($this->validate($rules) == false) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/post'));
            } else {
                $skills = ucwords($this->request->getPost('skills'));
                $skill = str_replace(" ", ",",$skills);
                $data = array(
                    'admin_id' => $admin_id,
                    'employer_id' => get_direct_value('companies', 'employer_id', 'id', $this->request->getPost('employer_id')),
                    'company_id' => $this->request->getPost('employer_id'),
                    'title' => ucwords($this->request->getPost('job_title')),
                    'job_type' => $this->request->getPost('job_type'),
                    'category' => $this->request->getPost('category'),
                    'industry' => $this->request->getPost('industry'),
                    'experience' => $this->request->getPost('min_experience') . '-' . $this->request->getPost('max_experience'),
                    'min_salary' => $this->request->getPost('min_salary'),
                    'max_salary' => $this->request->getPost('max_salary'),
                    'salary_period' => $this->request->getPost('salary_period'),
                    'description' => ucfirst($this->request->getPost('description')),
                    'skills' => $skill,
                    'total_positions' => $this->request->getPost('total_positions'),
                    'gender' => $this->request->getPost('gender'),
                    'education' => $this->request->getPost('education'),
                    'employment_type' => $this->request->getPost('employment_type'),
                    'country' => $this->request->getPost('country'),
                    'state' => $this->request->getPost('state'),
                    'city' => $this->request->getPost('city'),
                    'location' => ucwords($this->request->getPost('location')),
                    'created_date' => date('Y-m-d : H:i:s'),
                    'updated_date' => date('Y-m-d : H:i:s'),
                );

                $data['job_slug'] = $this->make_job_slug($this->request->getPost('job_title'), $this->request->getPost('city'));

                $result = $this->adminModel->add_job($data);
                if ($result) {
                    $this->session->setFlashdata('success', 'Congratulation! Job has been Posted successfully');
                    return redirect()->to(base_url('admin/list_job'));
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
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $admin_id = session('admin_id');
        $data['categories'] = $this->adminModel->get_all_categories();
        $data['industries'] = $this->adminModel->get_all_industry();
        $data['countries'] = $this->adminModel->get_countries_list();
        $data['salaries'] = $this->adminModel->get_salary_list();
        $data['educations'] = $this->adminModel->get_education_list();
        $data['companies'] = $this->adminModel->getemployer();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                "job_title" => ["label" => "Job Title", "rules" => "trim|required|min_length[3]"],
                "category" => ["label" => "Category", "rules" => "trim|required"],
                "industry" => ["label" => "Industry", "rules" => "trim|required"],
                "min_experience" => ["label" => "Minimum Experience", "rules" => "trim|required"],
                "max_experience" => ["label" => "Maximum Experience", "rules" => "trim|required"],
                "salary_period" => ["label" => "Salary Period", "rules" => "trim|required"],
                "min_salary" => ["label" => "Minimum Salary", "rules" => "trim|required"],
                "max_salary" => ["label" => "Maximum Salary", "rules" => "trim|required"],
                "skills" => ["label" => "Skills", "rules" => "trim|required"],
                "description" => ["label" => "Description", "rules" => "trim|required|min_length[3]"],
                "total_positions" => ["label" => "Total Positions", "rules" => "trim|required"],
                "gender" => ["label" => "Gender", "rules" => "trim|required"],
                "employment_type" => ["label" => "Employment Type", "rules" => "trim|required"],
                "education" => ["label" => "Education", "rules" => "trim|required"],
                "country" => ["label" => "Country", "rules" => "trim|required"],
                "city" => ["label" => "City", "rules" => "trim|required"],
                "location" => ["label" => "Location", "rules" => "trim|required"],
            ];
            if ($this->validate($rules) == false) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/post'));
            } else {
                $skills = ucwords($this->request->getPost('skills'));
                $skill = str_replace(" ", ",",$skills);
                $data = array(
                    'title' => ucwords($this->request->getPost('job_title')),
                    'job_type' => $this->request->getPost('job_type'),
                    'category' => $this->request->getPost('category'),
                    'industry' => $this->request->getPost('industry'),
                    'experience' => $this->request->getPost('min_experience') . '-' . $this->request->getPost('max_experience'),
                    'min_salary' => $this->request->getPost('min_salary'),
                    'max_salary' => $this->request->getPost('max_salary'),
                    'salary_period' => $this->request->getPost('salary_period'),
                    'description' => ucfirst($this->request->getPost('description')),
                    'skills' => $skill,
                    'total_positions' => $this->request->getPost('total_positions'),
                    'gender' => $this->request->getPost('gender'),
                    'education' => $this->request->getPost('education'),
                    'employment_type' => $this->request->getPost('employment_type'),
                    'country' => $this->request->getPost('country'),
                    'state' => $this->request->getPost('state'),
                    'city' => $this->request->getPost('city'),
                    'location' => ucwords($this->request->getPost('location')),
                    'updated_date' => date('Y-m-d : H:i:s'),
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
        if(!admin_vaidate())  return redirect()->to('/admin/login');
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
                'job_title' => $job['title'],
            );

            $this->mailer->mail_template($user_email, 'candidate-shortlisted', $mail_data);

            $this->session->setFlashdata('success', 'Congratulation! Applicant Shortlisted successfully');
            return redirect()->to(base_url('admin/shortlisted/' . $job_id));
        } else {
            $this->session->setFlashdata('error', 'Oops Somthing went wrong, please try gain letter');
            return redirect()->to(base_url('admin/view_job_applicants/' . $job_id));
        }
    }

    public function add_general_settings()
    {
        if(!admin_vaidate())  return redirect()->to('/admin/login');
        $get['gsetting'] = $this->adminModel->fetch_general_setting();
        $get['footer_settings'] = $this->adminModel->get_footer_settings();
        $get['title'] = 'General Setting';

        if ($this->request->getMethod() == 'post') {
            
            if ($_FILES['favicon']['name'] != "") {
                $rules=[ 'favicon' =>['uploaded[favicon]','max_size[favicon,1024]'] ];
                if ($this->validate($rules) == false) {
                    $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                    return redirect()->to(base_url('/admin/add_general_settings'));
                }

                $result = UploadFile($_FILES['favicon']);
                if($result['status'] == true){
                    $favicon = $result['result']['file_url'];
                }else{
                    $this->session->setFlashdata('error', $result['message']);
                    return redirect()->to(base_url('/admin/add_general_settings'));
                }
            }
           
            if ($_FILES['logo']['name'] != "") {
                $rules=[ 'logo' =>['uploaded[logo]','max_size[logo,1024]' ]
                ];
                if ($this->validate($rules) == false) {
                    $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                    return redirect()->to(base_url('/admin/add_general_settings'));
                }

                $result = UploadFile($_FILES['logo']);
                if ($result['status'] == true) {
                    $logo = $result['result']['file_url'];
                } else {
                    echo '0~'.$result['message'];
                    exit;
                }
            }
            
            if ($_FILES['home_banner']['name'] != "") {
                $rules=[ 'home_banner' =>['uploaded[home_banner]','max_size[home_banner,2048]' ]
                ];
                if ($this->validate($rules) == false) {
                    $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                    return redirect()->to(base_url('/admin/add_general_settings'));
                }

                $result = UploadFile($_FILES['home_banner']);
                if ($result['status'] == true) {
                    $home_banner = $result['result']['file_url'];
                } else {
                    echo '0~'.$result['message'];
                    exit;
                }
            }

            $data = array(
                'application_name' => $this->request->getPost('application_name'),
                'copyright' => $this->request->getPost('copyright'),
                'email_from' => $this->request->getPost('email_from'),
                'system_email' => $this->request->getPost('admin_email'),
                'smtp_host' => $this->request->getPost('smtp_host'),
                'smtp_port' => $this->request->getPost('smtp_port'),
                'smtp_user' => $this->request->getPost('smtp_user'),
                'smtp_pass' => $this->request->getPost('smtp_pass'),
                'facebook_link' => $this->request->getPost('facebook_link'),
                'twitter_link' => $this->request->getPost('twitter_link'),
                'google_link' => $this->request->getPost('google_link'),
                'youtube_link' => $this->request->getPost('youtube_link'),
                'linkedin_link' => $this->request->getPost('linkedin_link'),
                'instagram_link' => $this->request->getPost('instagram_link'),
                'recaptcha_secret_key' => $this->request->getPost('recaptcha_secret_key'),
                'recaptcha_site_key' => $this->request->getPost('recaptcha_site_key'),
                'recaptcha_lang' => $this->request->getPost('recaptcha_lang'),
                'razorpay_secret' => $this->request->getPost('razorpay_secret'),
                'razorpay_key' => $this->request->getPost('razorpay_key'),
                'x-key' => $this->request->getPost('x-key'),
                'x-secret' => $this->request->getPost('x-secret'),
                'created_date' => date('Y-m-d : h:m:s'),
                'updated_date' => date('Y-m-d : h:m:s'),
                'updated_date' => date('Y-m-d : h:m:s')
            );

            if ($_FILES['favicon']['name'] != "") {
                $data['favicon'] = $favicon;
            }
            if ($_FILES['logo']['name'] != "") {
                $data['logo'] = $logo;
            }
            
            if ($_FILES['home_banner']['name'] != "") {
                $data['home_banner'] = $home_banner;
            }

            $result = $this->adminModel->update_general_settings($data);
            if ($result) {
                // Footer Settings
                $footer_result = $this->add_footer_widget();
            }
            $this->session->setFlashdata('success', 'Setting has been changed Successfully!');
            return redirect()->to(base_url('/admin/add_general_settings'));
        }
        return view('admin/settings/general_settings', $get);
    }


    public function add_footer_widget()
    {
        $rules = [
            'widget_field_title_add' => ['label' => 'widget_field_title_add[]', 'rules' => 'required'],
            'widget_field_content_add' => ['label' => 'widget_field_content_add[]', 'rules' => 'required']
        ];
        if ($this->validate($rules) == FALSE) {
            $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
            return redirect()->to(base_url('admin/add_general_settings'));
        }
        //redirect(base_url('admin/add_general_settings'),'refresh');
        else {
            $total_widgets = count($this->request->getPost('widget_field_title_add[]'));
            $this->adminModel->delete_footer_all_setting();

            for ($i = 0; $i < $total_widgets; $i++) {
                $footerdata = array(
                    'title' => $this->request->getPost('widget_field_title_add[' . $i . ']'),
                    'grid_column' => $this->request->getPost('widget_field_column_add[' . $i . ']'),
                    'content' => $this->request->getPost('widget_field_content_add[' . $i . ']'),
                );
                $this->adminModel->update_footer_setting($footerdata);
            }
            return;
        }
    }

    // Sending Email to applicant
    public function send_interview_email()
    {
        $email = trim($this->request->getPost('email'));
        $title = trim($this->request->getPost('subject'));
        $message = trim($this->request->getPost('message'));

        $subject = 'Interview Message | Darwin Jobs';
        $message = '<p>Subject: ' . $title . '</p>
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


    public function newsletter()
    {
        if ($this->request->getPost('submit')) 
        {
            $rules = [
                'title' => ['label' => 'title', 'rules' =>'required'],
                'content' => ['label' => 'content', 'rules' => 'required']
            ];
            if ($this->validate($rules) == FALSE) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('admin/newsletters/list_newsletters'));
            }
            else{
                    $subscribers = $this->adminModel->get_subscribers($this->request->getPost('recipients'));
                    $body = $this->request->getPost('content');
                    $subject = $this->request->getPost('title');
                    if($this->mailer->send_newsletter($subscribers,$subject,$body))
                        $this->session->setFlashdata('success', 'Newsletter sent successfully');
                    else
                        $this->session->setFlashdata('error', 'Failed to Send Mail');
                    return redirect()->to(base_url('admin/list_newsletters'));
                }
        }

    }

    public function viewuser($id)
    {
        $data['title'] = 'User Details';
        $data['edu'] = $this->adminModel->get_seeker_education($id);
        $data['exper'] = $this->adminModel->get_user_experience($id);
        $data['language'] = $this->adminModel->get_user_language($id);
        $data['query'] = $this->adminModel->userdetails($id);
        return view('admin/users/viewuser',$data);
    }

}
