<?php
namespace App\Services\Billing;

use Illuminate\Support\ServiceProvider;
use App\Services\Billing;

class BillingServiceProvider extends ServiceProvider
{

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
            return new AuthorizeBilling;
        });

        /**** Braintree Billing ***/
        $app->bind('BraintreeBilling', function()
        {
            return new BraintreeBilling;
        });

        /**** Stripe Billing ***/
        $app->bind('StripeBilling', function()
        {
            return new StripeBilling;
        });


        // Choose Default Billing
        $app->bind('App\Services\Billing\BillingInterface', 'StripeBilling');

    }

}