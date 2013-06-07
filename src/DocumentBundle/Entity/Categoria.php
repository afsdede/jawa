<?php

namespace DocumentBundle\Entity;

use KernelBundle\Model\Entity;
use DocumentBundle\Controller\CategoriaController;

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
    
    private $file;
    
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
    
    public function getFile() {
        return $this->file;
    }

    public function setFile($file) {
        $this->file = $file;
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
    
    public function getUploadRootDir(){
        return MAIN_ROOT."/app/upload/categoria/";
    }
    
    public function getWebImage(){
        
        if (is_file($this->getUploadRootDir(). $this->getImage())){
            return "app/upload/categoria/". $this->getImage();
        }else {
            return "app/upload/images/no-photo.png";
        }
    }
    
    public function hasChild($id){
        $catController = new CategoriaController();
        
        $crit = array(
            'cat_10_parent' => $id
        );
        $catList = $catController->listAction($this,"",$crit);
        
        if (count($catList) > 0){
            return true;
        }else {
            return false;
        }
    }

}

?>