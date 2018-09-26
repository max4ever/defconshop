<?php

namespace Defconshop\Database;

class DatabaseConnection
{
    /**
     * @var \PDO
     */
    private static $instance;


    protected function __construct()
    {
    }

    /**
     * @return \PDO
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {

            try {
                //TODO add auto create db structure
                $db = new \PDO('mysql:host=' . \Config::MYSQL_HOST . ';dbname=' . \Config::MYSQL_DB_NAME, \Config::MYSQL_USERNAME, \Config::MYSQL_PASSWORD);
                $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $db->exec("SET CHARACTER SET utf8");
                self::$instance = $db;
            } catch (\PDOException $e) {
                die('Error connecting to mysql ' . $e->getMessage());
            }
        }

        return self::$instance;
    }


    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}