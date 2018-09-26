<?php

class Config
{
    const ENABLE_DEBUG = 1;
    const MYSQL_HOST = "127.0.0.1:3306";
    const MYSQL_USERNAME = "root";
    const MYSQL_PASSWORD = "";
    const MYSQL_DB_NAME = "defconshop";

    public static $BASE_PATH;


    public static function init()
    {
        //TODO maybe load configuration from an .ini config file
        setlocale(LC_MONETARY, 'it_IT');
        self::$BASE_PATH = dirname(__FILE__) . DIRECTORY_SEPARATOR .".." . DIRECTORY_SEPARATOR;
    }
}