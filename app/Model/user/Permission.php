<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles()
    {
    	return $this->belongsToMany('App\Model\user\Role','permission_roles','permission_id','role_id')->withTimestamps();
    }
}
