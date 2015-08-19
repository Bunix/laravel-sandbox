<?php

namespace App\Repositories\Admin;

use App\Repositories\EloquentAbstract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/*
 * This class is the Eloquent Implementation of the User Repository
 */

class AdminsEloquent extends EloquentAbstract implements AdminRepositoryInterface, AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'admin';

    protected $hidden = ['password'];

    /*
    * Full Name Attribute Accessor.
    *
    * @return Collection
    */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}