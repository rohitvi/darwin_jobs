<?php
// Get employment type
function get_employment_type_list()
{
    $db      = \Config\Database::connect();
    $builder = $db->table('employment');
    return $builder->get()->getResultArray();
}

function get_job_type_list()
{
    $db      = \Config\Database::connect();
    $builder = $db->table('job_type');
    return $builder->get()->getResultArray();
}

function get_experience_list($type)
{
    $experience = [];
    $experience[''] = $type;
    for ($i = 1; $i < 21; $i++) {
        $experience[$i] = $i . ' Years';
    }
    return $experience;
}


// Get city name by ID
function get_city_name($id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('cities');
    return $builder->getWhere(array('id' => $id))->getRowArray()['name'];
}

// Get city ID by title
function get_city_slug($id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('cities');
    return $builder->getWhere(array('id' => $id))->getRowArray()['slug'];
}

// Get state's cities
function get_state_cities($state_id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('cities');
    return $builder->getWhere(array('state_id' => $state_id))->getResultArray();
}

// Get state name by ID
function get_state_name($id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('states');
    return $builder->getWhere(array('id' => $id))->getRowArray()['name'];
}

// Get Nationality by ID

function get_education_level($id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('education');
    return $builder->getWhere(array('id' => $id))->getRowArray()['type'];
}

// -----------------------------------------------------------------------------
// Get industry name by id
function get_industry_name($id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('industries');
    return $builder->getWhere(array('id' => $id))->getRowArray()['name'];
}

// -----------------------------------------------------------------------------
// Get country name by ID
function get_country_name($id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('countries');
    return $builder->getWhere(array('id' => $id))->getRowArray()['name'];
}

// Get category name by id
function get_category_name($id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('categories');
    return $builder->getWhere(array('id' => $id))->getRowArray()['name'];
}

// Get country's states
function get_country_states($country_id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('states');
    return $builder->select('*')->where('country_id', $country_id)->get()->getResultArray();
}

function arrayToList(array $array): string
{
    $html = '';
    if (count($array)) {
        $html .= '<ul>';
        foreach ($array as $value) {
            $html .= '<li>' . $value . '</li>';
        }
        $html .= '</ul>';
    }
    return $html;
}

// Get Education Type

function get_education($id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('education');
    return $builder->getWhere(array('id' => $id))->getRowArray()['type'];
}

// Get Month by ID

function get_month($id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('months');
    return $builder->getWhere(array('id' => $id))->getRowArray()['name'];
}

// Get Category list

function get_category_list()
{
    $db      = \Config\Database::connect();
    $builder = $db->table('categories');
    return $builder->get()->getResultArray();
}

// Get Education list
function get_education_list()
{
    $db      = \Config\Database::connect();
    $builder = $db->table('education');
    return $builder->get()->getResultArray();
}

// Get Industry list

function get_industry_list()
{
    $db      = \Config\Database::connect();
    $builder = $db->table('industries');
    return $builder->get()->getResultArray();
}
// Get job detail
function get_job_detail($id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('job_post');
    return $builder->select('title,job_slug')->where('id', $id)->get()->getRowArray();
}

function sendEmail($mail_data)
{
    $email_config = array(
        'charset' => 'utf-8',
        'mailType' => 'html',
    );
    $email = \Config\Services::email();
    $email->initialize($email_config);
    $email->setNewline("\r\n");
    $email->setCRLF("\r\n");

    $sender_email       = get_g_setting_val('system_email');
    $sender_name        = get_g_setting_val('application_name');

    $receiver_email     = $mail_data['receiver_email'];
    $receiver_cc_email  = isset($mail_data['receiver_cc_email']) ? $mail_data['receiver_cc_email'] : array();
    $receiver_bcc_email = isset($mail_data['receiver_bcc_email']) ? $mail_data['receiver_bcc_email'] : array();
    $mail_subject       = $mail_data['mail_subject'];
    $mail_body          = $mail_data['mail_body'];
    $attachments        = isset($mail_data['attachment']) ? $mail_data['attachment'] : array();

    $email->setFrom($sender_email, $sender_name);
    $email->setTo($receiver_email);

    if (count($receiver_cc_email) > 0) {
        $email->setCC($receiver_cc_email);
    }
    if (count($receiver_bcc_email) > 0) {
        $email->setBCC($receiver_bcc_email);
    }

    if (!empty($attachments) && is_array($attachments)) {
        foreach ($attachments as $key => $value) {
            $email->attach($value);
        }
    }

    $email->setSubject($mail_subject);
    $email->setMessage($mail_body);

    if ($email->send()) {
        return 1;
    } else {
        // return 0;
        return 1;
        // pre($email->printDebugger(['headers']));
    }
}

