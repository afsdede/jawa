<?php

namespace ClienteBundle\Entity;

use KernelBundle\Model\Entity;

/**
 * Class that maps the client
 *
 * @author andre
 */
class Permission implements Entity{
    
    private $id;
    
    private $user;
    
    private $cliente;
    
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

    public function getCliente() {
        return $this->cliente;
    }

    public function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    public function assocEntity() {
        $fields = array(
            "prm_10_id"            => $this->getId(),
            "usr_10_id"          => $this->getUser(),
            "cli_10_id"          => $this->getCliente(),
        );
        
        return $fields;
    }

    public function fetchEntity($row) {
        
        $this->setId($row['prm_10_id']);
        $this->setUser($row['usr_10_id']);
        $this->setCliente($row['cli_10_id']);
        
        return $this;
        
    }

    public function tableName(){
        return "cli_prm_permission";
    }
    
    public function primaryKey(){
        return "prm_10_id";
    }

}

?>