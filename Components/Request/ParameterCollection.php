<?php

namespace Feather\Components\Request
{
    class ParameterCollection extends BasicCollection implements IParameterCollection
    {
        public function __construct(array $params)
        {
            foreach ($params as $key => $val)
            {
                $this->add($key, $val);
            }
        }
        
        public function getParam($param)
        {
            if (isset($this->_collection[$param]))
            {
                return $this->_collection[$param];
            }
            
            return false;
        }
    }
}