<?php

namespace Feather\Data\Connections
{
    class ConnectionParameters implements IConnectionParameters
    {
        /**
         *
         * @var type \Feather\Components\Collections\KeyedCollection
         */
        private $_parms;
        
        public function __construct(array $parameterMap = array())
        {
            $this->_parms = new \Feather\Components\Collections\KeyedCollection();
            
            if (!empty($parameterMap))
            {
                foreach ($parameterMap as $parm => $val)
                {
                    switch (strtolower($parm))
                    {
                        case "host":
                            $this->setHost($val);
                            break;
                        case "port":
                            $this->setPort($val);
                            break;
                        case "user":
                        case "username":
                            $this->setUsername($val);
                            break;
                        case "pass":
                        case "password":
                            $this->setPassword($val);
                            break;
                        case "db":
                        case "database":
                            $this->setDatabase($val);
                            break;
                    }
                }
            }
            
            return $this;
        }
        
        public function setHost($host)
        {
            $this->_parms["host"] = $host;
            
            return $this;
        }
        
        public function getHost()
        {
            return $this->_parms["host"];
        }
        
        public function setPort($port)
        {
            $this->_parms["port"] = $port;
            
            return $this;
        }
        
        public function getPort()
        {
            return $this->_parms["port"];
        }
        
        public function setUsername($username)
        {
            $this->_parms["username"] = $username;
            
            return $this;
        }
        
        public function getUsername()
        {
            return $this->_parms["username"];
        }
        
        public function setPassword($password)
        {
            $this->_parms["password"] = $password;
            
            return $this;
        }
        
        public function getPassword()
        {
            return $this->_parms["password"];
        }
        
        public function setDatabase($database)
        {
            $this->_parms["database"] = $database;
            
            return $this;
        }
        
        public function getDatabase()
        {
            return $this->_parms["database"];
        }
    }
}