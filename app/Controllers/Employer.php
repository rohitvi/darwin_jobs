<?php

namespace App\Controllers;

use App\Libraries\Mailer;
use App\Models\AdminModel;
use App\Models\auth\EmployerAuthModel;
use App\Models\EmployerModel;

class Employer extends BaseController
{
    public function __construct()
    {
        $this->EmployerModel = new EmployerModel();
        $this->EmployerAuthModel = new EmployerAuthModel();
        $this->adminModel = new AdminModel();
        $this->mailer = new Mailer();
    }

    public function checklogin()
    {
        if (session('employer_logged_in')) {
            return redirect()->to('employer/dashboard');
        } else {
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
        $id = session('employer_id');
        $data['total_posted_jobs'] = $this->EmployerModel->total_posted_job($id);
        $data['job_seekers_applied'] = $this->EmployerModel->job_seekers_applied($id);
        $data['current_package'] = $this->EmployerModel->get_active_package();
        $data['total_featured_jobs'] = $this->EmployerModel->count_posted_jobs($data['current_package']['package_id'], 1, $data['current_package']['payment_id']);
        // pre($data);
        return view('employer/dashboard', $data);
    }

    public function login()
    {
        if (session('employer_logged_in')) {
            return redirect()->to(base_url('employer/dashboard'));
        }

        if ($this->request->isAJAX()) {
            $rules = [
                'email' => ['label' => 'email', 'rules' => 'required'],
                'password' => ['label' => 'password', 'rules' => 'required'],
            ];

            if ($this->validate($rules) == false) {
                echo '0~' . arrayToList($this->validation->getErrors());
                exit;
            }
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $logindata = $this->EmployerAuthModel->login_validate($email, $password);

            if ($logindata == 0) {
                echo '0~Invalid email or password';
                exit;
            } else {
                $employerdata = [
                    'employer_id' => $logindata['id'],
                    'employer_logged_in' => true,
                    'employer_username' => $logindata['username'],
                ];
                $this->session->set($employerdata);
                echo '1~ You Have Successfully Logged in';
                exit;
            }
        }
        return view('employer/auth/login');
    }

    public function personal_info_update()
    {
        if ($this->request->getMethod() == 'put') {
            if ($_FILES['profile_picture']['name'] != '') {
                $rules = [
                    'profile_picture' => ['uploaded[profile_picture]', 'max_size[profile_picture,1024]'],
                ];
                if ($this->validate($rules) == false) {
                    $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                    return redirect()->to(base_url('employer/profile'));
                }
                $result = UploadFile($_FILES['profile_picture']);
                if ($result['status'] == true) {
                    $url = $result['result']['file_url'];
                } else {
                    $this->session->setFlashdata('error', $result['message']);
                    return redirect()->to(base_url('employer/profile'));
                }
            }
            $update_per_info = array(
                'firstname' => $this->request->getPost('fname'),
                'lastname' => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'designation' => $this->request->getPost('designation'),
                'mobile_no' => $this->request->getPost('phoneno'),
                'country' => $this->request->getPost('country'),
                'state' => $this->request->getPost('state'),
                'city' => $this->request->getPost('city'),
                'address' => $this->request->getPost('address'),
            );

            if ($_FILES['profile_picture']['name'] != '') {
                $update_per_info['profile_picture'] = $url;
            }
            $id = session('employer_id');
            $update_per = $this->EmployerAuthModel->personal_info_update($update_per_info, $id);
            if ($update_per == 1) {
                $this->session->setFlashdata('success', 'Personal Information successfully Updated');
                return redirect()->to(base_url('employer/profile'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('employer/profile'));
            }
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('employer'));
    }

    public function changepassword()
    {
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'currentpassword' => ['label' => 'Current password', 'rules' => 'required'],
                'password' => ['label' => 'password', 'rules' => 'required'],
                'cpassword' => ['label' => 'cpassword', 'rules' => 'required|matches[password]']
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . $this->validation->listErrors();
                exit;
            }
            $id = session('employer_id');
            $data = array(
                'id' => $id,
                'old_password' => $this->request->getPost('currentpassword'),
                'new_password' =>  password_hash($this->request->getPost('cpassword'), PASSWORD_DEFAULT)
            );

            $query = $this->EmployerAuthModel->changepassword($id, $data);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'Password successfully Updated');
                return redirect()->to(base_url('employer/profile'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('employer/changepassword'));
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
        // pre( $get['data'] );
        return view('employer/auth/profile', $get);
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

    public function cmp_info_update()
    {
        if ($this->request->getMethod() == 'put') {

            if ($_FILES['company_logo']['name'] != '') {
                $rules = [
                    'company_logo' => ['uploaded[company_logo]', 'max_size[company_logo,1024]'],
                ];
                if ($this->validate($rules) == false) {
                    $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                    return redirect()->to(base_url('employer/profile'));
                }
                $result = UploadFile($_FILES['company_logo']);
                if ($result['status'] == true) {
                    $url = $result['result']['file_url'];
                } else {
                    $this->session->setFlashdata('error', $result['message']);
                    return redirect()->to(base_url('employer/profile'));
                }
            }

            $cmp_info_update = array(
                'company_name' => $this->request->getPost('company_name'),
                'email' => $this->request->getPost('email'),
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
                'address' => $this->request->getPost('address'),
                'facebook_link' => $this->request->getPost('facebook_link'),
                'twitter_link' => $this->request->getPost('twitter_link'),
                'youtube_link' => $this->request->getPost('youtube_link'),
                'linkedin_link' => $this->request->getPost('linkedin_link'),
            );

            if ($_FILES['company_logo']['name'] != '') {
                $cmp_info_update['company_logo'] = $url;
            }
            $id = session('employer_id');
            $update_per = $this->EmployerAuthModel->cmp_info_update($cmp_info_update, $id);
            if ($update_per == 1) {
                $this->session->setFlashdata('success', 'Company Information Successfully Updated');
                return redirect()->to(base_url('employer/cmp_info_update'));
            } else {
                $this->session->setFlashdata('error', 'Something Went Wrong, Please Try Again!');
                return redirect()->to(base_url('employer/cmp_info_update'));
            }
        }
        if ($this->request->isAJAX()) {
            $country_id = $this->request->getPost('country_id');
            $states = $this->adminModel->get_states_list($country_id);
            return json_encode($states);
            exit();
        }
        $id = session('employer_id');
        $get['categories'] = $this->adminModel->get_all_categories();
        $get['countries'] = $this->adminModel->get_countries_list();
        $get['data'] = $this->EmployerAuthModel->cmp_info($id);
        // pre($get['data']);exit;
        return view('employer/auth/company', $get);
    }

    // Packages Part

    public function packages()
    {
        $get['data'] = $this->EmployerModel->getpackages();
        return view('employer/packages/packages', $get);
    }

    public function package_confirmation($id)
    {
        $get['data'] = $this->EmployerModel->package_confirmation($id);
        if ($this->EmployerModel->check_if_bought(session('employer_id'), $id)) {
            $this->session->setFlashdata('success', 'Package Already Purchased');
            return redirect()->to(base_url('employer/mypackages'));
        }
        $get['id'] = $id;
        $get['title'] = 'Package Confirmation';
        return view('employer/packages/package_confirmation', $get);
    }

    public function payment()
    {
        if ($this->request->getMethod() == 'post') {
            if (session('employer_logged_in')) {
                $rules = [
                    'fullname' => ['label' => 'fullname', 'rules' => 'required'],
                    'payer_email' => ['label' => 'payer_email', 'rules' => 'required'],
                    'card_no' => ['label' => 'card_no', 'rules' => 'required'],
                    'mm' => ['label' => 'mm', 'rules' => 'required'],
                    'yy' => ['label' => 'yy', 'rules' => 'required'],
                    'cvv' => ['label' => 'cvv', 'rules' => 'required'],
                    'emp_id' => ['label' => 'emp_id', 'rules' => 'required'],
                ];
                if ($this->validate($rules) == false) {
                    $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                    return redirect()->to(base_url('employer/package_confirmation'));
                }
                $data = [
                    'payment_method' => 'credit card',
                    'txn_id' => 'txn_1FXkFpHDx7jzBoS98m5C2Jpl',
                    'user_id' => '0',
                    'employer_id' => session('employer_id'),
                    'payment_amount' => $this->request->getPost('payment_amount'),
                    'payer_email' => $this->request->getPost('payer_email'),
                    'payment_status' => 'succeeded',
                    'purchased_plan' => $this->request->getPost('purchased_plan'),
                ];
                $query = $this->EmployerModel->payment($data);
                if ($query == 0) {
                    $this->session->setFlashdata('error', 'Something went wrong, please try again');
                    return redirect()->to(base_url('employer/packages'));
                } elseif ($query['status'] == 1) {
                    $date = date("y-m-d G.i:s");
                    if ($this->request->getPost('package_days') == 45) {
                        $exp_date = date('y-m-d G.i:s', strtotime(' + 45 days'));
                    } elseif ($this->request->getPost('package_days') == 30) {
                        $exp_date = date('y-m-d G.i:s', strtotime(' + 30 days'));
                    } elseif ($this->request->getPost('package_days') == 90) {
                        $exp_date = date('y-m-d G.i:s', strtotime(' + 90 days'));
                    }
                    $package_info = [
                        'payment_id' => $query['payment_id'],
                        'employer_id' => $query['employer_id'],
                        'user_id' => 0,
                        'package_id' => $this->request->getPost('package_id'),
                        'is_renewal' => 0,
                        'is_upgrade' => 0,
                        'buy_date' => $date,
                        'expire_date' => $exp_date,
                        'is_active' => 1,
                    ];
                    $pay_query = $this->EmployerModel->packages_bought($package_info);
                    if ($pay_query->resultID == 1) {
                        $this->session->setFlashdata('success', 'Package Successfully Purchased');
                        return redirect()->to(base_url('employer/mypackages'));
                    } else {
                        $this->session->setFlashdata('error', 'Something went wrong, please try again');
                        return redirect()->to(base_url('employer/packages'));
                    }
                }
            } else {
                return redirect()->to(base_url('employer/login'));
            }
        }
    }

    public function mypackages()
    {
        $id = session('employer_id');
        $get['data'] = $this->EmployerModel->mypackages($id);
        return view('employer/packages/my_packages', $get);
    }

    public function my_package_details($package_id)
    {
        $get['data'] = $this->EmployerModel->mypackagedetails($package_id);
        return view('employer/packages/my_package_details', $get);
    }

    public function register()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'firstname' => ['label' => 'First Name', 'rules' => 'required'],
                'company_name' => ['label' => 'Company Name', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required'],
                'password' => ['label' => 'Password', 'rules' => 'required'],
                'cpassword' => ['label' => 'Confirm Password', 'rules' => 'required|matches[password]'],
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . arrayToList($this->validation->getErrors());
                exit;
            }
            $user_details = [
                'firstname' => $this->request->getPost('firstname'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            $cmpny = [
                'company_name' => $this->request->getPost('company_name'),
            ];
            $cmpny['employer_id'] = $this->EmployerAuthModel->register($user_details);
            $result = $this->EmployerAuthModel->registercmpny($cmpny);
            // Add Free Packages
            $package_details = $this->EmployerModel->get_free_package();
            $buyer_array = [
                'employer_id' => $cmpny['employer_id'],
                'package_id' => $package_details[0]['id'],
                'user_id' => 0,
                'expire_date' => add_30_days($package_details[0]['no_of_days']),
                'buy_date' => date('Y-m-d : h:m:s'),
            ];
            $package_bought = $this->EmployerModel->packages_bought($buyer_array);
            if ($result->resultID == 1) {
                echo '1~Employer Successfully Registered !';
                exit;
            } else {
                echo '0~Something Went Wrong, Please Try Again !';
                exit;
            }
        }
        return view('employer/auth/register');
    }

    public function shortlisted()
    {
        $id = session('employer_id');
        $get['data'] = $this->EmployerModel->shortlisted($id);
        return view('employer/resume/shortlisted_resume2', $get);
    }

    public function userdetails($id)
    {
        if ($this->request->isAJAX()) {
            $education = $this->EmployerModel->get_seeker_education($id);
            // pre($education);
            $experience = $this->EmployerModel->get_user_experience($id);
            $language = $this->EmployerModel->get_user_language($id);
            $query = $this->EmployerModel->userdetails($id);
            $html = '';
            $html .= '<div class="row">
                        <div class="col-6">
                            <h4>Personal Details</h4>
                            <hr>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Full Name</td>
                                        <td>' . $query[0]["firstname"] . ' ' . $query[0]["lastname"] . '</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>' . $query[0]["email"] . '</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>' . $query[0]["mobile_no"] . '</td>
                                    </tr>
                                    <tr>
                                        <td>Date Of Birth</td>
                                        <td>' . $query[0]["dob"] . '</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>' . get_category_name($query[0]["category"]) . '</td>
                                    </tr>
                                    <tr>
                                        <td>User Job Title</td>
                                        <td>' . ($query[0]["job_title"]) . '</td>
                                    </tr>
                                    <tr>
                                        <td>Experience</td>
                                        <td>' . $query[0]["experience"] . ' years</td>
                                    </tr>
                                    <tr>
                                        <td>Skills</td>
                                        <td>' . $query[0]["skills"] . '</td>
                                    </tr>
                                    <tr>
                                        <td>Current Salary (INR)</td>
                                        <td>' . $query[0]["current_salary"] . ' (INR)</td>
                                    </tr>
                                    <tr>
                                        <td>Nationality</td>
                                        <td>' . get_country_name($query[0]["nationality"]) . '</td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td>' . get_country_name($query[0]["country"]) . '</td>
                                    </tr>
                                    <tr>
                                        <td>City / Town</td>
                                        <td>' . get_city_name($query[0]["city"]) . '</td>
                                    </tr>
                                    <tr>
                                        <td>Postcode</td>
                                        <td>' . $query[0]["postcode"] . '</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>' . $query[0]["address"] . '</td>
                                    </tr>
                                    <tr>
                                        <td>Objectives</td>
                                        <td>Objectives</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">';
            if ($education) {
                $html .=
                    '<h4>Education</h4>
                            <hr>
                            <p>' . $education[0]["type"] . ',' . $education[0]["degree_title"] . '</p>
                            <p>' . $education[0]["institution"] . '</p>
                            <p>' . $education[0]["completion_year"] . '</p>
                            <h4>Experience</h4>';
            }
            if ($experience) {
                $html .= '
                            <hr>
                            <p>' . $experience[0]["job_title"] . '</p>
                            <p>' . $experience[0]["company"] . '</p>
                            <p>' . get_month($experience[0]["starting_month"]) . ' ' . $experience[0]["starting_year"] . ' - ' . $experience[0]["ending_month"] . ' ' . $experience[0]["ending_year"] . ' | ' . get_country_name($experience[0]["country"]) . '</p>
                            <p>' . $experience[0]["job_title"] . '</p>
                            <p>' . $experience[0]["description"] . '</p>
                            ';
            }
            if ($language) {
                $html .= '
                            <h4>Languages</h4>
                            <hr>
                            <p>' . $language[0]["lang_name"] . '</p>
                            ';
            }
            $html .= '</div>
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
        $job_title_slug = make_slug($job_title) . '-job-in-' . make_slug($city); // make slug is a helper function
        $final_job_url = $job_title_slug;
        return $final_job_url;
    }

    public function post()
    {
        $pkg = $this->EmployerModel->get_active_package();
        $pkg_id = $pkg['package_id'];
        if (empty($pkg['package_id'])) {
            $this->session->setFlashdata('error', 'Package is Expired');
            return redirect()->to(base_url('employer/packages'));
        }

        // Free Job post
        $total_free_jobs = $this->EmployerModel->count_posted_jobs($pkg_id, 0, $pkg['payment_id']);
        if ($total_free_jobs >= $pkg['no_of_posts']) {
            $this->session->setFlashdata('error', 'Post Limit Exceeded');
            return redirect()->to(base_url('employer/packages'));
        }

        //Featured Job Post
        $total_featured_jobs = $this->EmployerModel->count_posted_jobs($pkg_id, 1, $pkg['payment_id']);
        if ($total_featured_jobs >= $pkg['no_of_posts']) {
            $this->session->setFlashdata('error', 'Package Expired');
            return redirect()->to(base_url('employer/packages'));
        }

        if ($this->request->getMethod() == 'post') {
            $rules = [
                "employer_id" => ["label" => "employer_id", "rules" => "trim|required"],
                "company_id" => ["label" => "company_id", "rules" => "trim|required"],
                "job_title" => ["label" => "job_title", "rules" => "trim|required"],
                "category" => ["label" => "category", "rules" => "trim|required"],
                "industry" => ["label" => "industry", "rules" => "trim|required"],
                "min_experience" => ["label" => "min_experience", "rules" => "trim|required"],
                "max_experience" => ["label" => "max_experience", "rules" => "trim|required"],
                "salary_period" => ["label" => "salary period", "rules" => "trim|required"],
                "min_salary" => ["label" => "min_salary", "rules" => "trim|required"],
                "max_salary" => ["label" => "max_salary", "rules" => "trim|required"],
                "skills" => ["label" => "skills", "rules" => "trim|required"],
                "description" => ["label" => "description", "rules" => "trim|required|min_length[3]"],
                "total_positions" => ["label" => "total_positions", "rules" => "trim|required"],
                "gender" => ["label" => "gender", "rules" => "trim|required"],
                "employment_type" => ["label" => "employment type", "rules" => "trim|required"],
                "education" => ["label" => "education", "rules" => "trim|required"],
                "country" => ["label" => "country", "rules" => "trim|required"],
                "state" => ["label" => "state", "rules" => "trim|required"],
                "city" => ["label" => "city", "rules" => "trim|required"],
                "location" => ["label" => "location", "rules" => "trim|required"],
            ];
            if ($this->validate($rules) == false) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('employer/post'));
            }
            $data = array(
                'employer_id' => $this->request->getPost('employer_id'),
                'company_id' => $this->request->getPost('company_id'),
                'title' => $this->request->getPost('job_title'),
                'job_type' => $this->request->getPost('job_type'),
                'category' => $this->request->getPost('category'),
                'employment_type' => $this->request->getPost('employment_type'),
                'industry' => $this->request->getPost('industry'),
                'description' => $this->request->getPost('description'),
                'salary_period' => $this->request->getPost('salary_period'),
                'min_salary' => $this->request->getPost('min_salary'),
                'max_salary' => $this->request->getPost('max_salary'),
                'education' => $this->request->getPost('education'),
                'experience' => $this->request->getPost('min_experience') . '-' . $this->request->getPost('max_experience'),
                'gender' => $this->request->getPost('gender'),
                'total_positions' => $this->request->getPost('total_positions'),
                'skills' => $this->request->getPost('skills'),
                'country' => $this->request->getPost('country'),
                'state' => $this->request->getPost('state'),
                'city' => $this->request->getPost('city'),
                'location' => $this->request->getPost('location'),
                'expiry_date' => $pkg['expire_date'],
                'created_date' => date('Y-m-d : H:i:s'),
                'updated_date' => date('Y-m-d : H:i:s'),
            );
            $data['job_slug'] = $this->make_job_slug($this->request->getPost('job_title'), $this->request->getPost('city'));
            $job_id = $this->EmployerModel->postjob($data);
            // Featured Job Details
            $featured_data = array(
                'employer_id' => session('employer_id'),
                'job_id' => $job_id,
                'package_id' => $pkg['package_id'],
                'payment_id' => $pkg['payment_id'],
                'is_featured' => ($pkg['price'] == 0) ? 0 : 1,
            );
            $result = $this->EmployerModel->add_featured_job($featured_data);
            if ($result) {
                $this->session->setFlashdata('success', 'Job successfully posted');
                return redirect()->to(base_url('employer/list_jobs'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('employer/post'));
            }
        }

        $get['companies'] = $this->EmployerModel->get_companies(session('employer_id'));
        $get['job_type'] = get_job_type_list();
        $get['job_category'] = get_category_list();
        $get['industry'] = get_industry_list();
        $get['employment'] = get_employment_type_list();
        $get['educations'] = $this->EmployerModel->get_education();
        $get['countries'] = $this->EmployerModel->get_countries_list();
        return view('employer/job/post', $get);
    }

    public function list_jobs()
    {
        return view('employer/job/job_list');
    }

    public function datatable_json()
    {
        $records = $this->EmployerModel->list_jobs();
        $data = array();

        $i = 1;
        foreach ($records['data'] as $row) {
            $buttoncontroll = '<a class="btn btn-sm btn-success" href=' . base_url("employer/edit_job/" . $row['id']) . ' title="View" >
                 <i class="la la-eye"></i></a>&nbsp

                  <a class="edit btn btn-sm btn-primary" href=' . base_url("employer/edit_job/" . $row['id']) . ' title="Edit" >
                 <i class="la la-edit"></i></a>&nbsp;

                 <a class="btn-delete btn btn-sm btn-danger" href=' . base_url("employer/delete_job/" . $row['id']) . ' title="Delete" onclick="return confirm(\'Do you want to delete ?\')">
                 <i class="la-trash"></i></a>';

            $data[] = array(
                $i++,
                $row['title'],
                '<a class="edit btn btn-sm btn-info mb-3" href=' . base_url("employer/view_job_applicants/" . $row['id']) . ' title="Applicants" >
                 Applied [ ' . $row['cand_applied'] . ' ]
                </a>
                <a class="edit btn btn-sm btn-info" href=' . base_url("employer/shortlisted_applicants/" . $row['id']) . ' title="Applicants" >
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

    public function edit_job($id)
    {
        $get['companies'] = $this->EmployerModel->get_companies(session('employer_id'));
        $get['job_type'] = get_job_type_list();
        $get['job_category'] = get_category_list();
        $get['industry'] = get_industry_list();
        $get['employment'] = get_employment_type_list();
        $get['educations'] = $this->EmployerModel->get_education();
        $get['countries'] = $this->EmployerModel->get_countries_list();
        $get['data'] = $this->EmployerModel->edit_job($id);
        return view('employer/job/edit_job', $get);
    }

    public function updatejob($id)
    {
        if ($this->request->getMethod() == 'put') {
            $rules = [
                "employer_id" => ["label" => "employer_id", "rules" => "trim|required"],
                "company_id" => ["label" => "company_id", "rules" => "trim|required"],
                "job_title" => ["label" => "job_title", "rules" => "trim|required"],
                "category" => ["label" => "category", "rules" => "trim|required"],
                "industry" => ["label" => "industry", "rules" => "trim|required"],
                "min_experience" => ["label" => "min_experience", "rules" => "trim|required"],
                "max_experience" => ["label" => "max_experience", "rules" => "trim|required"],
                "salary_period" => ["label" => "salary period", "rules" => "trim|required"],
                "min_salary" => ["label" => "min_salary", "rules" => "trim|required"],
                "max_salary" => ["label" => "max_salary", "rules" => "trim|required"],
                "skills" => ["label" => "skills", "rules" => "trim|required"],
                "description" => ["label" => "description", "rules" => "trim|required|min_length[3]"],
                "total_positions" => ["label" => "total_positions", "rules" => "trim|required"],
                "gender" => ["label" => "gender", "rules" => "trim|required"],
                "employment_type" => ["label" => "employment type", "rules" => "trim|required"],
                "education" => ["label" => "education", "rules" => "trim|required"],
                "country" => ["label" => "country", "rules" => "trim|required"],
                "state" => ["label" => "state", "rules" => "trim|required"],
                "city" => ["label" => "city", "rules" => "trim|required"],
                "location" => ["label" => "location", "rules" => "trim|required"],
            ];
            if ($this->validate($rules) == false) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('employer/list_jobs'));
            }
            $data = array(
                'employer_id' => $this->request->getPost('employer_id'),
                'company_id' => $this->request->getPost('company_id'),
                'title' => $this->request->getPost('job_title'),
                'job_type' => $this->request->getPost('job_type'),
                'category' => $this->request->getPost('category'),
                'employment_type' => $this->request->getPost('employment_type'),
                'industry' => $this->request->getPost('industry'),
                'description' => $this->request->getPost('description'),
                'salary_period' => $this->request->getPost('salary_period'),
                'min_salary' => $this->request->getPost('min_salary'),
                'max_salary' => $this->request->getPost('max_salary'),
                'education' => $this->request->getPost('education'),
                'experience' => $this->request->getPost('min_experience') . '-' . $this->request->getPost('max_experience'),
                'gender' => $this->request->getPost('gender'),
                'total_positions' => $this->request->getPost('total_positions'),
                'skills' => $this->request->getPost('skills'),
                'country' => $this->request->getPost('country'),
                'state' => $this->request->getPost('state'),
                'city' => $this->request->getPost('city'),
                'location' => $this->request->getPost('location'),
                'created_date' => date('Y-m-d : H:i:s'),
                'updated_date' => date('Y-m-d : H:i:s'),
            );
            $query = $this->EmployerModel->updatejob($id, $data);
            if ($query == 1) {
                $this->session->setFlashdata('success', 'Job successfully updated');
                return redirect()->to(base_url('employer/list_jobs'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('employer/edit_job/' . $id));
            }
        }
    }

    public function delete_job($id)
    {
        $query = $this->EmployerModel->delete_job($id);
        if ($query->resultID == 1) {
            $this->session->setFlashdata('success', 'Job successfully deleted');
            return redirect()->to(base_url('employer/list_jobs'));
        } else {
            $this->session->setFlashdata('error', 'Something went wrong, please try again');
            return redirect()->to(base_url('employer/list_jobs'));
        }
    }

    public function view_job_applicants($job_id)
    {
        $data['applicants'] = $this->EmployerModel->get_applicants($job_id);
        $data['title'] = 'Job Applicants';
        return view('employer/job/view_job_applicants', $data);
    }

    public function search()
    {
        $search = array();
        $get['profiles'] = array();
        $get['categories'] = $this->adminModel->get_all_categories();
        $get['states'] = $this->EmployerModel->get_states_list();
        $get['education'] = get_education_list();

        if ($this->request->getMethod() == 'post') {

            $rules = [
                "job_title" => ["label" => "Job Title", "rules" => "trim|required"]
            ];
            if ($this->validate($rules) == false) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('employer/search'));
                exit;
            }

            // search job title, keyword
            if (!empty($this->request->getPost('job_title'))) {
                $search['job_title'] = $this->request->getPost('job_title');
            }

            if (!empty($this->request->getPost('category'))) {
                $search['category'] = $this->request->getPost('category');
            }

            if (!empty($this->request->getPost('state'))) {
                $search['state'] = $this->request->getPost('state');
            }

            if (!empty($this->request->getPost('expected_salary'))) {
                $search['expected_salary'] = $this->request->getPost('expected_salary');
            }

            if (!empty($this->request->getPost('education_level'))) {
                $search['education_level'] = $this->request->getPost('education_level');
            }

            if (!empty($this->request->getPost('experience'))) {
                $search['experience'] = $this->request->getPost('experience');
            }

            $query = http_build_query($search);
            return redirect()->to(base_url('employer/search?' . $query));
        }
        $query_str = parse_url(current_url(true), PHP_URL_QUERY);
        parse_str($query_str, $search);

        $get['search_value'] = $search;
        $Users = new EmployerModel();
        $Users->setTable('users');
        $get['profiles'] = $Users->get_user_profiles($search);
        $get['pager'] = $Users->pager;

        return view('employer/cv_search/cv_search_page', $get);
    }

    public function make_shortlist($id, $job_id)
    {
        if ($this->EmployerModel->do_shortlist($id)) {
            $user_email = $this->EmployerModel->get_applied_candidate_email($id);
            $job = get_job_detail($job_id);
            // sending shortlisted email
            $mail_data = array(
                'job_title' => $job['title'],
            );
            $this->mailer->mail_template($user_email, 'candidate-shortlisted', $mail_data);
            $this->session->setFlashdata('success', 'Congratulation! Applicant Shortlisted successfully');
            return redirect()->to(base_url('employer/shortlisted_applicants/' . $job_id));
        } else {
            $this->session->setFlashdata('error', 'Oops Somthing went wrong, please try gain letter');
            return redirect()->to(base_url('employer/view_job_applicants/' . $job_id));
        }
    }

    public function shortlisted_applicants($job_id)
    {
        $data['applicants'] = $this->EmployerModel->get_shortlisted_applicants($job_id);
        $data['title'] = 'Shortlisted Applicants';
        return view('employer/job/shortlist_applicants', $data);
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
            exit;
        } else {
            echo 'There is a problem while sending email !';
            exit;
        }
    }

    public function interview($id)
    {
        if ($this->request->isAJAX()) {
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
                echo '1~Email has been sent successfully !';
            } else {
                echo '0~There is a problem while sending email !';
            }
        }
    }

