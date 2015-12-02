<?php

namespace App\Services\Support\Billing;

class BraintreeBilling extends BillingAbstract implements BillingInterface
{

    /**
     * Display Billing name
     *
     * @return string
     */
    public function display()
    {
        return 'Braintree';
    }

}