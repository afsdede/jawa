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

if (is_object($usr)){
    echo "É um objeto<br />";
    
    if ($usr instanceof Entity){
        echo "É uma instancia também de Entity";
    }
    
}else {
    echo "Não é um objeto<br />";
}

$loader = new Twig_Loader_Filesystem(APP_ROOT.DS.'view');
$twig = new Twig_Environment($loader, array(
    'cache' => APP_ROOT.DS.'cache'
));

echo $twig->render('main.html', array('name' => 'Fabien'));

?>