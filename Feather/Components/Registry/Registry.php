<?php

namespace Feather\Components\Registry
{
    class Registry
    {
        private $_instance;
        private $_registry;
        private $_overwrite;
        
        public static function getRegistry(bool $overwrite = false)
        {
            if (!self::$_instance)
            {
                self::$_instance = new Registry($overwrite);
            }
            
            return self::$_instance;
        }
        
        private function __construct($overwrite)
        {
            $this->_registry = array();
            $this->setOverwrite($overwrite);
        }
        
        public function setOverwrite(bool $overwrite)
        {
            $this->_overwrite = $overwrite;
        }
        
        public function getValue($key)
        {
            return $this->_registry[$key];
        }
        
        public function setValue($key, $val)
        {
            $this->_registry[$key] = $val;
        }
        
        public function __get($key)
        {
            if (!$this->hasKey($key))
            {
                // no exception thrown
                return false;
            }
            
            return $this->_getValue($key);
        }
        
        public function __set($key, $val)
        {
            if ($this->hasKey($key) && !$this->_overwrite)
                throw new RegistryKeyAlreadyExistsException();
            
            $this->setValue($key, $val);
        }
        
        public function hasKey($key)
        {
            return isset($this->_registry[$key]);
        }
    }
}