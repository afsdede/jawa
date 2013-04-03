<?php

namespace ClienteBundle\Controller;

use KernelBundle\Controller\Controller;

use ClienteBundle\Entity\Cliente;

/**
 * Description of UserController
 *
 * @author andre
 */
class ClienteController extends Controller{
    
    public function insert(Cliente $cliente){
        
        $this->insertAction($cliente);
        
    }
    
}

?>
