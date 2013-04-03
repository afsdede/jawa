<?php

namespace DocumentBundle\Controller;

use KernelBundle\Controller\Controller;

use DocumentBundle\Entity\Categoria;

/**
 * Description of UserController
 *
 * @author andre
 */
class CategoriaController extends Controller{
    
    public function insert(Categoria $categoria){
        
        $this->insertAction($categoria);
        
    }
    
}

?>
