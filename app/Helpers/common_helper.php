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
