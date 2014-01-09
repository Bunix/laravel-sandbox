<?php namespace NewProject\Services\Billing;

class StripeBilling implements BillingInterface {

    /**
     * Display Billing name
     *
     * @return string
     */
    public function display() {
        return 'Stripe';
    }

}