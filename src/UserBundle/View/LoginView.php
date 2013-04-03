<?php

namespace UserBundle\View;

use KernelBundle\View\View;

/**
 * Description of LoginView
 *
 * @author cred02
 */
class LoginView extends View{
    
    public function __construct($cache = "") {
        
        $this->setCache($cache);
        $this->setLocation(realpath(__DIR__)."/src/");
        
        $this->callTemplate($this->getLocation(), $this->getLocation());
        
        return $this;
        
    }
    
}

?>
