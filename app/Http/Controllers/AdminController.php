<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function createProduct()
    {
        return view('admin.addproduct');
    }

    public function dashboardAdmin()
    {
        return view('admin.dashboard');
    }
}
