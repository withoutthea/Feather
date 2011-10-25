<?php

namespace Feather\Data\Connections
{
    class ConnectionParameters implements IConnectionParameters
    {
        private $_host;
        private $_port;
        private $_username;
        private $_password;
        private $_database;
        
        public function __construct()
        {
            return $this;
        }
        
        public function setHost($host)
        {
            $this->_host = $host;
            
            return $this;
        }
        
        public function getHost()
        {
            return $this->_host;
        }
        
        public function setPort($port)
        {
            $this->_port = $port;
            
            return $this;
        }
        
        public function getPort()
        {
            return $this->_port;
        }
        
        public function setUsername($username)
        {
            $this->_username = $username;
            
            return $this;
        }
        
        public function getUsername()
        {
            return $this->_username;
        }
        
        public function setPassword($password)
        {
            $this->_password = $password;
            
            return $this;
        }
        
        public function getPassword()
        {
            return $this->_password;
        }
        
        public function setDatabase($database)
        {
            $this->_database = $database;
            
            return $this;
        }
        
        public function getDatabase()
        {
            return $this->_database;
        }
    }
}