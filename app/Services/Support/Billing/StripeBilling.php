<?php

namespace App\Services\Support\Billing;

class StripeBilling extends BillingAbstract implements BillingInterface
{

    /**
     * Display Billing name
     *
     * @return string
     */
    public function display()
    {
        $this->logInfo('Stripe Billing Used');
        return 'Stripe';
    }

}