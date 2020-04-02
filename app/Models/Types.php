<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    protected $table = 'types';

    protected $primaryKey = 'type_id';

    public $timestamps = false; //biar ga ada created at sama updated at otomatis

    public function getTypeList() {
        return $this->select()
                    ->get()
                    ->toArray();
    }

}
