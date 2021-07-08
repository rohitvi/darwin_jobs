<?php

namespace App\Libraries;

class Mailer
{
    protected $db;
    public function __construct()
    {
        $this->db = db_connect();
    }

    //=============================================================
    // Eamil Templates
    function mail_template($to = '', $slug = '', $mail_data = '')
    {
        $builder = $this->db->table('email_templates');
        $template = $builder->getWhere(array('slug' => $slug))->getRowArray();

        $body = $template['body'];

        $template_id = $template['id'];

        $data['head'] = $subject = $template['subject'];

        $data['content'] = $this->mail_template_variables($body, $slug, $mail_data);

        $data['title'] = $template['name'];

        $Mail['mail_body']        =  view('admin/general_settings/email_preview', $data);
        $Mail['receiver_email']   = $to;
        $Mail['mail_subject']     = $subject;

        sendEmail($Mail);

        return true;
    }

    //=============================================================
    // GET Eamil Templates AND REPLACE VARIABLES
    function mail_template_variables($content, $slug, $data = '')
    {
        switch ($slug) {
            case 'login-alert':
                $content = str_replace('{FULLNAME}', session('username'), $content);
                $content = str_replace('{TIMESTAMP}', date('F j, Y H:i:s'), $content);
                return $content;
                break;

            case 'email-verification':
                $content = str_replace('{TIMESTAMP}', date('F j, Y H:i:s'), $content);
                $content = str_replace('{VERIFICATION_LINK}', 'LINK HERE', $content);
                return $content;
                break;

            case 'welcome':
                $content = str_replace('{FULLNAME}', $data['fullname'], $content);
                return $content;
                break;

            case 'forget-password':
                $content = str_replace('{NAME}', $data['fullname'], $content);
                $content = str_replace('{RESET_LINK}', $data['reset_link'], $content);
                return $content;
                break;

            case 'applicant-applied':
                $content = str_replace('{JOB_TITLE}', $data['job_title'], $content);
                return $content;
                break;

            case 'job-applied':
                $content = str_replace('{JOB_TITLE}', $data['job_title'], $content);
                return $content;
                break;

            case 'general-notification':
                $content = str_replace('{CONTENT}', $data['content'], $content);
                return $content;
                break;

            case 'candidate-shortlisted':
                $content = str_replace('{JOB_TITLE}', $data['job_title'], $content);
                return $content;
                break;

            default:
                # code...
                break;
        }
    }

    //=============================================================
    // VERIFICATION EMAIL
    // type - EMPLOYER / USER , ID - USER ID / EMPLOYER ID

    function send_verification_email($id, $type = '')
    {
        if ($type == 'employer') {
            $builder = $this->db->table('employers');
        }

        if ($type == 'user' || $type == '') {
            $builder = $this->db->table('users');
        }
        $user = $builder->getWhere(array('id' => $id))->getRowArray();
        $token = $user['token'];

        if ($type == 'employer')
            $varification_link = base_url('employer/verify/' . $token);

        if ($type == 'user' || $type == '')
            $varification_link = base_url('home/verify/' . $token);

        // Get Email Template
        $builder = $this->db->table('email_templates');
        $temp = $builder->getWhere(array('slug' => 'email-verification'))->getRowArray();

        $to = $user['email'];

        $data['content'] = str_replace('{VERIFICATION_LINK}', $varification_link, $temp['body']);

        $data['head'] = $temp['subject'];

        $data['title'] = $temp['name'];

        $Mail['mail_body']        =  view('admin/general_settings/email_preview', $data);
        $Mail['receiver_email']   = $to;
        $Mail['mail_subject']     = $temp['subject'];

        sendEmail($Mail);

        return true;
    }

    //=============================================================
    // NEWSLETTER
    function send_newsletter($to, $subject, $body)
    {
        $data['content'] = $body;

        $data['head'] = $data['title'] = $subject;

        // $data['title'] = '';

        $Mail['mail_body']        =  view('admin/general_settings/email_preview', $data);
        $Mail['receiver_email']   = $to;
        $Mail['mail_subject']     = $subject;

        sendEmail($Mail);

        return true;
    }

    //=============================================================
    function registration_email($username, $email_verification_link)
    {
        $login_link = base_url('auth/login');

        $tpl = '<h3>Hi ' . strtoupper($username) . '</h3>
            <p>Welcome to ' . get_g_setting_val('application_name') . '!</p>
            <p>Your Account Has been Created Successfully. :</p>  
			<p>Active your account with the link above and start your Career :</p>
            <p>' . $email_verification_link . '</p>
            
            <br>
            <br>

            <p>Regards, <br> 
               ' . get_g_setting_val('application_name') . ' Team <br> 
            </p>
    ';
        return $tpl;
    }

    //=============================================================
    function pwd_reset_link($username, $reset_link)
    {
        $tpl = '<h3>Hi ' . strtoupper($username) . '</h3>
            <p>Welcome to ' . get_g_setting_val('application_name') . '!</p>
            <p>We have received a request to reset your password. If you did not initiate this request, you can simply ignore this message and no action will be taken.</p> 
            <p>To reset your password, please click the link below:</p>
            <p>' . $reset_link . '</p>

            <br>
            <br>

            <p>© ' . date('Y') . ' ' . get_g_setting_val('application_name') . ' - All rights reserved</p>
    ';
        return $tpl;
    }
}
