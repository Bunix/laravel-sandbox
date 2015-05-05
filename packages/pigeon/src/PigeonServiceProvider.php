<?php namespace Pigeon;

use Illuminate\Support\ServiceProvider;


/**
 * Class PigeonServiceProvider
 * @package Pigeon
 *
 */
class PigeonServiceProvider extends ServiceProvider
{

    public function register()
    {
        // Bind the library desired to the interface
        $this->app->bind('Pigeon\PigeonInterface', 'Pigeon\\'.config('packages.pigeon.library'));

        // Bind the facade to the Pigeon Interface
        $this->app->bind('pigeon', 'Pigeon\PigeonInterface');

        // Define an alias.
        $this->app->alias('Pigeon', 'Pigeon\Pigeon');

    }

    public function boot()
    {
        require __DIR__ . '/../../../vendor/autoload.php';

        $this->publishes([
            __DIR__.'/config/pigeon.php' => config_path('pigeon.php'),
        ], 'config');

        $this->loadViewsFrom(__DIR__.'/views/', 'pigeon');

        $this->publishes([
            __DIR__.'/views/' => base_path('resources/views/emails'),
        ], 'views');

    }

}