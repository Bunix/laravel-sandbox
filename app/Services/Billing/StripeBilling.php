<?php
namespace App\Services\Billing;

class StripeBilling implements BillingInterface
{

    /**
     * Display Billing name
     *
     * @return string
     */
    public function display()
    {
        return 'Stripe';
    }

}