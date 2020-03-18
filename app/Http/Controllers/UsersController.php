<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//di setting model, App nya besar ya mau di foldernya tulisannya jg app bomat
use App\Models\Users as Users;

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
        if ($request->isMethod('get')) {
            //view profile page only
            
            $user_data = Users::where('user_id', $user_id)->get()->toArray();
            return view('users/usersedit', ['user_id'=>$user_id, 'userdata'=>$user_data]);
        } else if($request->isMethod('post')) {
            // if post

            echo "disni baru update user";
        }
        
    }

    //confirmation abis di masukin usersnya
    public function confirmupdate(Request $request, $user_id) {
    //post
        
    }

}
