<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;

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

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string|exists:users,' . $this->username() . ',status,1',
            'password' => 'required|string',
        ], [$this->username() . '.exists' => 'The selected username is invalid or the account has been locked.']);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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

    function authenticated(Request $request, $user)
    {   
        $site_code=$request->site_code;
        $sites =DB::table('sites')->where('site_code',$site_code)->first();
        $request->session()->put('siteCode', $sites->site_code);
        $request->session()->put('siteName', $sites->name);

        \LogActivity::addToLog('Login',"Site Code: $site_code");
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
    }
}
