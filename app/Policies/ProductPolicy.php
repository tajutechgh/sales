<?php

namespace App\Policies;

use App\Model\user\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        //
    }

    public function products(User $user)
    {
        return $this->getPermission($user,1);
    }

    public function pos(User $user)
    {
        return $this->getPermission($user,2);
    }

    public function sales(User $user)
    {
        return $this->getPermission($user,3);
    }

    public function report(User $user)
    {
        return $this->getPermission($user,4);
    }
    public function expenses(User $user)
    {
        return $this->getPermission($user,5);
    }

    public function settings(User $user)
    {
        return $this->getPermission($user,6);
    }
    
    protected function getPermission($user,$p_id)
    {
        foreach ($user->roles as $role) {

            foreach ($role->permissions as $permission) {

                if ($permission->id == $p_id) {

                    return true;
                }
            }
        }

        return false;
    }

}
