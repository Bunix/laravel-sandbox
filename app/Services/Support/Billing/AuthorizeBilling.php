<?php

namespace App\Services\Support\Billing;

use App\Services\Support\SupportServiceAbstract;

class AuthorizeBilling extends BillingAbstract implements BillingInterface
{

    /**
     * Display Billing name
     *
     * @return string
     */
    public function display()
    {
        return 'Authorize.net';
    }

}