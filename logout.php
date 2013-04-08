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
        
        if (!isset($_SESSION['userLogin'])){
        
            if (isset($_POST['user']) && isset($_POST['password'])){

                if (trim($_POST['user']) != ""){

                    if (trim($_POST['password']) != ""){

                        $user->setLogin(trim($_POST['user']));
                        $user->setSenha($user->encriptPassword(trim($_POST['password'])));
                        $user->setType("");

                        $usrController = new UserController();
                        $userLogin = $usrController->loginVerifyAction($user);

                        if($userLogin){
                            $_SESSION['userLogin'] = $userLogin;
                            header('Location: index.php');
                        }

                    }else {
                        echo "Favor digitar a senha";
                    }
                }else {
                    echo "Favor digitar o usuário";
                }

            }
        
        }else {
            header('Location: index.php');
        }
        
    }
    
    
}

$a = new mainExecution();

$usrController = new UserController();

echo $usrController->loginAction();
?>