function add_30_days($days)
{
    return date('Y-m-d', strtotime(' + ' . $days . ' days'));
}
// get_user_skills
function get_user_skills($user_id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('users');
    return $builder->getWhere(array('id' => $user_id))->getRowArray()['skills'];
}
// Get Company Name
function get_company_name($company_id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('companies');
    return $builder->getWhere(array('id' => $company_id))->getRowArray()['company_name'];
}
// Get Company Logo by id
function get_company_logo($company_id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('companies');
    return $builder->getWhere(array('id' => $company_id))->getRowArray()['company_logo'];
}

function get_months_list()
{
    return array(
        '' => 'Month',
        '1' => 'Jan',
        '2' => 'Feb',
        '3' => 'Mar',
        '4' => 'Apr',
        '5' => 'May',
        '6' => 'Jun',
        '7' => 'Jul',
        '8' => 'Aug',
        '9' => 'Sep',
        '10' => 'Oct',
        '11' => 'Nov',
        '12' => 'Dec',
    );
}

function get_years_list()
{
    $years = [];
    $years[''] = 'Year';
    for ($i = 0; $i < 50; $i++) {
        $year = date('Y', strtotime('- ' . $i . ' years'));
        $years[$year] = $year;
    }
    return $years;
}

function get_nth_month($nth)
{
    return date('M', strtotime($nth . ' month'));
}
// Get Employer By ID
function get_employer_by_id($employer_id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('employers');
    return $builder->getWhere(array('id' => $employer_id))->getRowArray();
}
// Get User Email
function get_user_email($user_id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('users');
    return $builder->getWhere(array('id' => $user_id))->getRowArray()['email'];
}


// get languages
function get_languages_list()
{
    $db = \Config\Database::connect();
    $builder = $db->table('languages');
    return $builder->get()->getResultArray();
}

function get_language_levels()
{
    return array(
        '' => 'Select Option',
        '1' => 'Beginner',
        '2' => 'Intermediate',
        '3' => 'Expert',
    );
}

function get_language_name($id)
{
    $db = \Config\Database::connect();
    $builder = $db->table('languages');
    return $builder->getWhere(array('lang_id' => $id))->getRowArray()['lang_name'];
}

function get_lang_proficiency_name($id)
{
    if ($id == '1')
        return 'Beginner';
    if ($id == '2')
        return 'Intermediate';
    if ($id == '3')
        return 'Expert';
}
function get_job_type_name($id)
{
    $db = \Config\Database::connect();
    $builder = $db->table('job_type');
    return $builder->getWhere(array('id' => $id))->getRowArray()['type'];
}
function getNumsJobThruCategory($cate_id)
{
    $db = \Config\Database::connect();
    $builder = $db->table('job_type');
    $builder->selectSum('category');
    return $builder->where(array('category' => $cate_id))->get()->getResultArray();
}

// get user profile by ID
function get_user_profile($id)
{
    $db = \Config\Database::connect();
    $builder = $db->table('users');
    return $builder->select('profile_picture')->getWhere(array('id' => $id))->getRowArray()['profile_picture'];
}

// -----------------------------------------------------------------------------
// get user profile by ID
function get_employer_profile($id)
{
    $db = \Config\Database::connect();
    $builder = $db->table('employers');
    return $builder->select('profile_picture')->getWhere(array('id' => $id))->getRowArray()['profile_picture'];
}

// Get category by ID
function get_category_slug($id)
{
    $db = \Config\Database::connect();
    $builder = $db->table('categories');
    return $builder->select('slug')->getWhere(array('id' => $id))->getRowArray()['slug'];
}

function user_vaidate($para='user_logged_in')
{
    if($para == 'user_logged_in')
    {
        if(empty(session('user_logged_in')))
            return FALSE;
        else
            return TRUE;
    }
    if($para == 'user_id')
    {
        if(empty(session('user_logged_in')))
            return FALSE;
        else
            return session('user_id');
    }
}

function employer_vaidate($para='employer_logged_in')
{
    if($para == 'employer_logged_in')
    {
        if(empty(session('employer_logged_in')))
            return FALSE;
        else
            return TRUE;
    }
    if($para == 'employer_id')
    {
        if(empty(session('employer_logged_in')))
            return FALSE;
        else
            return session('employer_id');
    }
}

function admin_vaidate($para='admin_logged_in')
{
    if($para == 'admin_logged_in')
    {
        if(empty(session('admin_logged_in')))
            return FALSE;
        else
            return TRUE;
    }
    if($para == 'admin_logged_in')
    {
        if(empty(session('admin_logged_in')))
            return FALSE;
        else
            return session('admin_logged_in');
    }
}