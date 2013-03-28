<?php

namespace CarroBundle\Entity;

class Carro{
    
        
    private $modelo;
    
    public function __construct() {
        return $this;
    }

        public function getNameSpace(){
        return __NAMESPACE__;
    }
    
    public function getInfo(){
        echo "<pre>";
        print_r("Diretorio: ".__DIR__);
        echo "<br />";
        print_r("Namespace: ".__NAMESPACE__);
        echo "<br />";
        print_r("Classe: ". __CLASS__);
        echo "<br />";
        print_r("Metodo: ". __METHOD__);
        echo "</pre>";
    }

    public function getModelo() {
        return $this->modelo;
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
    }
    
}
?>
