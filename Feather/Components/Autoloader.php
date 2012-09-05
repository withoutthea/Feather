<?php

namespace Feather\Components
{
    /**
     * @TODO -> Add "namespace" function (array('namespace' => 'path/to/files')) such that multiple namespaces can be utilized.
     */
    class Autoloader
    {
        protected $_classPaths = array();
        protected $_classCache = array();
        protected $_ignoreClassNames = array();
        //protected $excludeFolderNames = array();
        
        public function __construct()
        {
            
        }
        
        public function register()
        {
            spl_autoload_register(array('\Feather\Components\Autoloader', 'autoload'));
        }
        
        public function addClassPath($class, $path)
        {
            $this->_classPaths[$class] = $path;
            return $this;
        }
        
        public function addClassPaths(array $classes)
        {
            foreach ($classes as $class => $path)
            {
                $this->addClassPath($class, $path);
            }
            
            return $this;
        }
        
        public function getClassPath($class)
        {
            return array_key_exists($class, $this->_classPaths) ? $this->_classPaths[$class] : false;
            
        }
        
        public function addCachedClassPath($class, $path)
        {
            $this->_classCache[$class] = $path;
            return $this;
        }
        
        public function getCachedClassPath($className)
        {
            return $this->_classCache[$className];
        }
        
        public function ignoreClassName($className)
        {
            $this->_ignoreClassNames[] = $className;
            return $this;
        }
        
        public function getIgnoredClassNames()
        {
            return $this->_ignoreClassNames;
        }
        
        public function autoload($class)
        {
            foreach ($this->getIgnoredClassNames() as $ignoredClass)
            {
                if ($class === $ignoredClass
                    || preg_match($ignoredClass, $class))
                {
                    return false;
                }
            }
            
            // if it doesn't start with \\, add it
            if (\substr($class, 0, 1) !== '\\') $class = '\\' . $class;
            
            if ($this->checkForKnownClasses($class))
            {
                $this->addCachedClassPath($class, $this->getClassPath($class));
            }
            
            if (!$this->checkForCachedClasses($class))
            {
                $this->addCachedClassPath($class, $this->generatePath($class));
            }
            
            return $this->loadClass($class);
        }
        
        public function loadClass($class)
        {
            $fullPath = APP_PATH . $this->getCachedClassPath($class);
            include_once($fullPath);
            return $fullPath;
        }
        
        public function generatePath($class)
        {
            //$path = \str_replace('\\', DS, \str_replace('\\Feather', '', $class)) . '.php';
            $path = \str_replace('\\', DS, $class) . '.php';
            if (file_exists(APP_PATH . $path))
                return $path;
            
            // @TODO -> Should thrown an exception.
            return false;
        }
        
        private function checkForKnownClasses($className)
        {
            return array_key_exists($className, $this->_classPaths);
        }
        
        private function checkForCachedClasses($className)
        {
            return array_key_exists($className, $this->_classCache);
        }
    }
}