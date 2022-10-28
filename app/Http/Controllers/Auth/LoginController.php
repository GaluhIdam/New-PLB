<?php

namespace App\Http\Controllers\Auth;

use App\Models\LoginHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    protected function authenticated(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            LoginHistory::create([
                'username' => $request->username,
                'email' => Auth::user()->email,
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->ip(),
                'last_login_device' => request()->userAgent()
            ]);
        }
    }
}