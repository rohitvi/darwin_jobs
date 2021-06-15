<?php
namespace App\Controllers;
use App\Models\AdminModel;

class Jobs extends BaseController
{
    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    function post()
    {
        $admin_id  = session('admin_id');
        $data['categories'] = $this->adminModel->get_all_categories(); 
        $data['industries'] = $this->adminModel->get_all_industry();
        $data['countries']  = $this->adminModel->get_countries_list();
        $data['salaries']   = $this->adminModel->get_salary_list();  
        $data['educations'] = $this->adminModel->get_education_list();
        $data['companies']  = $this->adminModel->getemployer();
        if ($this->request->getMethod() == 'post'){

            $rules = [
                "package_name"          => ["label" => "Package Name", "rules" => "required"],
                "package_keywords"      => ["label" => "Package Keywords", "rules" => "required"],
                'file'  => [
                    'uploaded[file]',
                    'max_size[file,'.$max_size.']',
                    'mime_in[file,'.$mime_in.']',
                    'ext_in[file,'.$ext_in.']',
                ],
            ];
            if($this->validate($rules) == FALSE) {
                echo '0~'.$this->validation->listErrors();exit;
            }

/*
            $this->form_validation->set_rules('employer_id','company','trim|required');
            $this->form_validation->set_rules('job_title','job title','trim|required|min_length[3]');
            $this->form_validation->set_rules('job_type','job type','trim|required');
            $this->form_validation->set_rules('category','category','trim|required');
            $this->form_validation->set_rules('industry','industry','trim|required');
            $this->form_validation->set_rules('min_experience','min experience','trim|required');
            $this->form_validation->set_rules('max_experience','max experience','trim|required');
            $this->form_validation->set_rules('salary_period','salary period','trim|required');
            $this->form_validation->set_rules('min_salary','min salary','trim|required');
            $this->form_validation->set_rules('max_salary','max salary','trim|required');
            $this->form_validation->set_rules('skills','skills','trim|required');
            $this->form_validation->set_rules('description','description','trim|required|min_length[3]');
            $this->form_validation->set_rules('total_positions','total positions','trim|required');
            $this->form_validation->set_rules('gender','gender','trim|required');
            $this->form_validation->set_rules('employment_type','employment type','trim|required');
            $this->form_validation->set_rules('education','education','trim|required');
            $this->form_validation->set_rules('country','country','trim|required');
            $this->form_validation->set_rules('city','city','trim|required');
            $this->form_validation->set_rules('location','location','trim|required');

            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    'errors' => validation_errors(),
                );

                $this->session->set_flashdata('error',$data['errors']);
                redirect(base_url('admin/job/post'),'refresh');

            }else{
                $data = array(
                    'admin_id' => $admin_id,
                    'employer_id' => $this->input->post('employer_id'),
                    'title' => $this->input->post('job_title'),
                    'job_type' => $this->input->post('job_type'),
                    'category' => $this->input->post('category'),
                    'industry' => $this->input->post('industry'),
                    'experience' => $this->input->post('min_experience').'-'.$this->input->post('max_experience'),
                    'min_salary' => $this->input->post('min_salary'),
                    'max_salary' => $this->input->post('max_salary'),
                    'salary_period' => $this->input->post('salary_period'),
                    'description' => $this->input->post('description'),
                    'skills' => $this->input->post('skills'),
                    'total_positions' => $this->input->post('total_positions'),
                    'gender' => $this->input->post('gender'),
                    'education' => $this->input->post('education'),
                    'employment_type' => $this->input->post('employment_type'),
                    'country' => $this->input->post('country'),
                    'state' => $this->input->post('state'),
                    'city' => $this->input->post('city'),
                    'location' => $this->input->post('location'),
                    'created_date' => date('Y-m-d : h:m:s'),
                    'updated_date' => date('Y-m-d : h:m:s')
                );
                $data['job_slug'] = $this->make_job_slug($this->input->post('job_title'), $this->input->post('city'));

                $data = $this->security->xss_clean($data);
                $result = $this->job_model->add_job($data);

                if ($result){
                    $this->session->set_flashdata('success','Congratulation! Job has been Posted successfully');
                    redirect(base_url('admin/job'));
                }
                else{
                    echo "failed";
                }
            }*/
        }
        else{
            $data['title'] = 'Post Job';
            return view('admin/job/job_add', $data);
        }
    }
}