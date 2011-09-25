<?php

namespace Feather\Components\Request
{
    class RequestParameters extends ParameterCollection
    {
        public function __construct(array $params)
        {
            parent::__construct($params);
        }
        
        // @TODO -> If Feather::Config['ESCAPE_HTTP_POST'] is enabled, then override 'add' function and escape
    }
}