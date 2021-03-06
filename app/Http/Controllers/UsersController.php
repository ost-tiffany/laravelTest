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
use Auth;


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
            if($user_id != '') {  // typeid dilink 
                $cariuser = Users::find($user_id);
                if( $cariuser == NULL || $cariuser->delete_flag != 0) {
                    //// typeid didatabase
                    return redirect()->route('userlist')->with("alert-none", "ユーザーがありません");
                } else {
                    //view profile page only
                    $user_data = Users::where('user_id', $user_id)->get()->toArray();
                    return view('users/usersedit', ['user_id'=>$user_id, 'userdata'=>$user_data]);
                }
            } 
        } 
        if($request->isMethod('post')) {
            // if post
           
            $rules = [
                //'user_name' => ['required', 'string', Rule::unique('users','user_name')->ignore($user_id, 'user_id')],
                'realname' => ['required', 'string'],
            ];
           
            $messages = [
                'realname.required' => config('glossary.register.realname') .'を入力してください' ,
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if($validator->fails()) {
                return redirect()->route('douseredit', ['user_id'=>$user_id])->withErrors($validator)->withInput();
            } 
            if( $request->password == '') {
                $request->password = $request->passwordold;
            }
           
            $data["realname"] = $request->realname;
            $data["user_name"] = $request->user_name;
            $data["email"] = $request->email;
            $data["birthday"] = $request->birthday;
            $data["password"] = $request->password;
            $data["gender"] = $request->gender;
            //echo $data["user_name"];
            //return redirect()->route('confirmedit', ['user_id' => $user_id])->with('usernewdata' ,$data);
            return view('users/confirmationedit', ['user_id'=>$user_id, 'usernewdata' => $data]);
        }
        
    }

    //confirmation abis di masukin usersnya
    public function confirmupdate(Request $request, $user_id) {    
        if ($request->isMethod('get')) 
        {
            return view('users/confirmationedit', ['user_id'=>$user_id, 'usernewdata' => $data]); 
        } 
        
        if ($request->isMethod('post')) 
        {
            $Userer = Users::find($user_id);
            $Userer->realname = $request->realname;
            if($request->password != $Userer->password) {
                // echo $request->password;
                //$User = Users::find($user_id);

                $Userer->password =  Hash::make($request->password);

                // $newdata = Users::where('user_id', $user_id)
                // ->update([ 'realname' => $request->realname,                    
                //             // 'password' => Hash::make($request->password)
                //             ]);

            } 
            $Userer->save();
            return redirect()->route('userlist')->with('alert', '編集完了!')->with('type', '編集');
            //return redirect()->route('userlist')->with('alert-success', 'Data has been changed.');
              
        }  
    }

    public function userdelete(Request $request) {

        $Userer = Users::find($request->user_id);

        //if($request->user_id == auth::user()->user_id ) {
            // Auth::logout();
            // return redirect('/login');
        //    return redirect()->route('userlist')->with('alert', '削除できません!')->with('type', '削除');
        //} else {
            $Userer->delete_flag = 1;
            $Userer->save();
            return redirect()->route('userlist')->with('alert', '削除完了!')->with('type', '削除');

        //}

        // echo $request->user_id;
        // echo auth::user()->user_id;
    }
}