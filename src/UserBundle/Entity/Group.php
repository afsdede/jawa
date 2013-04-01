<?php

namespace UserBundle\Entity;

use KernelBundle\Model\Entity;

/**
 * Class that maps the user
 *
 * @author andre
 */
class Group implements Entity{
    
    function __construct(){
        
        $this->setActive(1);
        
    }


    private $id;
    
    private $name;
    
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

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function assocEntity() {
        $fields = array(
            "grp_10_id"            => $this->getId(),
            "grp_30_nome"          => $this->getName(),
            "grp_12_active"        => $this->getActive()
        );
        
        return $fields;
    }

    public function fetchEntity($row) {
        
        $this->setId($row['grp_10_id']);
        $this->setName($row['grp_30_nome']);
        $this->setActive($row['grp_12_active']);
        
        return $this;
        
    }
    
    public function tableName(){
        return "usr_grp_group";
    }
    
    public function primaryKey(){
        return "grp_10_id";
    }

}

?>