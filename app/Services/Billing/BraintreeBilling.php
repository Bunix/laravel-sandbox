<?php
namespace App\Services\Billing;

class BraintreeBilling implements BillingInterface
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