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

function get_g_setting_val($column){
    $db      = \Config\Database::connect();
    $builder = $db->table('general_settings');
    return $builder->getWhere(array('id'=>1))->getRowArray()[$column];
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
    if($para == 'admin_username')
    {
        if(empty(session('admin_logged_in')))
            return FALSE;
        else
            return session('admin_username');
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

function UploadFile($FILE){
    $url        = get_g_setting_val('dcloud_api');
    $X_Key      = get_g_setting_val('x-key');
    $X_Secret   = get_g_setting_val('x-secret');
    $ch = curl_init();
    $RealTitle = $FILE['name'];

    $postfields['file'] = new CurlFile($FILE['tmp_name'], $FILE['type'], $RealTitle);
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $postfields,
        CURLOPT_HTTPHEADER => array(
            'X-Key: ' . $X_Key,
            'X-Secret: ' . $X_Secret
        ),
    ));

    $response = curl_exec($ch);
    if (!curl_errno($ch)) {
        curl_close($ch);
        return json_decode($response, true);
    } else {
        curl_close($ch);
        $errmsg = curl_error($ch);
        return $errmsg;
    }
}

function DeleteDcloudFile($FILES)
{
    $url        = get_g_setting_val('dcloud_api');
    $X_Key      = get_g_setting_val('x-key');
    $X_Secret   = get_g_setting_val('x-secret');
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_POSTFIELDS => json_encode($FILES),
        CURLOPT_HTTPHEADER => array(
            'X-Key: ' . $X_Key,
            'X-Secret: ' . $X_Secret
        ),
    ));

    $response = curl_exec($ch);
    if (!curl_errno($ch)) {
        curl_close($ch);
        return json_decode($response, true);
    } else {
        curl_close($ch);
        // $errmsg = curl_error($ch);
        // return $errmsg;
        return array('status'=>false,'message'=>'Failed To upload');
    }
}

function general_value($column){
    $db      = \Config\Database::connect();
    $builder = $db->table('general_settings');
    $value   = $builder->select($column)->get()->getResultArray();
    if($value){
        return $value[0][$column];
    }
    else
        return 0;
}

// Pagination Association function
function pagination_assoc($varkey, $assoc_n)
{
    $ci =& get_instance();
    
    $qs_arr = $ci->uri->uri_to_assoc($assoc_n);
    $qs_tmp_arr = array();

    foreach ($qs_arr as $key => $value) {
        if ($key != $varkey) {
            $qs_tmp_arr[$key] = $value;
            $assoc_n = 0;
        }
    }

    foreach ($ci->uri->segment_array() as $key => $value) {
        if ($value == 'p') {
            $assoc_n = $key;
        }
    }

    $offset = (isset($qs_arr [$varkey]))? $qs_arr[$varkey]: 0;

    $qs_uri = $ci->uri->assoc_to_uri($qs_tmp_arr). '/'. $varkey;

    $arr = array(
        'offset' => $offset,
        'seg' => $assoc_n + 1,
        'uri' => $qs_uri
    );

    return $arr;

}

// -----------------------------------------------------------------------------
function clean_url($string)
 {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $string); // Removes special chars.
    $string = preg_replace('/-+/', '-', $string); //
    return $result = strtolower($string);
 
 }    

 //----------------------------------------------------------------------------
function year_dropdown($field_name, $earliest_year, $selected_value){
        
    $already_selected_value = $selected_value;
    $earliest_year = $earliest_year;

    print '<select class="form-control" name="'.$field_name.'">';
    foreach (range(date('Y'), $earliest_year) as $x) {
        print '<option value="'.$x.'"'.($x == $already_selected_value ? ' selected="selected"' : '').'>'.$x.'</option>';
    }
    print '</select>';
 }

// -----------------------------------------------------------------------------
function time_ago($date) {
    if(empty($date)) {
        return trans('no_date');
    }
    $periods = array(trans('second'),trans('minute'), trans('hour'), trans('day'), trans('week'), trans('month'), trans('year'), trans('decade'));
    $lengths = array("60","60","24","7","4.35","12","10");
    $now = time();
    $unix_date = strtotime($date);
    // check validity of date
    if(empty($unix_date)) {
        return "";
    }
    // is it future date or past date
    if($now > $unix_date) {
        $difference = $now - $unix_date;
        $tense = trans('ago');
    } else {
        $difference = $unix_date - $now;
        $tense = trans('from_now');
    }
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
    $difference = round($difference);
    if($difference != 1) {
        $periods[$j].= "s";
    }

    return "$difference $periods[$j] {$tense}";
}

// --------------------------------------------------------------------------------
function date_time($datetime) 
{
   return date('F j, Y',strtotime($datetime));
}

// --------------------------------------------------------------------------------
function add_days_to_date($days) 
{
   return date('Y-m-d', strtotime(' + '.$days.' days'));
}


// --------------------------------------------------------------------------------
// limit the no of characters
function text_limit($x, $length)
{
  if(strlen($x)<=$length)
  {
    return $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    return $y;
  }
}

// -----------------------------------------------------------------------------
// Make Slug Function    
if (!function_exists('make_slug'))
{
    function make_slug($string)
    {
        $lower_case_string = strtolower($string);
        $string1 = preg_replace('/[^a-zA-Z0-9 ]/s', '', $lower_case_string);
        return strtolower(preg_replace('/\s+/', '-', $string1));        
    }
}

//-----------------------------------------------------------------------------
function encode($input) 
{
    return urlencode(base64_encode($input));
}

//-----------------------------------------------------------------------------
function decode($input) 
{
    return base64_decode(urldecode($input) );
}