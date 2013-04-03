<?php

namespace ClienteBundle\Entity;

use KernelBundle\Model\Entity;

/**
 * Class that maps the client
 *
 * @author andre
 */
class Cliente implements Entity{
    
    function __construct(){
        
        $this->setActive(1);
        
    }

    private $id;
    
    private $name;
    
    private $desc;
    
    private $active;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function setDesc($desc) {
        $this->desc = $desc;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function assocEntity() {
        $fields = array(
            "cli_10_id"            => $this->getId(),
            "cli_30_nome"          => $this->getName(),
            "cli_35_desc"          => $this->getDesc(),
            "cli_12_active"        => $this->getActive()
        );
        
        return $fields;
    }

    public function fetchEntity($row) {
        
        $this->setId($row['usr_10_id']);
        $this->setName($row['cli_30_nome']);
        $this->setDesc($row['cli_35_email']);
        $this->setActive($row['cli_12_active']);
        
        return $this;
        
    }

    public function tableName(){
        return "cli_cli_cliente";
    }
    
    public function primaryKey(){
        return "cli_10_id";
    }

}

?>