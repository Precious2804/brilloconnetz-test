<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MainController extends BaseController
{
    public function dashboard()
    {
        return view('dashboard');
    }
    public function settings()
    {
        return view('settings');
    }
}
