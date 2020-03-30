<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table = 'products';

    protected $primaryKey = 'product_id';
 
    protected $fillable = ['product_id', 'product_name', 'product_image', 'product_type', 'created_by_user_id', 'created_by_user_name', 'updated_by_user_id', 'updated_by_user_name'];
 
    // public function getProductsList() {
    //      return $this->select()->get()->toArray();
    //  }

    // public function getOtherList() {
    //     return $this->select()
    //                 ->where('product_type', 2)
    //                 ->get()
    //                 ->toArray();
    // }

    public function getProductNameTransaction() {
        return $this->select()->where('delete_flag', 0)->get()->toArray();
    }

    public function getProductlist($type_id = null) {
        if($type_id != '') {
            return $this->join('types', 'products.product_type', '=', 'types.type_id')->where('product_type', $type_id)->where('delete_flag', 0)->get()->toArray();
        } else {
            return $this->join('types', 'products.product_type', '=', 'types.type_id')->where('delete_flag', 0)->latest()->limit(10)->get()->toArray();
        }
    }
}
