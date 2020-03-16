<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = 'users';

    protected $primaryKey = 'user_id';

    public function getUserList() {
        return $this->select()->get()->toArray();

    }
}
