<?php

namespace Feather\Components\Request
{
    /**
     * @TODO -> Do the 'CHUNKS' make sense?
     */
    class PathParameters extends ParameterCollection
    {
        public function __construct($info)
        {
            // $info == $_SERVER['REQUEST_URI']
            $this->add('FULL_REQUEST', $info);
            
            // pull GET string
            $getString = substr($info, strpos($info, '?')+1);
            $getArray = explode('&', $getString);
            $this->add('GET_QUERY', $getArray);
            // no need to break each get key/val pair into pieces, already in RequestParameters
            
            // remove leading / and GET query
            $uri = substr(str_replace($getString, '', $info), 1);
            $uriArray = explode('/', $info);
            
            // add count of items
            $this->add('COUNT', count($uriArray));
            
            // add chunks
            $this->add('CHUNKS', $uriArray);
        }
    }
}