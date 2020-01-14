<?php

namespace App\Http\Controllers\Auth;

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
    protected $redirectTo = '/home';
     protected $username;

    protected function guard()
    {
        return Auth::guard('admins');
    }
    protected function redirectTo()
    {
        return 'sys/dashboard';
    }
    public function findUsername()
    {
        if(filter_var(request()->login,FILTER_VALIDATE_EMAIL))
        {
            return 'admin_email';
        }else{
            return 'admin_username';
        }
    }
    public function username()
    {
        return $this->username;
    }
    protected function validateLogin($request)
    {
        
        $this->validate($request, [
            'login' => 'required|string',
            'password' => 'required|string',
        ],[],['login' => "Username Or Email",'password' => 'Password']);
    }
    protected function credentials($request)
    {
        
        $request->merge([$this->username() => $request->login]);
        return $request->only($this->username(), 'password');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->username = $this->findUsername();
        $this->middleware('guest')->except('logout');
    }
}
