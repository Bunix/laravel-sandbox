<?php namespace App\Services\Alert;

use Illuminate\Support\ServiceProvider;
use App\Services\Alert\App\WebopsAlert;

class AlertServiceProvider extends ServiceProvider
{

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        /**** Webops Alert Binding ***/
        $app->bind('WebopsAlert', function()
        {
            $alert_mailer = \App::make('App\Services\Mailer\Alert\AlertEmail');
            return new WebopsAlert($alert_mailer);
        });
    }

}