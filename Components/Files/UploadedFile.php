<?php

namespace Feather\Components\Files
{
    class UploadedFile
    {
        public $filename;
        public $tmpName;
        public $mimeType;
        public $size;
        public $error;
        
        public function __construct(array $upload)
        {
            $this->filename = basename($upload['name']);
            $this->tmpName = $upload['tmp_name'];
            $this->mimeType = $upload['type'];
            $this->size = $upload['size'];
            $this->error = $upload['error'];
            
            
        }
        
        public function checkIfExists($path)
        {
            if (DS !== substr($path, -1)) $path = $path . DS;
            
            return file_exists($path . $this->filename);
        }
    }
}