<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    public function create(){
        return view('admin.auth.login');
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);   
        $credentials = $request->only('email', 'password');
        if (\Auth::guard('admin')->attempt($credentials)) {
            
            return redirect()->intended(RouteServiceProvider::ADMINHOME)->with(['success_msg'=>'Welcome to '.project().' admin panel: '.admininfo()->name]);
        }
  
        return redirect()->route("admin.login")->withErrors(['email'=>'These credentials do not match our records.']);
    }
    public function destroy(){
        Auth::guard('admin')->user()->token()->delete();
    }
}
