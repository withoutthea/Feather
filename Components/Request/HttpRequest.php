<?php

namespace Feather\Components\Request
{
    class HttpRequest
    {
        /**
         * @var \Feather\Components\Request\ServerParameters 
         */
        public $server;
        
        /**
         *
         * @var \Feather\Components\Request\PathParameters
         */
        public $path;
        
        /**
         *
         * @var \Feather\Components\Request\SessionParameters
         */
        public $cookie;
        
        /**
         *
         * @var \Feather\Components\Request\RequestParameters
         */
        public $get;
        
        /**
         *
         * @var \Feather\Components\Request\RequestParameters
         */
        public $post;
        
        /**
         *
         * @var \Feather\Components\Request\UploadedFileCollection
         */
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
            $this->files = new UploadedFileCollection($files);
            $this->cookie = new SessionParameters($cookie);
            $this->path = new PathParameters($this->server->get('REQUEST_URI'));
        }
        
        public static function createFromGlobals()
        {
            return new static($_SERVER, array(), $_COOKIE, $_GET, $_POST, $_FILES);
        }
        
        /**
         * Not 100% reliable, but a quick check to see if a request is asynchronous.
         * 
         * http://www.phpriot.com/articles/detecting-ajax-requests
         * 
         * @return bool Is the request asynchronous.
         */
        public function isAjax()
        {
            return ($this->server->contains('X_REQUESTED_WITH') && strtolower($this->server->get('X_REQUESTED_WITH')) === 'xmlhttprequest');
        }
        
        /**
         * @TODO -> Implement these for easy unit testing.
         */
        public function setUri($uri) {}
        public function getUri() {}
    }
}