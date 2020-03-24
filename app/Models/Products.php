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

     public function getOtherList() {
        return $this->select()
                    ->where('product_type', 2)
                    ->get()
                    ->toArray();
    }
}
