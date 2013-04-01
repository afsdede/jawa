<?php

namespace KernelBundle\Util;

/**
 * Classe utilizada para controlar os upload de arquivos
 *
 * @author afsdede
 */
class Upload {
    
    private $type;
    
    private $path;
    
    private $file;
    
    function __construct($path, $file, $fileName, $type = array()) {
        $this->setPath($path);
        $this->setFile($file);
        $this->setType($type);
    }
    
    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile($file) {
        $this->file = $file;
    }

    public function upload(){
        
        if (!is_dir($this->getPath())){
            mkdir($this->getPath(), 0777, true);
        }
        
        if (!is_writable($this->getPath()) || !is_readable($this->getPath())){
            chmod($this->getPath(), 0777);
        }
        
    }
    
}
