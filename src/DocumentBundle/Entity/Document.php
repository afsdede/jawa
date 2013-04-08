<?php

namespace DocumentBundle\Entity;

use KernelBundle\Model\Entity;

/**
 * Class that maps the client
 *
 * @author andre
 */
class Document implements Entity{
    
    function __construct(){
        
        $this->setActive(1);
        
    }

    private $id;
    
    private $client;
    
    private $category;
    
    private $name;
    
    private $path;
    
    private $archive;
    
    private $active;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getClient() {
        return $this->client;
    }

    public function setClient($client) {
        $this->client = $client;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
    }
    
    public function getArchive() {
        return $this->archive;
    }

    public function setArchive($archive) {
        $this->archive = $archive;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function assocEntity() {
        $fields = array(
            "doc_10_id"            => $this->getId(),
            "cli_10_id"            => $this->getClient(),
            "cat_10_id"            => $this->getCategory(),
            "doc_30_path"          => $this->getPath(),
            "doc_30_nome"          => $this->getName(),
            "doc_12_active"        => $this->getActive()
        );
        
        return $fields;
    }

    public function fetchEntity($row) {
        
        $this->setId($row['doc_10_id']);
        $this->setClient($row['cli_10_id']);
        $this->setCategory($row['cat_10_id']);
        $this->setPath($row['doc_30_path']);
        $this->setName(utf8_encode($row['doc_30_nome']));
        $this->setActive($row['doc_12_active']);
        
        return $this;
        
    }

    public function tableName(){
        return "doc_doc_document";
    }
    
    public function primaryKey(){
        return "doc_10_id";
    }

}

?>