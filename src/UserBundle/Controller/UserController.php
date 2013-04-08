<?php

namespace UserBundle\Controller;

use KernelBundle\Controller\Controller;
use UserBundle\Entity\User;
use UserBundle\View\LoginView;
use UserBundle\View\IndexView;
use UserBundle\View\UsuarioNovoView;
use UserBundle\Controller\GroupController;
use UserBundle\Entity\Group;

/**
 * Description of UserController
 *
 * @author andre
 */
class UserController extends Controller {

    public function novoAction(User $userOn, User $user) {

        $indexView = new UsuarioNovoView();

        if (isset($_POST['nome']) && isset($_POST['group']) && isset($_POST['login']) &&
                isset($_POST['senha']) && isset($_POST['email'])) {
            $user->setType(2);
            $user->setGroup($_POST['group']);
            $user->setNome($_POST['nome']);
            $user->setLogin($_POST['login']);
            $user->setSenha($user->encriptPassword($_POST['senha']));
            $user->setEmail($_POST['email']);
            $user->setActive($_POST['active']);
            
            $userNovo = new User();
            $userVer = $this->listAction($userNovo, "", array(
                "usr_30_username" => $_POST['login']
            ));
            
            if (count($userVer) > 0){
                header('Location: usuarioListar.php');
            }
            $this->insertAction($user);
            header('Location: usuarioListar.php');
        } else {

            $groupController = new GroupController();
            $groupList = array();
            $group = new Group();
            foreach ($groupController->listAction($group) as $k => $v) {
                $group = new Group();
                $groupList[] = $group->fetchEntity($v);
            }

            $template = $indexView->getTemplate();
            return $template->render('/src/UserBundle/View/src/usuarioNovo.html', array('nome' => $user->getNome(), 'group' => $groupList));
        }
    }

    public function editarAction(User $userOn, User $user) {

        $indexView = new UsuarioNovoView();
        if (isset($_POST['nome']) && isset($_POST['group']) && isset($_POST['login'])
                && isset($_POST['email'])) {
            $user->setId($_POST['id']);
            $user->setType(2);
            $user->setGroup($_POST['group']);
            $user->setNome($_POST['nome']);
            $user->setEmail($_POST['email']);
            $user->setActive($_POST['active']);
            
            $userNovo = new User();
            $userVer = $this->listAction($userNovo, "", array(
                "usr_30_username" => $_POST['login']
            ));
            if (count($userVer) == 0){
                $user->setLogin($_POST['login']);
            }
            if ($_POST['senha'] != ""){
                $user->setSenha($user->encriptPassword($_POST['senha']));
            }
            
            $this->editAction($user);
            header('Location: usuarioListar.php');
        } else {
            
            if (!$user->getId()) {
                
                header('Location: usuarioListar.php');
                
            } else {

                $groupController = new GroupController();
                $groupList = array();
                $group = new Group();
                foreach ($groupController->listAction($group) as $k => $v) {
                    $group = new Group();
                    $groupList[] = $group->fetchEntity($v);
                }

                $template = $indexView->getTemplate();
                return $template->render('/src/UserBundle/View/src/usuarioEditar.html', array('nome' => $user->getNome(), 'user' => $user,'group' => $groupList));
            }
        }
    }
    
    public function deletarAction(User $userOn, User $user) {

        $indexView = new UsuarioNovoView();

        if (isset($_POST['id'])) {
            $user->setId($_POST['id']);
            $this->deleteAction($user);
            header('Location: usuarioListar.php');
        } else {

            if (!$user->getId()) {
                header('Location: usuarioListar.php');
            } else {
                $template = $indexView->getTemplate();
                return $template->render('/src/UserBundle/View/src/usuarioDeletar.html', array('nome' => $user->getNome(), "user" => $user));
            }
        }
    }

    public function listarAction(User $userOn, User $user) {

        $indexView = new UsuarioNovoView();
        $userList = array();
        $crit = array(
            "usr_12_type" => 2
        );

        $grpController = new GroupController();
        foreach ($this->listAction($user, "", $crit) as $k => $v) {
            $usr = new User();
            $grp = new Group();
            $usr->fetchEntity($v);
            $grpNome = $grpController->listAction($grp, $usr->getGroup());
            $usr->setGroup(utf8_encode($grpNome[1]['grp_30_nome']));
            $userList[] = $usr;
        }

        $template = $indexView->getTemplate();
        return $template->render('/src/UserBundle/View/src/usuarioListar.html', array('nome' => $user->getNome(), 'list' => $userList));
    }

    public function loginAction() {

        $loginView = new LoginView();

        $template = $loginView->getTemplate();
        return $template->render('/src/UserBundle/View/src/login.html', array());
    }

    public function indexAction(User $user) {

        $indexView = new IndexView();

        $template = $indexView->getTemplate();
        return $template->render('/src/UserBundle/View/src/index.html', array('nome' => $user->getNome()));
    }

    public function loginVerifyAction(User $user) {

        $retUser = $this->listAction($user, "", $user->assocEntity());

        if ($retUser[1] == $user) {
            return $retUser[1];
        } else {
            return false;
        }
    }

}

?>