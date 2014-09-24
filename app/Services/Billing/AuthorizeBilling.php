<?php
namespace App\Services\Billing;

class AuthorizeBilling implements BillingInterface
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