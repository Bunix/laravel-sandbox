<?php

namespace App\Providers;

use App\API\Serializers\NoDataArraySerializer;
use Dingo;
use League;
use Illuminate\Support\ServiceProvider;

class DingoServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $parameters = $this->app->request->all();

        // If parameter zap = 1 then set the API response formatting for Zapier
        if (isset($parameters['zap']) && $parameters['zap'] == 1) {

            $this->app['Dingo\Api\Transformer\Factory']->setAdapter(function ($app) {
                $fractal = new League\Fractal\Manager;
                $fractal->setSerializer(new NoDataArraySerializer);

                return new Dingo\Api\Transformer\Adapter\Fractal($fractal);
            });
        }

    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {

    }


}
