<?php
namespace App\Controllers;
use App\Models\EmployerModel;

class Employer extends BaseController
{
   public function __construct()
   {
       $this->EmployerModel = new EmployerModel();
   }
    public function index()
    {
        return view('employer/dashboard');
    }

    public function personal_info(){
        return view('employer/profile/profile_page');
    }
}