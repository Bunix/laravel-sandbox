<?php namespace RightStart\Services\Logger;

use Illuminate\Support\ServiceProvider;

class LoggerServiceProvider extends ServiceProvider {

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        /**** Logger Binding ***/
        $app->bind('Logger', function()
        {
            return new RightStartLogger();
        });
    }

}