<?php
namespace App\Services\Mailer;

use Illuminate\Support\ServiceProvider;
use App\Services\Mailer\Alert;

class MailerServiceProvider extends ServiceProvider
{

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        /**** Mailer Alert Email ***/
        $app->bind('App\Services\Mailer\Alert\AlertEmail', function()
        {
            return new Alert\AlertEmail();
        });
    }

}