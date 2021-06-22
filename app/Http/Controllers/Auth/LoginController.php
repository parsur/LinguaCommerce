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

            $error = 'رمز عبور یا ایمیل شما نادرست است';

            if($role) {
                return Redirect::back()->withErrors($error);
            }
            // ٍErrors
            return $this->failedResponse($error, Response::HTTP_NON_AUTHORITATIVE_INFORMATION);
        } 

        if($role) {
            return redirect()->intended('/admin/home');
        }

        $user = User::where('email', Auth::user()->email)->first();
        if ($user->hasVerifiedEmail()) {

            // Revoke all tokens...
            $user->tokens()->delete();
            
            $access_token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'access_token' => $access_token,
                'message' => 'ورود شما با موفقیت انجام شد'
            ], Response::HTTP_OK);  

        } else {
            return $this->failedResponse('ایمیل شما تایید نشده است', Response::HTTP_UNAUTHORIZED);
        }
    }   

    // Logout
    public function logout(Request $request) {

        // Admin
        if($request->has('admin')) {
            Auth::logout();
            return redirect('/');
        }

        // Revoke a specific user token
        $user = User::find(auth()->user()->id);
        $user->tokens()->delete();

        return $this->successfulResponse('کاربر با موفقیت از حساب کاربری خود خارج شد');
    }
}
