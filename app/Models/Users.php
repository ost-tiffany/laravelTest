<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = ['user_name', 'realname', 'email', 'password', 'birthday', 'gender'];

    public function getUserList() {
        return $this->select()->get()->toArray();
    }
}
