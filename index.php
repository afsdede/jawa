<?php

require_once realpath(__DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'bootstrap.php');

use KernelEngine\KernelEngine;
use UserBundle\Entity\User;
use UserBundle\Controller\UserController;
use KernelBundle\Model\Entity;

class mainExecution extends KernelEngine {

    function __construct() {
        parent::__construct();


        if (!isset($_SESSION['userLogin'])) {
            header('Location: login.php');
        }
    }

    function fixObject(&$object) {
        if (!is_object($object) && gettype($object) == 'object')
            return ($object = unserialize(serialize($object)));
        return $object;
    }

}

$a = new mainExecution();
$usrController = new UserController();

if (!isset($_GET) || count($_GET) == 0){

    echo $usrController->indexAction($a->fixObject($_SESSION['userLogin']));

}else {
    
    if (isset($_GET['cliId'])){
        
        echo $usrController->indexClienteAction($a->fixObject($_SESSION['userLogin']));
        
    }
    
}
?>