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
}
