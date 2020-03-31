<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    protected $table = 'detailtransaction';

    protected $primaryKey = 'detail_id';

    protected $fillable = ['transaction_id', 'product_id', 'quantity', 'created_by_user_id', 'created_by_user_name'];


    // public function getDetailTransactionList($transaction_id) {
    //     return $this->join('products', 'detailtransaction.product_id', '=', 'products.product_id')->where('transaction.transaction_id', $transaction_id)->where('transaction.delete_flag', 0)->get()->toArray();
    // }
}
