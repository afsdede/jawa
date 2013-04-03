<?php

namespace DocumentBundle\Controller;

use KernelBundle\Controller\Controller;

use DocumentBundle\Entity\Document;

/**
 * Description of UserController
 *
 * @author andre
 */
class DocumentController extends Controller{
    
    public function insert(Document $document){
        
        $this->insertAction($document);
        
    }
    
}

?>
