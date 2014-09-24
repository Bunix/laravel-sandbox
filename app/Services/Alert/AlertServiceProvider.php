<?php namespace App\Services\Alert;

use Illuminate\Support\ServiceProvider;
use App\Services\Alert\Admin\AdminAlert;

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

        /**** Admin Alert Binding ***/
        $app->bind('AdminAlert', function()
        {
            $alert_mailer = \App::make('App\Services\Mailer\Alert\AlertEmail');
            return new AdminAlert($alert_mailer);
        });
    }

}