<?php

require_once realpath(__DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'bootstrap.php');

use KernelEngine\KernelEngine;
use KernelBundle\Model\Entity;

use DocumentBundle\Controller\DocumentController;
use DocumentBundle\Entity\Document;
use DocumentBundle\Controller\CategoriaController;
use DocumentBundle\Entity\Categoria;

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
$docController = new DocumentController();
$catController = new CategoriaController();
$category = new Categoria();

$catList = $catController->listAction($category);

if (isset($_GET['catId'])){
    echo $docController->listarDocumentoCategoriaAnoClienteAction($a->fixObject($_SESSION['userLogin']), $_GET['catId'], $_GET['ano'], $_GET['cliId']);
}else {
    echo $docController->listarDocumentoCategoriaAnoClienteAction($a->fixObject($_SESSION['userLogin']));
}
?>