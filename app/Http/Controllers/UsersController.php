<?php

namespace App\Http\Controllers;

//di setting model, App nya besar ya mau di foldernya tulisannya jg app bomat
use App\Models\Users as Users;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    //panggil class , aturnya di web
    public function index(Request $request) {
        $users = new Users();
        $data = $users->getUserList();
        return view('users/users', ['userlist'=>$data]);
    }

    public function show() {
        return view('users/mypage');
    }

    //lempar dr root, blade, usercontroller IDnya , $user_id
    // Request segala yang dimasukin ama user, Request, $request, berdasarkan user id
    //balesan dari server , Response
    public function update(Request $request, $user_id) {
        //profile page blade
        if ($request->isMethod('get')) 
        {
            //view profile page only
            $user_data = Users::where('user_id', $user_id)->get()->toArray();
            return view('users/usersedit', ['user_id'=>$user_id, 'userdata'=>$user_data]);
        } 
        
        if($request->isMethod('post')) {
            // if post
           
            $validator = $request->validate([
            //'user_name' => ['required', 'string', Rule::unique('users','user_name')->ignore($user_id, 'user_id')],
            'realname' => ['required', 'string'],
            //'email' => ['required', 'string', 'email'],
            //'password' => ['required'],
            //'birthday' => ['required', 'date'],
            //'gender' => ['required'],
            ]);

            if(collect([$request->password])->isEmpty()) {
                $request->password = $request->passwordold;
            }
            
            
            $data = $request->all();
            //return redirect()->route('confirmedit', ['user_id' => $user_id])->with('usernewdata' ,$data);
            return redirect()->route('confirmedit', ['user_id' => $user_id, 'usernewdata' => $data]);
        }
        
    }

    //confirmation abis di masukin usersnya
    public function confirmupdate(Request $request, $user_id) {
    //post
        //confimation blade
        if ($request->isMethod('get')) 
        {
            //show confimation blade
            $newdata = $request->all();
            return view('users/confirmationedit', ['user_id'=>$user_id, 'usernewdata'=>$newdata]);
        } 
        
        if($request->isMethod('post')) {
            //save database only
            // $newdata = Users::where('user_id', $user_id)
            // ->update(['realname' => $request->realname,
            //             'password' => Hash::make($request->password)]);
            
            return redirect()->route('userlist')->with('alert-success', 'Data has been changed.');
        }
    }

}