<?php

namespace DocumentBundle\Entity;

use KernelBundle\Model\Entity;

/**
 * Class that maps the client
 *
 * @author andre
 */
class Permission implements Entity{
    
    private $id;
    
    private $user;
    
    private $document;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getDocument() {
        return $this->document;
    }

    public function setDocument($document) {
        $this->document = $document;
    }

    public function assocEntity() {
        $fields = array(
            "prm_10_id"          => $this->getId(),
            "usr_10_id"          => $this->getUser(),
            "doc_10_id"          => $this->getDocument(),
        );
        
        return $fields;
    }

    public function fetchEntity($row) {
        
        $this->setId($row['prm_10_id']);
        $this->setUser($row['usr_10_id']);
        $this->setDocument($row['doc_10_id']);
        
        return $this;
        
    }

    public function tableName(){
        return "doc_prm_permission";
    }
    
    public function primaryKey(){
        return "prm_10_id";
    }

}

?>