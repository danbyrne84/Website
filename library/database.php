<?php
namespace library;

/**
 * Simple database access class utilising PDO
 * Implements multiton pattern to support multiple instances by key
 *
 * @todo refactor using adapter pattern
 */
class Database
{
    /**
     * Registry of database connections
     *
     * @var array
     */
    protected static $instances = array();

    /**
     * Get an instance of PDO for the given connection string
     *
     * @static
     * @param $connectionString
     * @return mixed
     */
    public static function getInstance($connectionString)
    {
        // check pdo instance registry for matching connection string and set if not already exists
        if(!array_key_exists($connectionString, self::$instances)){
            $args = explode( '|', $connectionString);
            self::$instances[$connectionString] = new \PDO($args[0], $args[1], $args[2]);
        }

        // return
        return self::$instances[$connectionString];
    }
}