<?php

namespace SquareBoat\SqlDoctor;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Config\Repository as Config;

class SqlDoctorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @param \Illuminate\Config\Repository $config
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function boot(Config $config, Request $request)
    {
        if ( $config->get('app.debug') && $request->has('sql-doctor') ) {
            $this->app->call('SquareBoat\SqlDoctor\SqlDoctor@handle');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // 
    }
}
