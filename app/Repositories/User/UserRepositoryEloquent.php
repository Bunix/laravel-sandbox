<?php
namespace App\Repositories\User;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Contracts\Auth\User as UserContract;
use Illuminate\Contracts\Auth\Remindable as RemindableContract;
use App\Repositories\EloquentRepositoryAbstract;

/*
 * This class is the Eloquent Implementation of the User Repository
 */

class UserRepositoryEloquent extends EloquentRepositoryAbstract implements UserRepositoryInterface, UserContract, RemindableContract
{

    use UserTrait, RemindableTrait;

    protected $table = 'user';

    protected $hidden = ['password', 'reset_key'];

    /*
    * Full Name Attribute Accessor.
    *
    * @return Collection
    */
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

}