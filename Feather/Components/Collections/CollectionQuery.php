<?php

namespace Feather\Components\Collections
{
    class CollectionQuery
    {
        private $_queryParameters;
        private $_type;
        private $_iteration;

        public function __construct($type = null)
        {
            $this->_queryParameters = array();
            $this->_iteration = -1;

            if ($type === null || (strtolower($type) !== 'and' && strtolower($type) !== 'or'))
            {
                $this->_type = 'and';
            }
            else
            {
                $this->_type = $type;
            }

            return $this;
        }

        public function addParameter($key, $value)
        {
            $this->_queryParameters[] = array(
                'key' => $key,
                'value' => $value
            );
            
            return $this;
        }

        public function add($key, $value = null)
        {
            // an array could be passed as the first (and only) parm
            if (is_array($key))
            {
                $this->addParameter($key['key'], $key['value']);
            }

            // or it's all three
            else
            {
                $this->addParameter($key, $value);
            }
            
            return $this;
        }

        public function getQuery()
        {
            if ($this->_iteration < count($this->_queryParameters) - 1)
            {
                $this->_iteration++;
                //echo 'iteration now: '.$this->_iteration;
                return true;
            }
            else
            {
                return false;
            }
        }
        
        public function resetQuery()
        {
            $this->_iteration = -1;
            echo 'iteration reset: '.$this->_iteration;
        }

        public function getKey()
        {
            return $this->_queryParameters[$this->_iteration]['key'];
        }

        public function getValue()
        {
            return $this->_queryParameters[$this->_iteration]['value'];
        }

        public function getType()
        {
            return $this->_type;
        }
    }
}