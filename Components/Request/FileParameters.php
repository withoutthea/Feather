<?php

namespace Feather\Components\Request
{
    use Feather\Components\Files;
    
    class FileParameters extends ParameterCollection
    {
        public function __construct(array $params)
        {
            // $vars = $_SERVER
            parent::__construct($params);
        }
    }
}