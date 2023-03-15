<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function scopeSearch($query, $s)
    {
        return $query->where('name', 'like', '%' .$s. '%')
                    ->orWhere('brand', 'like', '%' .$s. '%');
    }
}
