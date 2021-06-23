<?php
namespace App\Controllers;
use App\Models\HomeModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->HomeModel = new HomeModel();
    }

    public function index()
    {
        return view('user/index');
    }

    public function login()
    {
        return view('user/auth/login');
    }

    //Get States
    function get_country_states()
    {
        $builder = $this->db->table('states');
        $states = $builder->where('country_id',$this->request->getPost('country'))->get()->getResultArray();
        $options = array('' => 'Select State') + array_column($states,'name','id');
        $html = form_dropdown('state',$options,'','class="form-control select2" required');
        $error =  array('msg' => $html);
        echo json_encode($error);
    }

    //Get Cities
    function get_state_cities()
    {
        $builder = $this->db->table('cities');
        $cities = $builder->where('state_id',$this->request->getPost('state'))->get()->getResultArray();

        $options = array('' => 'Select City') + array_column($cities,'name','id');
        $html = form_dropdown('city',$options,'','class="form-control select2" required');
        $error =  array('msg' => $html);
        echo json_encode($error);
    }

}