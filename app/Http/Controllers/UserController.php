<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // User Dashboard
    public function index() {
        return view('user.userHome');
    }
}
