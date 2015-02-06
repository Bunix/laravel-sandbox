<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Support\Alert\Type\WebopsAlert;

class AlertServiceProvider extends ServiceProvider
{
    protected $defer = true;

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
            $alert_mailer = \App::make('App\Services\Support\Mailer\Alert\AlertEmail');
            return new WebopsAlert($alert_mailer);
        });
    }

}