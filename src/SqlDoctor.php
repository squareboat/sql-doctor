<?php

namespace SquareBoat\SqlDoctor;

use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher as Event;
use Illuminate\Foundation\Http\Events\RequestHandled;

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
        
        $event->listen(RequestHandled::class, function ($handled) use($db) {
            $queries = $db->getQueryLog();

            if ($handled->request->query('sql-doctor') == 2) {
                foreach ($queries as $key => $query) {
                    $queries[$key]['query'] = $this->bindValues($query['query'], $query['bindings']);
                }
            }

            dd($queries);
        });
    }

    /**
     * Bind values to their parameters in the given query.
     *
     * @param string $query
     * @param array  $bindings
     * @return string
     */
    private function bindValues($query, $bindings) {
        $keys = array();
        $values = $bindings;

        // build a regular expression for each parameter
        foreach ($bindings as $key => $value) {
            if (is_string($key)) {
                $keys[] = '/:'.$key.'/';
            } else {
                $keys[] = '/[?]/';
            }

            if (is_string($value))
                $values[$key] = "'" . $value . "'";

            if (is_array($value))
                $values[$key] = "'" . implode("','", $value) . "'";

            if (is_null($value))
                $values[$key] = 'NULL';
        }

        $query = preg_replace($keys, $values, $query, 1, $count);

        return $query;
    }
}
