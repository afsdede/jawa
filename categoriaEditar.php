<?php

require_once realpath(__DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'bootstrap.php');

use KernelEngine\KernelEngine;

use KernelBundle\Model\Entity;

use UserBundle\Entity\User;

use DocumentBundle\Entity\Categoria;
use DocumentBundle\Controller\CategoriaController;

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
$cat = new Categoria();

$catController = new CategoriaController();

if ($_GET['id'] > 0){
    $catList = $catController->listAction($cat, $_GET['id']);
    $cat->fetchEntity($catList[1]);
}

echo $catController->editarAction($a->fixObject($_SESSION['userLogin']), $cat);
?>