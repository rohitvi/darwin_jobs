<?php

namespace App\Controllers;

require_once APPPATH . 'Libraries/razorpay-php/Razorpay.php';

use App\Libraries\Mailer;
use App\Models\AdminModel;
use App\Models\auth\EmployerAuthModel;
use App\Models\EmployerModel;
use Razorpay\Api\Api;

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
        if (!employer_vaidate()) {
            return redirect()->to(base_url('/employer/login'));
        } elseif (!employer_vaidate('check_profile')) {
            return redirect()->to(base_url('employer/setup/profile'));
        }

        $id = session('employer_id');
        $data['total_posted_jobs'] = $this->EmployerModel->total_posted_job($id);
        $data['job_seekers_applied'] = $this->EmployerModel->job_seekers_applied($id);
        $data['current_package'] = $this->EmployerModel->get_active_package($id);
        $data['total_featured_jobs'] = $this->EmployerModel->count_posted_jobs($data['current_package']['package_id'], 1, $data['current_package']['payment_id']);
        $data['title'] = 'Employer Dashboard';
        $data['result'] = $this->EmployerModel->set_expired_time($id, $data['current_package']['package_id']);
        if ($data['result'] == 1) {
            $this->session->setFlashdata('error', 'Package Days Expired');
        }
        return view('employer/dashboard', $data);
    }

    public function login()
    {
        if (session('employer_logged_in')) {
            return redirect()->to(base_url('employer/dashboard'));
        }

        if ($this->request->isAJAX()) {
            $rules = [
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
                'password' => ['label' => 'Password', 'rules' => 'required|min_length[8]'],
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
            } elseif ($logindata == 2) {
                echo '2~Your Account is not active please, contact to support';
                exit;
            } else {
                $employerdata = [
                    'employer_id' => $logindata['id'],
                    'employer_logged_in' => true,
                    'employer_username' => $logindata['username'],
                    'profile_completed' => $logindata['profile_completed'],
                    'company_completed' => $logindata['company_completed'],
                    'is_verify' => $logindata['is_verify'],
                ];
                $this->session->set($employerdata);
                echo '1~ You Have Successfully Logged in';
                exit;
            }
        }
        $data['title'] = 'Employer Login';
        return view('employer/auth/login', $data);
    }

    public function personal_info_update()
    {
        if ($this->request->getMethod() == 'post') {
            if ($_FILES['profile_picture']['name'] != '') {
                $result = UploadFile($_FILES['profile_picture']);
                if ($result['status'] == true) {
                    $url = $result['result']['file_url'];
                } else {
                    $this->session->setFlashdata('error', $result['message']);
                    return redirect()->to(base_url('employer/profile'));
                }
                $rules = ['profile_picture' => ['uploaded[profile_picture]', 'max_size[profile_picture,1024]|required']];
            }
            $rules = [
                'firstname' => ['label' => 'First Name', 'rules' => 'required'],
                'lastname' => ['label' => 'Last Name', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
                'designation' => ['label' => 'Designation', 'rules' => 'required'],
                'mobile_no' => ['label' => 'Mobile No.', 'rules' => 'required'],
                'country' => ['label' => 'Country', 'rules' => 'required'],
                'state' => ['label' => 'State', 'rules' => 'required'],
                'city' => ['label' => 'City', 'rules' => 'required'],
                'address' => ['label' => 'Address', 'rules' => 'required'],
            ];

            if ($this->validate($rules) == false) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('employer/profile'));
            }
            $update_per_info = array(
                'firstname' => ucwords($this->request->getPost('firstname')),
                'lastname' => ucwords($this->request->getPost('lastname')),
                'email' => $this->request->getPost('email'),
                'designation' => ucwords($this->request->getPost('designation')),
                'mobile_no' => $this->request->getPost('mobile_no'),
                'country' => $this->request->getPost('country'),
                'state' => $this->request->getPost('state'),
                'city' => $this->request->getPost('city'),
                'address' => ucwords($this->request->getPost('address')),
                'profile_completed' => 1,
            );

            if ($_FILES['profile_picture']['name'] != '') {
                $update_per_info['profile_picture'] = $url;
            }
            $id = session('employer_id');
            $update_per = $this->EmployerAuthModel->personal_info_update($update_per_info, $id);
            if ($update_per == 1) {
                $this->session->set('profile_completed', 1);
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
        if (!employer_vaidate()) {
            return redirect()->to(base_url('/employer/login'));
        } elseif (!employer_vaidate('check_profile')) {
            return redirect()->to(base_url('employer/setup/profile'));
        }
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'currentpassword' => ['label' => 'Current password', 'rules' => 'required'],
                'password' => ['label' => 'Password', 'rules' => 'required'],
                'cpassword' => ['label' => 'Confirm password', 'rules' => 'required|matches[password]'],
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . $this->validation->listErrors();
                exit;
            }
            $id = session('employer_id');
            $data = array(
                'id' => $id,
                'old_password' => $this->request->getPost('currentpassword'),
                'new_password' => password_hash($this->request->getPost('cpassword'), PASSWORD_DEFAULT),
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
        $data['title'] = 'Change Password';
        return view('employer/auth/changepassword', $data);
    }

    public function profile()
    {
        if (!employer_vaidate()) {
            return redirect()->to(base_url('/employer/login'));
        } elseif (!employer_vaidate('check_profile')) {
            return redirect()->to(base_url('employer/setup/profile'));
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
        $get['data'] = $this->EmployerAuthModel->personal_info($id);
        $get['title'] = 'Personal Info';
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
        if (!employer_vaidate()) {
            return redirect()->to(base_url('/employer/login'));
        } elseif (!employer_vaidate('check_profile')) {
            return redirect()->to(base_url('employer/setup/profile'));
        }
        if ($this->request->getMethod() == 'post') {
            if ($_FILES['company_logo']['name'] != '') {
                $rules = ['company_logo' => ['uploaded[company_logo]', 'max_size[company_logo,1024]']];
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
            $rules = [
                'company_name' => ['label' => 'Company Name', 'rules' => 'required'],
                'email' => ['label' => 'Company Email', 'rules' => 'required'],
                'phone_no' => ['label' => 'Phone No', 'rules' => 'required'],
                'website' => ['label' => 'Company Website', 'rules' => 'required'],
                'category' => ['label' => 'Category', 'rules' => 'required'],
                'org_type' => ['label' => 'Organization Type', 'rules' => 'required'],
                'no_of_employers' => ['label' => 'No. of Employers', 'rules' => 'required'],
                'description' => ['label' => 'Comapany Description', 'rules' => 'required'],
                'country' => ['label' => 'Country', 'rules' => 'required'],
                'state' => ['label' => 'State', 'rules' => 'required'],
                'city' => ['label' => 'City', 'rules' => 'required'],
                'postcode' => ['label' => 'Pin Code', 'rules' => 'required'],
                'address' => ['label' => 'Address', 'rules' => 'required'],

            ];
            if ($this->validate($rules) == false) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('employer/cmp_info_update'));
            }

            $cmp_info_update = array(
                'company_name' => ucwords($this->request->getPost('company_name')),
                'email' => $this->request->getPost('email'),
                'phone_no' => $this->request->getPost('phone_no'),
                'website' => $this->request->getPost('website'),
                'category' => $this->request->getPost('category'),
                'org_type' => $this->request->getPost('org_type'),
                'no_of_employers' => $this->request->getPost('no_of_employers'),
                'description' => ucwords($this->request->getPost('description')),
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
                $this->EmployerAuthModel->cmpy_cmpld($id);
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
        $get['title'] = 'Company Information';
        return view('employer/auth/company', $get);
    }

    // Packages Part

    public function packages()
    {
        if (!employer_vaidate()) {
            return redirect()->to(base_url('/employer/login'));
        } elseif (!employer_vaidate('check_profile')) {
            return redirect()->to(base_url('employer/setup/profile'));
        }
        $get['data'] = $this->EmployerModel->getpackages();
        $get['title'] = 'Membership Plans';
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

    public function mypackages()
    {
        if (!employer_vaidate()) {
            return redirect()->to(base_url('/employer/login'));
        } elseif (!employer_vaidate('check_profile')) {
            return redirect()->to(base_url('employer/setup/profile'));
        }
        $id = session('employer_id');
        $get['data'] = $this->EmployerModel->mypackages($id);
        $get['title'] = 'My Packages List';
        return view('employer/packages/my_packages', $get);
    }

    public function my_package_details($package_id)
    {
        $get['data'] = $this->EmployerModel->mypackagedetails($package_id);
        $get['title'] = 'Packages Details';
        return view('employer/packages/my_package_details', $get);
    }

    public function register()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'firstname' => ['label' => 'First Name', 'rules' => 'required'],
                'company_name' => ['label' => 'Company Name', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required|is_unique[employers.email]|valid_email'],
                'password' => ['label' => 'Password', 'rules' => 'required|min_length[8]'],
                'cpassword' => ['label' => 'Confirm Password', 'rules' => 'required|matches[password]'],
                'termsncondition' => ['label' => 'Terms & Conditions', 'rules' => 'required'],
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . arrayToList($this->validation->getErrors());
                exit;
            }
            $user_details = [
                'firstname' => ucwords($this->request->getPost('firstname')),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), 'is_verify' => 0,
                'is_verify' => 0,
                'token' => md5(rand(0, 1000)),
                'created_date' => date('Y-m-d : h:m:s'),
                'updated_date' => date('Y-m-d : h:m:s'),
            ];
            $cmpny = [
                'company_name' => ucwords($this->request->getPost('company_name')),
            ];
            $employer_id = $this->EmployerAuthModel->register($user_details);
            if ($employer_id == 0) {
                echo '0~Error';
                exit;
            }
            $cmpny['employer_id'] = $employer_id;
            $result = $this->EmployerAuthModel->registercmpny($cmpny);
            if ($result->resultID != 1) {
                $this->EmployerAuthModel->delete_emp_cmpy();
                echo '0~Error';
                exit;
            }
            // Add Free Packages
            $package_details = $this->EmployerModel->get_free_package();
            if ($package_details != 0) {
                $buyer_array = [
                    'employer_id' => $cmpny['employer_id'],
                    'package_id' => $package_details['id'],
                    'user_id' => 0,
                    'expire_date' => add_30_days($package_details['no_of_days']),
                    'buy_date' => date('Y-m-d : h:m:s'),
                ];
                $package_bought = $this->EmployerModel->packages_bought($buyer_array);
                if ($package_bought->resultID == 1) {
                    $this->mailer->send_verification_email($cmpny['employer_id'], 'employer');
                    echo '1~Employer Successfully Registered !';
                    exit;
                } else {
                    echo '0~Something Went Wrong, Please Try Again';
                    exit;
                }
            } else {
                echo '0~Something Went Wrong, Please Try Again';
                exit;
            }
        }
        $get['title'] = 'Employer Registration';
        return view('employer/auth/register', $get);
    }

    public function shortlisted()
    {
        if (!employer_vaidate()) {
            return redirect()->to(base_url('/employer/login'));
        } elseif (!employer_vaidate('check_profile')) {
            return redirect()->to(base_url('employer/setup/profile'));
        }
        $id = session('employer_id');
        $get['data'] = $this->EmployerModel->shortlisted($id);
        $get['title'] = 'Shortlisted Candidates';
        // pre($get);
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
            if (isset($experience[0]['ending_month'])) {
                $end_month = $experience[0]['ending_month'];
            }
            if (isset($experience[0]['ending_year'])) {
                $end_year = $experience[0]['ending_year'];
            }
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
                            <p>' . get_month($experience[0]["starting_month"]) . ' ' . $experience[0]["starting_year"] . ' - ' . $end_month . ' ' . $end_year . ' | ' . get_country_name($experience[0]["country"]) . '</p>
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
        $pkg = $this->EmployerModel->get_active_package(session('employer_id'));
        $pkg_id = $pkg['package_id'];
        if (empty($pkg['package_id'])) {
            $this->session->setFlashdata('error', 'Package is Expired');
            $this->EmployerModel->set_expired_time(session('employer_id'), $pkg_id);
            return redirect()->to(base_url('employer/packages'));
        }

        // Free Job post
        $total_free_jobs = $this->EmployerModel->count_posted_jobs($pkg_id, 0, $pkg['payment_id']);
        if ($total_free_jobs >= $pkg['no_of_posts']) {
            $this->EmployerModel->set_expired(session('employer_id'), $pkg_id);
            $this->session->setFlashdata('error', 'Post Limit Exceeded');
            return redirect()->to(base_url('employer/packages'));
        }

        //Featured Job Post
        $total_featured_jobs = $this->EmployerModel->count_posted_jobs($pkg_id, 1, $pkg['payment_id']);
        if ($total_featured_jobs >= $pkg['no_of_posts']) {
            $this->EmployerModel->set_expired(session('employer_id'), $pkg_id);
            $this->session->setFlashdata('error', 'Package Expired');
            return redirect()->to(base_url('employer/packages'));
        }

        $result = $this->EmployerModel->set_expired_time(session('employer_id'), $pkg_id);
        if ($result == 1) {
            $this->session->setFlashdata('error', 'Time Expired');
            return redirect()->to(base_url('employer/packages'));
        }

        if ($this->request->getMethod() == 'post') {
            $rules = [
                "job_title" => ["label" => "Job Title", "rules" => "trim|required"],
                "job_type" => ["label" => "Job Type", "rules" => "trim|required"],
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
                "state" => ["label" => "State", "rules" => "trim|required"],
                "city" => ["label" => "City", "rules" => "trim|required"],
                "location" => ["label" => "Location", "rules" => "trim|required"],
                "is_featured" => ["label" => "Featured", "rules" => "required"],
            ];
            if ($this->validate($rules) == false) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('employer/post'));
            }
            $skills = ucwords($this->request->getPost('skills'));
            $skill = str_replace(" ", ",", $skills);
            $data = array(
                'employer_id' => session('employer_id'),
                'company_id' => get_direct_value('companies', 'id', 'employer_id', session('employer_id')),
                'title' => ucwords($this->request->getPost('job_title')),
                'job_type' => $this->request->getPost('job_type'),
                'category' => $this->request->getPost('category'),
                'employment_type' => $this->request->getPost('employment_type'),
                'industry' => $this->request->getPost('industry'),
                'description' => ucfirst($this->request->getPost('description')),
                'salary_period' => $this->request->getPost('salary_period'),
                'min_salary' => $this->request->getPost('min_salary'),
                'max_salary' => $this->request->getPost('max_salary'),
                'education' => $this->request->getPost('education'),
                'experience' => $this->request->getPost('min_experience') . '-' . $this->request->getPost('max_experience'),
                'gender' => $this->request->getPost('gender'),
                'total_positions' => $this->request->getPost('total_positions'),
                'skills' => ucwords($skill),
                'country' => $this->request->getPost('country'),
                'state' => $this->request->getPost('state'),
                'city' => $this->request->getPost('city'),
                'location' => ucwords($this->request->getPost('location')),
                'is_featured' => $this->request->getPost('is_featured'),
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
        $get['title'] = 'Post Job';
        return view('employer/job/post', $get);
    }

    public function list_jobs()
    {
        if (!employer_vaidate()) {
            return redirect()->to(base_url('/employer/login'));
        } elseif (!employer_vaidate('check_profile')) {
            return redirect()->to(base_url('employer/setup/profile'));
        }
        $data['title'] = 'Job List';
        return view('employer/job/job_list', $data);
    }

    public function datatable_json()
    {
        $records = $this->EmployerModel->list_jobs();
        $data = array();

        $i = 1;
        foreach ($records['data'] as $row) {
            $buttoncontroll = '<a class="btnn btn-success" href=' . base_url("employer/edit_job/" . $row['id']) . ' title="View" >
                 <i class="fas fa-eye"></i></a>&nbsp;

                  <a class="edit btnn btn-primary" href=' . base_url("employer/edit_job/" . $row['id']) . ' title="Edit" >
                 <i class="fas fa-edit"></i></a>&nbsp;

                 <a class="btn-delete btnn btn-danger" href=' . base_url("employer/delete_job/" . $row['id']) . ' title="Delete" onclick="return confirm(\'Do you want to delete ?\')">
                 <i class="fas fa-trash"></i></a>';

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
        $get['title'] = 'Edit Job';
        return view('employer/job/edit_job', $get);
    }

    public function updatejob($id)
    {
        if ($this->request->getMethod() == 'put') {
            $rules = [
                "job_title" => ["label" => "Job Title", "rules" => "trim|required"],
                "job_type" => ["label" => "Job Type", "rules" => "trim|required"],
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
                "state" => ["label" => "State", "rules" => "trim|required"],
                "city" => ["label" => "City", "rules" => "trim|required"],
                "location" => ["label" => "Location", "rules" => "trim|required"],
                "is_featured" => ["label" => "Is Featured", "rules" => "required"],
                "is_status" => ["label" => "Status", "rules" => "required"],
            ];
            if ($this->validate($rules) == false) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('employer/edit_job/' . $id));
            }
            $skills = ucwords($this->request->getPost('skills'));
            $skill = str_replace(" ", ",", $skills);
            $data = array(
                'title' => ucwords($this->request->getPost('job_title')),
                'job_type' => $this->request->getPost('job_type'),
                'category' => $this->request->getPost('category'),
                'employment_type' => $this->request->getPost('employment_type'),
                'industry' => $this->request->getPost('industry'),
                'description' => ucfirst($this->request->getPost('description')),
                'salary_period' => $this->request->getPost('salary_period'),
                'min_salary' => $this->request->getPost('min_salary'),
                'max_salary' => $this->request->getPost('max_salary'),
                'education' => $this->request->getPost('education'),
                'experience' => $this->request->getPost('min_experience') . '-' . $this->request->getPost('max_experience'),
                'gender' => $this->request->getPost('gender'),
                'total_positions' => $this->request->getPost('total_positions'),
                'skills' => $skill,
                'country' => $this->request->getPost('country'),
                'state' => $this->request->getPost('state'),
                'city' => $this->request->getPost('city'),
                'location' => ucwords($this->request->getPost('location')),
                'is_featured' => $this->request->getPost('is_featured'),
                'is_status' => $this->request->getPost('is_status'),
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

    public function resend_verification_email()
    {
        if (!employer_vaidate()) {
            return redirect()->to(base_url('/employer/login'));
        } elseif (!employer_vaidate('check_profile')) {
            return redirect()->to(base_url('employer/setup/profile'));
        }
        $is_verify = get_direct_value('employers', 'is_verify', 'id', session('employer_id'));
        if ($is_verify == 1) {
            return redirect()->to(base_url('employer/dashboard'));
            exit;
        }
        $this->mailer->send_verification_email(session('employer_id'), 'employer');
        $this->session->setFlashdata('success', 'Email Verification Link Sent!');
        return redirect()->to(base_url('employer/dashboard'));
    }

    public function search()
    {
        if (!employer_vaidate()) {
            return redirect()->to(base_url('/employer/login'));
        } elseif (!employer_vaidate('check_profile')) {
            return redirect()->to(base_url('employer/setup/profile'));
        }
        $search = array();
        $get['profiles'] = array();
        $get['categories'] = $this->adminModel->get_all_categories();
        $get['cities'] = get_country_cities(101);
        $get['education'] = get_education_list();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                "job_title" => ["label" => "Job Title", "rules" => "trim|required"],
            ];
            if ($this->validate($rules) == false) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('employer/search'));
                exit;
            }

            if (!empty($this->request->getPost('job_title'))) {
                $search['job_title'] = $this->request->getPost('job_title');
            }

            if (!empty($this->request->getPost('category'))) {
                $search['category'] = $this->request->getPost('category');
            }

            if (!empty($this->request->getPost('state'))) {
                $search['state'] = $this->request->getPost('state');
            }

            if (!empty($this->request->getPost('city'))) {
                $search['city'] = $this->request->getPost('city');
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

        $get['title'] = 'Find Candidates';
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
        $data['title'] = 'Password Recovery';
        return view('employer/auth/password_reset', $data);
    }

    public function reset_password($reset_code)
    {
        $check_reset['data'] = $this->EmployerAuthModel->check_reset_code($reset_code);
        $check_reset['title'] = 'Password Recovery';
        return view('employer/auth/reset_password', $check_reset);
    }

    public function update_reset_password()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'id' => ['label' => 'id', 'rules' => 'required'],
                'password' => ['label' => 'Password', 'rules' => 'required'],
                'cpassword' => ['label' => 'Confirm Password', 'rules' => 'required|matches[password]'],
            ];
            if ($this->validate($rules) == false) {
                echo '0~' . arrayToList($this->validation->getErrors());
                exit;
            }
            $id = $this->request->getPost('id');
            $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $query = $this->EmployerAuthModel->update_reset_password($password, $id);
            if ($query != 0) {
                // Sending Email
                $name = $query['data']['firstname'] . ' ' . $query['data']['lastname'];
                $email = $query['data']['email'];
                $body = $this->mailer->pwd_reset_message($name);
                $mail_data['receiver_email'] = $email;
                $mail_data['mail_subject'] = 'Password Changed';
                $mail_data['mail_body'] = $body;

                sendEmail($mail_data);
                echo '1~Password changed successfully !';
                exit;
            } else {
                echo '0~Something went wrong, please try again !';
                exit;
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
        if (!employer_vaidate()) {
            exit;
        }
        if ($this->request->isAJAX()) {
            if (isset($_POST['razorpay_payment_id']) === false) {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                echo "0";
                exit;
            }
            $payment_amount = $this->EmployerModel->getPackageInfo($this->request->getPost("package_id"));
            $razorpay_key = get_g_setting_val('razorpay_key');
            $razorpay_secret = get_g_setting_val('razorpay_secret');
            $api = new Api($razorpay_key, $razorpay_secret);
            $razorpay_payment_id = $this->request->getPost("razorpay_payment_id");
            $payment = $api->payment->fetch($razorpay_payment_id);
            $capture_amount = $payment_amount['price'] * 100;
            if ($payment['status'] == 'authorized' || $payment['status'] == 'captured' || $payment['status'] == 'created') {
                $payment = $api->payment->fetch($razorpay_payment_id)->capture(array('amount' => $capture_amount));
                $data = [
                    'payment_method' => 'Razorpay',
                    'txn_id' => $razorpay_payment_id,
                    'user_id' => '0',
                    'employer_id' => session('employer_id'),
                    'payment_amount' => $payment_amount['price'],
                    'payer_email' => $this->request->getPost('payer_email'),
                    'payment_status' => 'succeeded',
                    'purchased_plan' => $this->request->getPost("package_id"),
                    'payment_date' => date('Y-m-d H:i:s'),
                ];
                $insert_id = $this->EmployerModel->payment($data);
                $this->session->set('payment_id', $insert_id);
                $this->razorpay_success();
            } else {
                $this->razorpay_cancel();
            }
        }
    }

    public function razorpay_success()
    {
        if (session('payment_id')) {
            $date = date("y-m-d G.i:s");
            $package_info = $this->EmployerModel->getPackageInfo($this->request->getPost("package_id"));
            $package_days = $package_info['no_of_days'];
            $exp_date = date('y-m-d G.i:s', strtotime(' + ' . $package_days . ' days'));
            $package_info = [
                'payment_id' => session('payment_id'),
                'employer_id' => session('employer_id'),
                'user_id' => 0,
                'package_id' => $this->request->getPost('package_id'),
                'is_renewal' => 0,
                'is_upgrade' => 0,
                'buy_date' => $date,
                'expire_date' => $exp_date,
                'is_active' => 1,
            ];
            $pay_query = $this->EmployerModel->packages_bought($package_info);
            session()->remove('payment_id');
            if ($pay_query->resultID == 1) {
                $this->session->setFlashdata('success', 'Package Successfully Purchased');
                echo "1";
                exit;
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                echo "0";
                exit;
            }
        }
    }

    public function razorpay_cancel()
    {
        $payment_id = session('payment_id');
        session()->remove('payment_id');
        $builder = $this->db->table('payments');
        $builder->where('id', $payment_id);
        $builder->delete();
        $this->session->setFlashdata('error', 'Something went wrong, please try again');
        echo "0";
        exit;
    }

    public function verify($token)
    {
        $result = $this->EmployerAuthModel->email_verification($token);
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
            $this->session->setFlashdata('error', 'Something Went Wrong Try Again!');
            return redirect()->to(base_url('home'));
        }
    }

    public function setup_profile()
    {
        $id = session('employer_id');
        $get['categories'] = $this->adminModel->get_all_categories();
        $get['countries'] = $this->adminModel->get_countries_list();
        $get['data'] = $this->EmployerAuthModel->personal_info($id);
        $get['title'] = 'Personal Information';

        if ($this->request->getMethod() == 'post') {
            if ($_FILES['profile_picture']['name'] != '') {
                $result = UploadFile($_FILES['profile_picture']);
                if ($result['status'] == true) {
                    $url = $result['result']['file_url'];
                } else {
                    $this->session->setFlashdata('error', $result['message']);
                    return redirect()->to(base_url('employer/setup/profile'));
                }
            }
            $rules = [
                'firstname' => ['label' => 'First Name', 'rules' => 'required'],
                'lastname' => ['label' => 'Last Name', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
                'designation' => ['label' => 'Designation', 'rules' => 'required'],
                'mobile_no' => ['label' => 'Mobile No.', 'rules' => 'required'],
                'country' => ['label' => 'Country', 'rules' => 'required'],
                'state' => ['label' => 'State', 'rules' => 'required'],
                'city' => ['label' => 'City', 'rules' => 'required'],
                'address' => ['label' => 'Address', 'rules' => 'required'],
            ];
            if ($get['data'][0]['profile_picture'] == '') {
                $rules['profile_picture'] = ['uploaded[profile_picture]', 'max_size[profile_picture,1024]|required'];
            }

            if ($this->validate($rules) == false) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('employer/setup/profile'));
            }
            $update_per_info = array(
                'firstname' => ucwords($this->request->getPost('firstname')),
                'lastname' => ucwords($this->request->getPost('lastname')),
                'email' => $this->request->getPost('email'),
                'designation' => ucwords($this->request->getPost('designation')),
                'mobile_no' => $this->request->getPost('mobile_no'),
                'country' => $this->request->getPost('country'),
                'state' => $this->request->getPost('state'),
                'city' => $this->request->getPost('city'),
                'address' => ucwords($this->request->getPost('address')),
                'profile_completed' => 1,
            );

            if ($_FILES['profile_picture']['name'] != '') {
                $update_per_info['profile_picture'] = $url;
            }
            $id = session('employer_id');
            $update_per = $this->EmployerAuthModel->personal_info_update($update_per_info, $id);
            if ($update_per == 1) {
                $this->session->set('profile_completed', 1);
                $this->session->setFlashdata('success', 'Personal Information successfully Updated');
                return redirect()->to(base_url('employer/setup/company'));
            } else {
                $this->session->setFlashdata('error', 'Something went wrong, please try again');
                return redirect()->to(base_url('employer/setup/profile'));
            }
        }
        return view('employer/auth/setup_profile', $get);
    }

    public function setup_company()
    {
        $id = get_companies_empid(session('employer_id'));
        $get['categories'] = $this->adminModel->get_all_categories();
        $get['countries'] = $this->adminModel->get_countries_list();
        $get['data'] = $this->EmployerAuthModel->cmp_info($id);
        $get['title'] = 'Company Information';

        if ($this->request->getMethod() == 'post') {
            if ($_FILES['company_logo']['name'] != '') {
                $result = UploadFile($_FILES['company_logo']);
                if ($result['status'] == true) {
                    $url = $result['result']['file_url'];
                } else {
                    $this->session->setFlashdata('error', $result['message']);
                    return redirect()->to(base_url('employer/setup/company'));
                }
            }
            $rules = [
                'company_name' => ['label' => 'Company Name', 'rules' => 'required'],
                'email' => ['label' => 'Company Email', 'rules' => 'required'],
                'website' => ['label' => 'Company Website', 'rules' => 'required'],
                'category' => ['label' => 'Category', 'rules' => 'required'],
                'founded_date' => ['label' => 'Founded Date', 'rules' => 'required'],
                'org_type' => ['label' => 'Organization Type', 'rules' => 'required'],
                'no_of_employers' => ['label' => 'No. of Employers', 'rules' => 'required'],
                'description' => ['label' => 'Comapany Description', 'rules' => 'required'],
            ];
            if ($get['data'][0]['company_logo'] == '') {
                $rules['company_logo'] = ['uploaded[company_logo]', 'max_size[company_logo,1024]|required'];
            }
            if ($this->validate($rules) == false) {
                $this->session->setFlashdata('error', arrayToList($this->validation->getErrors()));
                return redirect()->to(base_url('employer/setup/company'));
            }

            $cmp_info_update = array(
                'company_name' => ucwords($this->request->getPost('company_name')),
                'email' => $this->request->getPost('email'),
                'website' => $this->request->getPost('website'),
                'category' => $this->request->getPost('category'),
                'founded_date' => $this->request->getPost('founded_date'),
                'org_type' => $this->request->getPost('org_type'),
                'no_of_employers' => $this->request->getPost('no_of_employers'),
                'description' => ucfirst($this->request->getPost('description')),
            );

            if ($_FILES['company_logo']['name'] != '') {
                $cmp_info_update['company_logo'] = $url;
            }
            $id = get_companies_empid(session('employer_id'));
            $update_per = $this->EmployerAuthModel->cmp_info_update($cmp_info_update, $id);
            if ($update_per == 1) {
                $this->EmployerAuthModel->cmpy_cmpld($id);
                $this->session->set('company_completed', 1);
                $this->session->setFlashdata('success', 'Company Information Successfully Updated');
                return redirect()->to(base_url('employer/dashboard'));
            } else {
                $this->session->setFlashdata('error', 'Something Went Wrong, Please Try Again!');
                return redirect()->to(base_url('employer/setup/company'));
            }
        }
        if ($this->request->isAJAX()) {
            $country_id = $this->request->getPost('country_id');
            $states = $this->adminModel->get_states_list($country_id);
            return json_encode($states);
            exit();
        }
        return view('employer/auth/setup_company', $get);
    }

    public function aboutus()
    {
        $data['title'] = 'About Us';
        return view('employer/aboutus', $data);
    }
}
