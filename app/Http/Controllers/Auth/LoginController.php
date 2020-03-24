<?php

namespace App\Http\Controllers\Auth;

//
use Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users as Users;
use Illuminate\Support\MessageBag;
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

    
    public function index() 
    {
        return view('auth\login');
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function dologin(Request $request) {
        if (Auth::attempt(['user_name' => $request->user_name, 'password' => $request->password, 'delete_flag'=>0]))
        {   
            return redirect('home')->with('alert-success', 'You are now logged in.');
        }
        
        else {
            $errors = new MessageBag;
            $errors = new MessageBag(['invalid' => ['Email and/or password invalid.']]); 
            return redirect('login')->withErrors($errors);
        }

    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
      }
}
