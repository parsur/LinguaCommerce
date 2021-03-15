<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Providers\RedirectAuthentication;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreLoginRequest;
use Redirect;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your desirable screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Login.
     *
     * @var string
     */
    public function index() {
        return view('auth.login');
    }

    /**
     * Store data.
     *
     * @var string
     */
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
         
        return Redirect::back()->withErrors('رمز عبور یا ایمیل شما نادرست است');
    }
    
    /**
     * logout.
     *
     * @var string
     */
    public function logout(Request $request) {

        Auth::logout();
        return redirect('/');
    }
}
