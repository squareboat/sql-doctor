<?php

namespace SquareBoat\SqlDoctor;

use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher as Event;

class SqlDoctor
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Database\DatabaseManager $db
     * @param \Illuminate\Events\Dispatcher $event
     * @return void
     */
    public function handle(DatabaseManager $db, Event $event)
    {
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
