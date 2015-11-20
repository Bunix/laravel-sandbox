<?php

namespace App\Models\Admin;

use App\Models\ModelAbstract;

class Admin extends ModelAbstract implements AdminInterface
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admins';

}
