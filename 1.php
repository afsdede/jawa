<?php

require_once realpath(__DIR__.'/app/bootstrap.php');

//use src\CarroBundle\Entity\Carro;
use src\CarroBundle\Entity\CarroBundle;
//use src\CarroBundle\CarroBundle;

function __autoload($class) {
    var_dump($class);
    $class = str_replace('\\', '/', $class) . '.php';
    require_once($class);
}

?>
