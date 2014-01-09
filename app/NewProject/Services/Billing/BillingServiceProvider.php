<?php namespace NewProject\Services\Billing;

use Illuminate\Support\ServiceProvider;

class BillingServiceProvider extends ServiceProvider {

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        /**** Authorize Billing ***/
        $app->bind('AuthorizeBilling', function()
        {
            return new \NewProject\Services\Billing\AuthorizeBilling;
        });

        /**** Braintree Billing ***/
        $app->bind('BraintreeBilling', function()
        {
            return new \NewProject\Services\Billing\BraintreeBilling;
        });

        /**** Stripe Billing ***/
        $app->bind('StripeBilling', function()
        {
            return new \NewProject\Services\Billing\StripeBilling;
        });


        // Choose Default Billing
        $app->bind('NewProject\Services\Billing\BillingInterface', 'AuthorizeBilling');

    }

}