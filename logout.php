<?php
require_once realpath(__DIR__.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'bootstrap.php');

use KernelEngine\KernelEngine;

use UserBundle\Entity\User;
use UserBundle\Controller\UserController;

use KernelBundle\Model\Entity;

class mainExecution extends KernelEngine{
    
    function __construct() {
        parent::__construct();
        
        $user = new User();
        
        session_destroy();
        header('Location: login.php');
        
    }
    
    
}

$a = new mainExecution();
?>