<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    protected $table = 'detailtransaction';

    protected $primaryKey = 'detail_id';

    protected $fillable = ['transaction_id', 'product_id', 'quantity', 'created_by_user_id', 'created_by_user_name'];
}
