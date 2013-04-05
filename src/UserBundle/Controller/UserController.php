<?php

namespace UserBundle\Controller;

use KernelBundle\Controller\Controller;

use UserBundle\Entity\User;
use UserBundle\View\LoginView;
use UserBundle\View\IndexView;

/**
 * Description of UserController
 *
 * @author andre
 */
class UserController extends Controller{
    
    public function insert(User $user){
        
        $this->insertAction($user);
        
    }
    
    public function loginAction (){
        
        $loginView = new LoginView();
        
        $template = $loginView->getTemplate();
        return $template->render('/src/UserBundle/View/src/login.html', array());
        
    }
    
    public function indexAction (User $user){
        
        $indexView = new IndexView();
        
        $template = $indexView->getTemplate();
        return $template->render('/src/UserBundle/View/src/index.html', array('nome' => $user->getNome()));
        
    }
    
    public function loginVerifyAction(User $user){

        $retUser = $this->listAction($user, "", $user->assocEntity());
        
        if ($retUser[1] == $user){
            return $retUser[1];
        }else {
            return false;
        }
        
    }
    
}

?>