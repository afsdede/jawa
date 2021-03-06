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
    
    private $fileSize;
    
    private $archive;
    
    private $date;
    
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
    
    public function getFileSize() {
        return $this->fileSize;
    }

    public function setFileSize($fileSize) {
        $this->fileSize = $fileSize;
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
    
    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }
        
    public function getImage(){
        $ext = explode(".", $this->getPath());
        $extension = $ext[count($ext)-1];
        
        if ($extension == "doc" || $extension == "docx"){
            $imageRep = "doc.png";
        }elseif ($extension == "ppt" || $extension == "pptx") {
            $imageRep = "ppt.png";
        }elseif ($extension == "png" || $extension == "gif" || $extension == "jpg" || $extension == "jpeg" || $extension == "bmp") {
            $imageRep = "image.png";
        }elseif ($extension == "zip" || $extension == "rar") {
            $imageRep = "image.png";
        }elseif ($extension == "pdf") {
            $imageRep = "pdf.png";
        }else {
            $imageRep = "unknown.png";
        }
        
        return "app/view/images/icones/".$imageRep;
        
    }

    public function assocEntity() {
        $fields = array(
            "doc_10_id"            => $this->getId(),
            "cli_10_id"            => $this->getClient(),
            "cat_10_id"            => $this->getCategory(),
            "doc_30_path"          => $this->getPath(),
            "doc_30_nome"          => $this->getName(),
            "doc_10_data"          => $this->getDate(),
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
        $this->setDate($row['doc_10_data']);
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