    public function password_reset()
    {
        if ($this->request->isAJAX()) {
            $email = trim($this->request->getPost('email'));
            $response = $this->EmployerAuthModel->check_email($email);
            if ($response) {
                $rand_no = rand(0, 1000);
                $pwd_reset_code = md5($rand_no . $response[0]['id']);
                $query = $this->EmployerAuthModel->update_reset_code($pwd_reset_code, $response[0]['id']);
                // Sending Email
                $name = $response[0]['firstname'] . ' ' . $response[0]['lastname'];
                $email = $response[0]['email'];
                $reset_link = base_url('employer/reset_password/' . $pwd_reset_code);
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
        return view('employer/auth/password_reset');
    }

    public function reset_password($reset_code)
    {
        $check_reset['data'] = $this->EmployerAuthModel->check_reset_code($reset_code);
        return view('employer/auth/reset_password', $check_reset);
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
            $query = $this->EmployerAuthModel->update_reset_password($password, $id);
            if ($query) {
                echo '1~Password changed successfully !';
            } else {
                echo '0~Something went wrong, please try again !';
            }
        }
    }

    public function candidates_shortlisted($user_id)
    {
        $emp_id = session('employer_id');
        $result = $this->EmployerModel->candidates_shortlisted($emp_id, $user_id);
        if ($result) {
            return redirect()->to(base_url('employer/shortlisted'));
        }
    }

    public function getPackageInfo()
    {
        if ($this->request->isAJAX()) {
            $emp_id = session('employer_id');
            $package_id = $this->request->getPost('package_id');
            $result = $this->EmployerModel->getPackageInfo($package_id);
            echo json_encode($result);
            exit;
        }
    }

    public function process_payment()
    {
        $emp_id = session('employer_id');
        (!$emp_id) ? redirect(base_url('employer/packages')) : "";
        if ($this->input->post('payment_type') == 'razorpay') {
            $capture_amount = $this->input->post('totalAmount'); //% by 100
            $data['user_id']              = $this->session->userdata('user_id');
            $data['payment_id']       = $this->input->post("razorpay_payment_id");
            $data['tax_rate']       = $this->input->post("taxRate");
            $data['shipping_chrgs']       = $this->input->post("shippingChrgs");
            $data['payment_type']       = 'Razorpay';
            $data['payment_status']     = 'due';
            $data['payment_details']    = 'none';
            $data['amount']             = $capture_amount / 100;
            $data['payment_timestamp']  = date('Y-m-d H:i:s');
            $this->db->insert('payments', $data);
            $insert_id = $this->db->insert_id();
            $this->session->set_userdata('payment_id', $insert_id);
            $razorpay_key = get_DirectValue('general_setting', 'value', 'name', 'razorpay_public_key');
            $razorpay_secret = get_DirectValue('general_setting', 'value', 'name', 'razorpay_secret_key');

            $api = new Api($razorpay_key, $razorpay_secret);
            if (isset($_POST['razorpay_payment_id']) === false) {
                die("Payment Failed. Please Retry!");
            }
            $id = $this->input->post('razorpay_payment_id');
            $payment  = $api->payment->fetch($id);

            if ($payment['status'] == 'authorized' || $payment['status'] == 'captured' || $payment['status'] == 'created') {
                $payment  =  $api->payment->fetch($id)->capture(array('amount' => $capture_amount));
                $this->razorpay_success();
            } else {
                $this->razorpay_cancel();
            }
        }

        // check other payments type here

    }

    /* FUNCTION: Verify razorpay payment*/
    public function razorpay_success()
    {
        $payment_id                = $this->session->userdata('payment_id');
        $data['payment_details']   = json_encode($_POST);
        $data['payment_timestamp'] = date('Y-m-d H:i:s');
        $data['payment_type']      = 'Razorpay';
        $data['payment_status']    = 'paid';
        $this->db->where('id', $payment_id)->update('payments', $data);
        $user_id = $this->session->userdata("user_id");
        $orderID = $this->input->post("orderId");
        $phone = $this->input->post("phone");
        $email = $this->input->post("email");
        $data = [
            'payment_id' => $this->input->post("razorpay_payment_id"),
            'payment_method' => 'Online',
            'order_status' => '1',
            'mobile' => $phone,
            'email' => $email,
            'final_price' => $this->input->post('totalAmount') / 100 //% by 100
        ];
        if ($this->db->where("order_number", $orderID)->where("user_id", $user_id)->update("orders", $data) && $this->db->where("user_id", $user_id)->delete("user_cart")) {
            $this->api_return(["status" => 200]);
        } else {
            var_dump($this->db->error());
            $this->api_return(["status" => 500]);
        }
        return 1;
    }

    public function razorpay_cancel()
    {
        $payment_id = $this->session->userdata('payment_id');
        $this->db->where('id', $payment_id);
        $this->db->delete('payments');
        return 0; //msg here 
    }
}
