<?php

namespace UserBundle\Controller;

use KernelBundle\Controller\Controller;

use UserBundle\Entity\User;

/**
 * Description of UserController
 *
 * @author andre
 */
class UserController extends Controller{
    
    public function insert(User $user){
        
        $this->insertAction($user);
        
    }
    
}

?>
