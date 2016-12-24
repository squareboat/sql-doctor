<?php

namespace SquareBoat\SqlDoctor;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher as Event;
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
     * @param \Illuminate\Database\DatabaseManager $db
     * @param \Illuminate\Events\Dispatcher $event
     * @return void
     */
    public function boot(Config $config, Request $request, DatabaseManager $db, Event $event)
    {
        if ( $config->get('app.debug') && $request->has('sql-doctor') ) {
            $db->connection()->enableQueryLog();
            
            $event->listen('kernel.handled', function ($request, $response) use($db) {
                $queries = $db->getQueryLog();

                if ($request->query('sql-doctor') == 2) {
                    foreach ($queries as $key => $query) {
                        $queries[$key]['query'] = vsprintf(str_replace('?', '\'%s\'', $query['query']), $query['bindings']);
                    }
                }

                dd($queries);
            });
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
