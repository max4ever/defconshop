<?php

class Config
{
    const ENABLE_DEBUG = 1;
    public static $BASE_PATH = 123;

    public static function init()
    {
        //TODO maybe load from .ini file
        self::$BASE_PATH = dirname(__FILE__) . DIRECTORY_SEPARATOR .".." . DIRECTORY_SEPARATOR;
    }
}