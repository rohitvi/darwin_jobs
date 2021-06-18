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
    return $builder->select('*')->where('country_id',$country_id)->get()->getResultArray();
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
