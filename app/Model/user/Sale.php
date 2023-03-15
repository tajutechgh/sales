<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function sale_info()
    {
       return $this->belongsTo('App\Model\user\Sale_info','saleInfo_id');
    }
}
