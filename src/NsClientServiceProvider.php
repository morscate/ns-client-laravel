<?php

namespace Morscate\NsClient;

use Illuminate\Support\ServiceProvider;
use Spatie\QueryBuilder\QueryBuilderRequest;

class NsClientServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/ns-client-laravel.php' => config_path('ns-client-laravel.php'),
        ]);
    }

    public function register()
    {
//        $this->app->bind(NavitiaClient::class, function ($app) {
//            return new NavitiaClient();
//        });

        $this->app->singleton(NsClient::class, function () {
            return new NsClient();
        });
    }
}
