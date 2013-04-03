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



$usrController = new UserController();

echo $usrController->loginAction();
?>