<?php

require_once realpath(__DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'bootstrap.php');

use KernelEngine\KernelEngine;
use UserBundle\Entity\Group;
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
$user = new User();

$usrController = new UserController();

if ($_GET['id'] > 0){
    $userList = $usrController->listAction($user, $_GET['id']);
    $user->fetchEntity($userList[1]);
}

echo $usrController->deletarAction($a->fixObject($_SESSION['userLogin']), $user);
?>