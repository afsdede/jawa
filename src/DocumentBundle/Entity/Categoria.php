<?php

namespace DocumentBundle\Entity;

use KernelBundle\Model\Entity;

/**
 * Class that maps the client
 *
 * @author andre
 */
class Categoria implements Entity{
    
    private $id;
    
    private $parent;
    
    private $name;
    
    private $image;
    
    private $active;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getParent() {
        return $this->parent;
    }

    public function setParent($parent) {
        $this->parent = $parent;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
    
    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function assocEntity() {
        $fields = array(
            "cat_10_id"          => $this->getId(),
            "cat_10_parent"      => $this->getParent(),
            "cat_30_nome"        => $this->getName(),
            "cat_30_image"        => $this->getImage(),
            "cat_12_active"      => $this->getActive(),
        );
        
        return $fields;
    }

    public function fetchEntity($row) {
        
        $this->setId($row['cat_10_id']);
        $this->setParent(utf8_encode($row['cat_10_parent']));
        $this->setName(utf8_encode($row['cat_30_nome']));
        $this->setImage(utf8_encode($row['cat_30_image']));
        $this->setActive($row['cat_12_active']);
        
        return $this;
        
    }

    public function tableName(){
        return "doc_cat_categoria";
    }
    
    public function primaryKey(){
        return "cat_10_id";
    }

}

?>