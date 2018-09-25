<?php

class MyAutoloader
{
    public static function startAutoloader()
    {
        spl_autoload_register(array("MyAutoloader", "loadThis"));

    }

    public static function loadThis($className)
    {
        $class_name = str_replace("\\", DIRECTORY_SEPARATOR, $className);
        $class_name = str_replace("Defconshop", "", $class_name);//TODO add directory mapping

        $directory = dirname(__FILE__);
        $file_name = $directory . $class_name . ".php";

        if (file_exists($file_name)) {
            require_once($file_name);
        }
        else{
            die("Cannot autoload $className, tried looking for it in $file_name");//TODO $file_name not so security wise
        }
    }

}