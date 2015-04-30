<?php namespace LaraMailer;

use Illuminate\Support\ServiceProvider;


/**
 * Class LaraMailerServiceProvider
 * @package LaraMailer
 *
 */
class LaraMailerServiceProvider extends ServiceProvider
{

    public function register()
    {
        // Bind the library desired to the interface
        $this->app->bind('LaraMailer\LaraMailerInterface', 'LaraMailer\\'.config('packages.laramailer.library'));
    }

    public function boot()
    {
        require __DIR__ . '/../../../vendor/autoload.php';

        $this->publishes([
            __DIR__.'/config/laramailer.php' => config_path('laramailer.php'),
        ], 'config');

        $this->loadViewsFrom(__DIR__.'/views/', 'laramailer');

        $this->publishes([
            __DIR__.'/views/' => base_path('resources/views/emails'),
        ], 'views');

    }

}