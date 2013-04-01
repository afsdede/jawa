<?php

namespace ClienteBundle\Controller;

use KernelBundle\Controller\Controller;

use ClienteBundle\Entity\Permission;

/**
 * Description of UserController
 *
 * @author andre
 */
class PermissionController extends Controller{
    
    public function insert(Permission $permission){
        
        $this->insertAction($permission);
        
    }
    
}

?>
