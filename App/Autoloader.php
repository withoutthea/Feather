<?php

namespace Feather\App
{
    /**
     * @TODO -> Add error checking/exceptions.
     * @TODO -> Add full phpDoc.
     */
    class Autoloader
    {
        private static $_knownClasses = array();
        
        public static function Autoload($class)
        {
            Feather::setupEnv();
            
            // if it doesn't start with \\, add it
            if (\substr($class, 0, 1) !== '\\') $class = '\\' . $class;
            
            // check if its a known class
            if (!self::CheckKnownClasses($class))
            {
                self::AddClass($class, self::GeneratePath($class));
            }
            
            return self::LoadClass(self::GetClassPath($class));
        }
        
        private static function GeneratePath($class)
        {
            $path = \str_replace('\\', DS, \str_replace('\\Feather', '', $class)) . '.php';
            
            if (file_exists(APP_PATH . $path))
                return $path;
            
            // @TODO -> Should thrown an exception.
            return false;
        }
        
        private static function AddClass($class, $path)
        {
            self::$_knownClasses[$class] = $path;
        }
        
        private static function GetClassPath($class)
        {
            return self::$_knownClasses[$class];
        }
        
        private static function CheckKnownClasses($class)
        {
            return array_key_exists($class, self::$_knownClasses);
        }
        
        private static function LoadClass($path)
        {
            $fullPath = APP_PATH . $path;
            include_once($fullPath);
            return $fullPath;
        }
    }
}