<?php

namespace UserBundle\Controller;

use KernelBundle\Controller\Controller;

use UserBundle\Entity\Group;

/**
 * Description of UserController
 *
 * @author andre
 */
class GroupController extends Controller{
    
    public function insert(Group $group){
        
        $this->insertAction($group);
        
    }
    
}

?>
