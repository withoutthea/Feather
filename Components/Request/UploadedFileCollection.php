<?php

namespace Feather\Components\Request
{
    class UploadedFileCollection extends \Feather\Components\Collections\Collection
    {
        public function __construct(array $files)
        {
            $uploadedFiles = array();
            
            foreach ($files as $file)
            {
                $uploadedFiles[] = new \Feather\Components\Files\UploadedFile($file);
            }
            
            parent::__construct($uploadedFiles);
        }
    }
}