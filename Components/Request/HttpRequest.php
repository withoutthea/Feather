<?php

namespace Feather\Components\Request
{
    class HttpRequest implements IRequest
    {
        public $server;
        public $path; // $_SERVER['PATH_INFO']
        public $cookie;
        public $get;
        public $post;
        public $files;
        
        public function __construct(array $server, array $path, array $cookie, array $get, array $post, array $files)
        {
            $this->init($server, $path, $cookie, $get, $post, $files);
        }
        
        public function init(array $server, array $path, array $cookie, array $get, array $post, array $files)
        {
            $this->server = new ServerParameters($server);
            $this->get = new RequestParameters($get);
            $this->post = new RequestParameters($post);
            $this->files = new FileParameters($files);
            $this->cookie = new SessionParameters($cookie);
            $this->path = new PathParameters($this->server->getParam('PATH_INFO'));
        }
        
        public static function createFromGlobals()
        {
            return new static($_SERVER, array(), $_COOKIE, $_GET, $_POST, $_FILES);
        }
        
        public function setUri($uri) {}
        public function getUri() {}
    }
}