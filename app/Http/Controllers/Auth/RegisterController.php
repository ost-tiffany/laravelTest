<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Users as Users;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo ='login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index() 
    {
        return view('auth\register');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Users
     */
    protected function create(Request $request)
    {

        $rules = [
            'user_name' => ['required', 'string'],
            'realname' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string'],
            'birthday' => ['required', 'date'],
            'gender' => ['required'],
        ];

        $messages = [
            'user_name.required' => config('glossary.register.user_name') .'を入力してください' ,
            'realname.required' => config('glossary.register.realname') .'を入力してください' ,
            'email.required' => config('glossary.register.email') .'を入力してください' ,
            'password.required' => config('glossary.register.password') .'を入力してください' ,
            'birthday.required' => config('glossary.register.birthday') .'を入力してください' ,
        ];
        

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect('register')->withErrors($validator)->withInput();
        } 
        else {
            $users = new Users();
            $users->user_name = $request->user_name;
            $users->realname = $request->realname;
            $users->email = $request->email;
            $users->password = Hash::make($request->password);
            $users->birthday = $request->birthday;
            $users->gender = $request->gender;
            $users->save();
        }
    }
}
