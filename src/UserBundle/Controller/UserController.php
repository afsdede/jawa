<?php

namespace UserBundle\Controller;

use KernelBundle\Controller\Controller;

use UserBundle\Entity\User;
use UserBundle\View\LoginView;

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
        return $template->render('/src/UserBundle/View/src/login.html', array('name' => 'Fabien'));
        
    }
    
}

?>
