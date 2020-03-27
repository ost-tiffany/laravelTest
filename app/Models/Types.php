<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    protected $table = 'types';

    protected $primaryKey = 'type_id';

    public function getTypeList() {
        return $this->select()
                    ->get()
                    ->toArray();
    }

}
