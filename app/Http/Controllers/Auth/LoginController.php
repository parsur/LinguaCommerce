<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
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

    // Login
    public function showLoginForm() {
        return view('auth.login');
    }

    // Store data
    public function store(StoreLoginRequest $request) {

        $role = $request->has('role');

        // Remember Token
        $remember_me = false;
        if($request->has('remember_me')) {
            $remember_me = true;
        }

        // Auth
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt(($credentials), $remember_me)) {

            if($role) {
                return Redirect::back()->withErrors('رمز عبور یا ایمیل شما نادرست است');
            }
            // ٍErrors
            return $this->responseWithError('رمز عبور یا ایمیل شما نادرست است');
        } 

        if($role) {
            return redirect()->intended('/admin/home');
        }

        $user = User::where('email', Auth::user()->email)->first();
        if ($user->hasVerifiedEmail()) {

            $authToken = $user->createToken('auth-token')->plainTextToken;
            return response()->json(['access_token' => $authToken]);

        } else {
            return $this->responseWithError('ایمیل شما در گذشته تایید شده است', Response::HTTP_UNAUTHORIZED);
        }


    }   

    // logout
    public function logout(Request $request) {

        // Revoke a specific user token
        Auth::user()->tokens->each(function($token, $key) {
            $token->delete();
        });

        // admin
        if($request->has('role')) {
            Auth::logout();
            return redirect('/');
        }

        return $this->responseWithSuccess('کاربر با موفقیت از حساب کاربری خود خارج شد');
    }
}
