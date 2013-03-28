<?php
require_once realpath(__DIR__.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'bootstrap.php');

use CarroBundle\Entity\Carro;

class Teste extends KernelEngine{
    
    function geral(){
        
        $a = new Carro();
        return $a->getInfo();
    }
    
}

$a = new Teste();

var_dump($a->geral());

?>