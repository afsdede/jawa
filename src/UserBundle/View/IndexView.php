<?php

namespace UserBundle\View;

use KernelBundle\View\View;

/**
 * Description of LoginView
 *
 * @author cred02
 */
class IndexView extends View{
    
    public function __construct($cache = "") {
        
        $this->setCache($cache);
        $this->setLocation(realpath(__DIR__)."/../../../");
        //$this->setLocation(realpath(__DIR__)."/../../../app/view/");
        
        $this->callTemplate($this->getLocation());
        
        return $this;
        
    }
    
}

?>
