<?php

namespace App\Repositories\User;

use App\Repositories\EloquentAbstract;
use App\Repositories\RepositoryInterface;
use App\Repositories\RepositoryQueryInterface;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/*
 * This class is the Eloquent Implementation of the User Repository
 */

class UsersEloquent extends EloquentAbstract implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    UserRepositoryInterface
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

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