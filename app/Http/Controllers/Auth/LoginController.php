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
    public function showLoginForm() {
        return view('auth.login');
    }


    /**
     * Store admin.
     *
     * @var string
     */
    public function admin(StoreLoginRequest $request) {
        return $this->store($request, 'admin');
    }   

    /**
     * Store user.
     *
     * @var string
     */
    public function storeUser(StoreLoginRequest $request) {
        return $this->store($request);
    }  

    /**
     * Store data.
     *
     * @var string
     */
    public function store($request, $role = 'user') {
        // Remember Token
        $remember_me = false;
        if($request->has('remember_me')) {
            $remember_me = true;
        }

        // Auth
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt(($credentials), $remember_me)) {

            if($role == 'admin') {
                return Redirect::back()->withErrors('رمز عبور یا ایمیل شما نادرست است');
            }

            // ٍErrors
            return response()->json(['رمز عبور یا ایمیل شما نادرست است'], 401);
        } 

        if($role == 'admin') {
            return redirect()->intended('/admin/home');
        }

        $user = User::where('email', Auth::user()->email)->first();
        $authToken = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'access_token' => $authToken,
        ]);

    }   

    /**
     * logout.
     *
     * @var string
     */
    public function logout() {

        // Revoke a specific user token
        Auth::user()->tokens->each(function($token, $key) {
            $token->delete();
        });

        Auth::logout();

        return redirect('/');
    }
}
