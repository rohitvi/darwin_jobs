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
    for ($i= 1; $i < 21 ; $i++) { 
        $experience[$i] = $i.' Years';
    }
    return $experience;
}
