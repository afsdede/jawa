<?php

require_once realpath(__DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'bootstrap.php');

use KernelEngine\KernelEngine;
use ClienteBundle\Entity\Cliente;
use UserBundle\Entity\User;
use ClienteBundle\Controller\ClienteController;
use KernelBundle\Model\Entity;

class mainExecution extends KernelEngine {

    function __construct() {
        parent::__construct();

        $user = new User();

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
$cli = new Cliente();

$cliController = new ClienteController();

if ($_GET['id'] > 0){
    $cliList = $cliController->listAction($cli, $_GET['id']);
    $cli->fetchEntity($cliList[1]);
}

echo $cliController->deletarAction($a->fixObject($_SESSION['userLogin']), $cli);
?>