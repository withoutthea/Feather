<?php

namespace Feather\Components\Registry
{
    class Registry
    {
        /**
         *
         * @var type \Feather\Components\Registry
         */
        private $_instance;
        
        /**
         *
         * @var type \Feather\Components\Collections\KeyedCollection
         */
        private $_registry;
        
        /**
         *
         * @var type bool
         */
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
            $this->_registry = new \Feather\Components\Collections\KeyedCollection();
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
            if ($this->hasKey($key) && !$this->_overwrite)
                throw new RegistryKeyAlreadyExistsException();
            
            $this->_registry[$key] = $val;
        }
        
        public function __get($key)
        {
            if (!$this->hasKey($key))
            {
                // no exception thrown
                return false;
            }
            
            return $this->getValue($key);
        }
        
        public function __set($key, $val)
        {
            $this->setValue($key, $val);
        }
        
        public function hasKey($key)
        {
            return isset($this->_registry[$key]);
        }
    }
}