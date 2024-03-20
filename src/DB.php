<?php

namespace App;

use PgSql\Connection;
use PgSql\Result;

/**
 * Itnteração com o BD.
 *
 * @author Everton
 */
class DB {
    
    static private function connection(): Connection {
        return pg_connect('host=localhost port=5432 dbname=pmidd user=postgres password=lise890');
    }
    
    static public function query(string $sql): Result| false {
        return pg_query(self::connection(), $sql);
    }
}
