<?php

require_once realpath(__DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'bootstrap.php');

use KernelEngine\KernelEngine;
use UserBundle\Entity\Group;
use UserBundle\Entity\User;
use UserBundle\Controller\GroupController;
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
$group = new Group();

$grpController = new GroupController();

if ($_GET['id'] > 0){
    $groupList = $grpController->listAction($group, $_GET['id']);
    $group->fetchEntity($groupList[1]);
}

echo $grpController->editarAction($a->fixObject($_SESSION['userLogin']), $group);
?>