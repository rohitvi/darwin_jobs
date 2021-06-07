<?php

function pre()
{
    echo (php_sapi_name() !== 'cli') ? '<pre>' : '';
    foreach(func_get_args() as $arg){
        echo preg_replace('#\n{2,}#', "\n", print_r($arg, true));
    }
    echo (php_sapi_name() !== 'cli') ? '</pre>' : '';exit();
}

function get_direct_value($table,$columnRequired,$columnNameToCompare,$columnValueToCompare){
    $db      = \Config\Database::connect();
    $builder = $db->table($table);
    $value   = $builder->select($columnRequired)->getWhere(array($columnNameToCompare=>$columnValueToCompare))->getResultArray();
    if($value){
        return $value[0][$columnRequired];
    }
    else
        return 0;
}

function app_name(){
    return get_direct_value('general_settings','value','name','app_name');
}

function RandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function authenticate($para='admin_logged_in')
{
    if($para == 'admin_logged_in')
    {
        if(empty(session('admin_logged_in')))
            return FALSE;
        else
            return TRUE;
    }
    if($para == 'admin_id')
    {
        if(empty(session('admin_logged_in')))
            return FALSE;
        else
            return session('admin_id');
    }
}


function isAuthorized($action)
{
    if(session('admin_logged_in'))
    {
        $role_id = get_direct_value('admin','role','id',session('admin_id'));
        $perms = unserialize(get_direct_value('admins_role_perms','permission','id',$role_id));
        if(!in_array($action,$perms)){session()->setFlashdata('denied','Access Denied.'); return 0;}
        else{return 1;}
    }else
        return 0;
}

function Permission($action)
{
    if(session('admin_logged_in'))
    {
        $role_id = get_direct_value('admin','role','id',session('admin_id'));
        $perms = unserialize(get_direct_value('admins_role_perms','permission','id',$role_id));
        if(!in_array($action,$perms)){ return 0;}
        else{return 1;}
    }else
        return 0;
}

function countRow($table,$where){
    $db      = \Config\Database::connect();
    $builder = $db->table($table);
    $builder->selectCount('id');
    $builder->where($where);
    $value = $builder->get()->getResultArray();

    if($value){
        return $value[0]['id'];
    }
    else
        return 0;
}

function SumColumn($table,$where,$column){
    $db      = \Config\Database::connect();
    $builder = $db->table($table);
    $builder->selectSum($column);
    $builder->where($where);
    $value = $builder->get()->getResultArray();
    if($value[0][$column] !== ''){
        return $value[0][$column];
    }
    else
        return 0;
}

function BgColor(){
    $color = ['bg-red','bg-pink','bg-purple','bg-deep-purple','bg-indigo','bg-blue','bg-light-blue','bg-blue','bg-teal','bg-green','bg-light-green','bg-lime','bg-yellow','bg-amber','bg-orange','bg-deep-orange','bg-brown','bg-grey','bg-blue-grey'];
    shuffle($color);
    return $color[0];
}

function generateKey($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}