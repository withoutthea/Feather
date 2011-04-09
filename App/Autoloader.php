<?php

namespace Feather\App
{
    class Autoloader
    {
        public static function Autoload($class)
        {
            Feather::setupEnv();
            
            // if it doesn't start with \\, add it
            if (\substr($class, 0, 1) !== '\\') $class = '\\' . $class;
            
            // change namespace to directory path
            $path = \str_replace('\\', DS, \str_replace('\\FeatherWorks', '', $class)) . '.php';
            
            // include it
            include_once(APP_PATH . $path);
            
            return APP_PATH . $path;
        }
    }
}