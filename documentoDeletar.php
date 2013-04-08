<?php

require_once realpath(__DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'bootstrap.php');

use KernelEngine\KernelEngine;
use DocumentBundle\Entity\Document;
use UserBundle\Entity\User;
use DocumentBundle\Controller\DocumentController;
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
$doc = new Document();

$docController = new DocumentController();

if ($_GET['id'] > 0){
    $docList = $docController->listAction($doc, $_GET['id']);
    $doc->fetchEntity($docList[1]);
}

echo $docController->deletarAction($a->fixObject($_SESSION['userLogin']), $doc);
?>