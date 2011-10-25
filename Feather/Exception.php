<?php

namespace Feather
{
    class Exception extends \Exception
    {
        public function __construct($message = null, $code = 0, Exception $previous = null)
        {
            parent::__construct($message, $code, $previous);
        }
        
        public function __toString()
        {
            return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
        }
        
        public function fancyMessage()
        {
            // @TODO -> Implement a nice, table like display of the error
        }
    }
}