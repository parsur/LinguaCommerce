<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    // Show Login login
    public function index() {
        return view('auth.login');
    }

    // Store Login
    public function store(StoreLoginRequest $request) {
        // Remember Token
        $remember = $request->get('remember_me');

        $remember_me = false;
        if(isset($remember)) {
            $remember_me = true;
        }

        // Auth
        $credentials = $request->only('email', 'password');
        if (Auth::attempt(($credentials), $remember_me)) {
            // Authentication passed...
            return redirect()->intended('/adminHome');
        }
        
    }
    
    //logout
    public function logout(Request $request) {
        Auth::logout();

        return redirect('login');
    }
    

}   
