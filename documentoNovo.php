<?php

require_once realpath(__DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'bootstrap.php');

use KernelEngine\KernelEngine;
use KernelBundle\Model\Entity;

use DocumentBundle\Entity\Categoria;
use DocumentBundle\Entity\Document;
use DocumentBundle\Controller\CategoriaController;
use DocumentBundle\Controller\DocumentController;

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
$doc = new Document();

$docController = new DocumentController();
echo $docController->novoAction($a->fixObject($_SESSION['userLogin']), $doc);
?>