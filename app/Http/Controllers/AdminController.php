<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // AdminHome
    public function admin() {
        return view('admin.adminHome');
    }
}
