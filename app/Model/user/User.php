<?php

namespace App\Model\user;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'status', 'phone',
    ];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function roles()
    {
    	return $this->belongsToMany('App\Model\user\Role','user_roles','user_id','role_id')->withTimestamps();
    }

    protected $hidden = [
        'password', 'remember_token',
    ];
}
