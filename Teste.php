<?php
require_once realpath(__DIR__.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'bootstrap.php');

use KernelEngine\KernelEngine;

use CarroBundle\Entity\Carro;
use UserBundle\Entity\User;
use UserBundle\Controller\UserController;

use KernelBundle\Model\Entity;

class Teste extends KernelEngine{
    
    function geral(){
        
        $a = new Carro();
        return $a->getInfo();
    }
    
}

$a = new Teste();

$usr = new User();

if (is_object($usr)){
    echo "É um objeto<br />";
    
    if ($usr instanceof Entity){
        echo "É uma instancia também de Entity";
    }
    
}else {
    echo "Não é um objeto<br />";
}

$usr->setNome("Giovanna Godoy");
$usr->setLogin("giovanna");
$usr->setSenha($usr->encriptPassword("giovanna"));
$usr->setEmail("godoy1996@hotmail.com");
$usr->setActive(1);

echo "<pre>";
var_dump($usr->assocEntity());
echo "</pre>";

$userController = new UserController();
$userController->insert($usr);

var_dump($a->geral());

?>