<?php

namespace App\Models\Customer;

use App\Models\ModelAbstract;

class Customer extends ModelAbstract implements CustomerInterface
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

}
