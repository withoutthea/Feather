<?php

namespace Feather\Data\Connections
{
    class MySqlConnector implements IDataConnector
    {
        /**
         *
         * @var type \Feather\Data\Connections\MySqlConnector
         */
        private static $_instance;
        
        private $_isConnected = false;
        
        /**
         *
         * @var type \mysqli
         */
        private $_mysql;
        
        private $_queries;
        private $_lastResult;
        private $_numberOfRows;
        private $_numberOfAffectedRows;
        private $_lastInsertId;
        private $_hasError;
        private $_errors;
        
        public static function getConnection(\Feather\Data\Connections\IConnectionParameters $parameters = false)
        {
            if (!self::$_instance)
            {
                self::$_instance = new MySqlConnector($parameters);
            }
            
            return self::$_instance;
        }
        
        private function __construct(\Feather\Data\Connections\IConnectionParameters $parameters = false)
        {
            if (!$_isConnected)
            {
                if (!$parameters)
                    $parameters = \Feather\App\Registry::get('ConnectionParameters');
                
                $this->connect($parameters);
            }
            
            $this->_queries = new \Feather\Components\Collections\SimpleCollection();
            $this->_errors = new \Feather\Components\Collections\SimpleCollection();
            $this->_numberOfAffectedRows = $this->_numberOfRows = $this->_lastInsertId = 0;
            $this->_lastResult = $this->_hasError = false;
        }
        
        public function __destruct()
        {
            $this->disconnect();
        }
        
        private function connect(\Feather\Data\Connections\IConnectionParameters $parameters)
        {
            $this->_mysql = new \mysqli($parameters->getHost(),
                                       $parameters->getUsername(),
                                       $parameters->getPassword(),
                                       $parameters->getDatabase());
            
            if ($this->_mysql->connect_error)
            {
                $this->_isConnected = false;
                throw new \Feather\Exceptions\MySqlConnectionException();
            }
        }
        
        public function disconnect()
        {
            if ($this->_isConnected)
                $this->_mysql->close();
            $this->_isConnected = false;
        }
        
        public function query($query)
        {
            if($this->_isConn)
            {
                $this->_lastResult = $this->_mysql->query($query);
                $this->_numberOfRows = $this->_lastResult->num_rows;
                $this->_queries->add($query);
                
                if ($this->_mysql->errno != 0)
                {
                    $this->_hasError = true;
                    $this->_errors->add($this->_mysql->error);
                    throw new \Feather\Exceptions\MySqlQueryException($this->_mysql->error, $this->_mysql->errno);
                }
                
                return $this;
            }
            
            return false;
        }
        
        public function execute($query)
        {
            return $this->query($query);
        }
        
        // @TODO -> Implement insert function
        // @TODO -> Implement update function
        // @TODO -> Implement delete function
        
        public function fetchAssoc(\mysqli_result $result = null)
        {
            if ($this->_isConnected)
            {
                if ($result == null) {
                    $result = $this->_lastResult;
                }

                return $result->fetch_assoc();
            }
        }

        public function fetchArray(\mysqli_result $result = null)
        {
            if ($this->_isConnected)
            {
                if ($result == null) {
                    $result = $this->_lastResult;
                }

                return $result->fetch_array();
            }
        }

        public function fetchObject(\mysqli_result $result = null)
        {
            if ($this->_isConnected)
            {
                if ($result == null) {
                    $result = $this->_lastResult;
                }

                return $result->fetch_object();
            }
        }
        
        public function getLastResult()
        {
            return $this->_lastResult;
        }
        
        public function getNumberOfRows()
        {
            return $this->_numberOfRows;
        }
        
        public function getNumberOfAffectedRows()
        {
            return $this->_numberOfAffectedRows;
        }
        
        public function getLastInsertId()
        {
            return $this->_lastInsertId;
        }
        
        public function hasError()
        {
            return $this->_hasError;
        }
    }
}