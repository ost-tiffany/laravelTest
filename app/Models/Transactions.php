<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transaction';

    protected $primaryKey = 'transaction_id';

    protected $fillable = ['address', 'memo', 'status', 'transaction_date', 'created_by_user_id', 'created_by_user_name'];
}