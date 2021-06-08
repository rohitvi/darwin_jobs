<?php
namespace App\Controllers;
use App\Models\AdminModel;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->am = new AdminModel();
    }


    public function index()
    {
        return view('admin/dashboard');
    }
}