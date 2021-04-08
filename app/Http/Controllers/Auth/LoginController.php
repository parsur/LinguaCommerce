<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Providers\RedirectAuthentication;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreLoginRequest;
use App\Models\User;
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

            $user = User::where('email', $request->get('email'))->first();

            if($user->role == User::ADMIN) {
                // Authentication passed...
                return redirect()->intended('/adminHome');
            }

            $authToken = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'access_token' => $authToken,
            ]);
        } 

        // ٍErrors
        return response()->json(['رمز عبور یا ایمیل شما نادرست است'], 401); ;
    }   

    /**
     * logout.
     *
     * @var string
     */
    public function logout() {

        Auth::logout();
        return redirect('/');
    }
}
