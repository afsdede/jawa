<?php

namespace KernelBundle\View;

/**
 * Classe para manipulaçao do View
 *
 * @author afsdede
 */
class View {
    
    private $location;
    
    private $cache;
    
    private $template;
    
    public function getLocation() {
        return $this->location;
    }

    public function setLocation($location) {
        $this->location = $location;
    }

    public function getCache() {
        return $this->cache;
    }

    public function setCache($cache) {
        $this->cache = $cache;
    }
    
    public function getTemplate() {
        return $this->template;
    }

    public function setTemplate($template) {
        $this->template = $template;
    }

    public function callTemplate($location, $cache = "") {
        
        $this->setLocation($location);
        $this->setCache($cache);
        
        $cacheDir = array();
        
        $loader = new \Twig_Loader_Filesystem($this->getLocation());
        if ($this->getCache() != ""){
            $cacheDir['cache'] = $this->getCache();
        }
        
        $twig = new \Twig_Environment($loader, $cacheDir);
        
        $this->setTemplate($twig);
    }
    
}

?>
