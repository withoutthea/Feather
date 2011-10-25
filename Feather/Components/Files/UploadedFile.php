<?php

namespace Feather\Components\Files
{
    class UploadedFile implements \Feather\App\Domain\IObject
    {
        public $filename;
        public $fullname;
        public $tmpName;
        public $mimeType;
        public $size;
        public $error;
        
        public function __construct(array $upload)
        {
            if (!ini_get('file_uploads'))
            {
                // @TODO -> Throw exception.
            }
            
            if (!file_exists($upload['tmp_name']))
            {
                // @TODO -> Throw exception.
            }
            
            $this->filename = basename($upload['name']);
            $this->tmpName = $upload['tmp_name'];
            $this->mimeType = $upload['type'];
            $this->size = $upload['size'];
            $this->error = $upload['error'];
            
            if ($this->error != 0)
            {
                // @TODO -> Implement error handling on upload.
            }
        }
        
        public function checkIfExists($path, $newName = null)
        {
            if (DS !== substr($path, -1)) $path = $path . DS;
            
            $fullname = $path . ($newName == null ? $this->filename : $newName);
            
            return file_exists($fullname);
        }
        
        public function move($dest, $newName = null)
        {
            // make sure the destination is valid
            if (!is_dir($dest))
            {
                // @TODO -> Throw exception.
            }
            
            // make sure a file with the same name isn't there already
            if ($this->checkIfExists($dest, $newName))
            {
                // @TODO -> Throw exception.
            }
            
            $fullname = $dest . ($newName == null ? $this->filename : $newName);
            
            if (!move_uploaded_file($this->tmpName, $fullname))
            {
                // @TODO -> Throw exception.
            }
            
            $this->fullname = $fullname;
            
            return true;
        }
        
        public function __toString()
        {
            return $this->filename;
        }
    }
}