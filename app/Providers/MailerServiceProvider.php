<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RightStart\Services\Support\Mailer\Alert;

class MailerServiceProvider extends ServiceProvider
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

        /**** Mailer Alert Email ***/
        $app->bind('RightStart\Services\Support\Mailer\Alert\AlertEmail', function()
        {
            return new Alert\AlertEmail();
        });
    }

}