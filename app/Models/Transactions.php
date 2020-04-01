<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transaction';

    protected $primaryKey = 'transaction_id';

    protected $fillable = ['address', 'memo', 'status', 'transaction_date', 'created_by_user_id', 'created_by_user_name'];

    public function getTransactionList($transaction_id = null) {
        if($transaction_id != '') {
            return $this->select()->where('transaction_id', $transaction_id)->where('delete_flag',0)->get()->ToArray();
        } else {
            return $this->select()->where('delete_flag',0)->get()->ToArray();
        }
        
    }

    // SELECT transaction.transaction_id, `address`,`memo`,`status`, detail_transaction.product_id, `quantity`, product_name , product_image FROM `transaction` JOIN detail_transaction ON transaction.transaction_id = detail_transaction.transaction_id JOIN products ON detail_transaction.product_id = products.product_id WHERE transaction.transaction_id = '$orderno'

    public function getDetailTransactionList($transaction_id) {
        return detailtransaction::join('products', 'detailtransaction.product_id', '=', 'products.product_id')->where('detailtransaction.transaction_id', $transaction_id)->where('detailtransaction.delete_flag', 0)->orderBy('products.product_id')->get()->toArray();
    }

    // public function getDetailTransactionList($transaction_id) {
    //     return $this->join('detailtransaction', 'transaction.transaction_id', '=', 'detailtransaction.transaction_id')->where('transaction.transaction_id', $transaction_id)->where('transaction.delete_flag', 0)->get()->toArray();
    // }
}   