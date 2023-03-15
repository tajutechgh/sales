<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Sale_info extends Model
{
    public function sales()
    {
       return $this->hasMany('App\Model\user\Sale','saleInfo_id');
    }
    
    public function user()
    {
       return $this->belongsTo('App\Model\user\User','user_id');
    }

}
