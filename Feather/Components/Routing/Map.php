<?php

namespace Feather\Components\Routing
{
    class Map
    {
        private $_controller;
        private $_action;
        private $_parameters;
        
        public function __construct(array $params = array())
        {
            $this->init($parms);
        }
        
        public function init (array $params)
        {
            $params = array_merge(array(
                'controller' => 'Home',
                'action'     => 'index',
                'parameters' => array()
            ), $params);
            
            $this->_controller = $params['controller'];
            $this->_action = $params['action'];
            $this->_parameters = $params['parameters'];
            
            $this->_validateController();
            
            return $this;
        }
        
        private function _validateController()
        {
            
        }
    }
}