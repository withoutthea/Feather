<?php

namespace Feather
{
    final class Feather
    {
        public static function setupEnv()
        {
            $os = 'UNIX';
            if (stristr(PHP_OS,'WIN'))
            {
                $os = 'WIN';
            }
            
            if (!defined('DIRECTORY_SEPARATOR'))
            {
                define('DIRECTORY_SEPARATOR',($os == 'UNIX') ? '/' : '\\');
            }
            if (!defined('DS'))
			{
				define('DS', \DIRECTORY_SEPARATOR);
			}
            
            if (!defined('PATH_SEPARATOR'))
            {
                define('PATH_SEPARATOR', ($os == 'UNIX') ? ':' : ';');
            }
			if (!defined('PS'))
			{
				define('PS', \PATH_SEPARATOR);
			}
            
            if (!defined('APP_PATH'))
            {
                define('APP_PATH', dirname(dirname(__FILE__)));// . DIR_SEPARATOR . '..');
                define('AP', APP_PATH);
            }
        }
    }
}