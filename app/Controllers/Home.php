<?php
namespace App\Controllers;
use App\Models\HomeModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->hm = new HomeModel();
    }

//*******************************************Admin Functions***************************************************

    public function index()
    {
        
    }
}