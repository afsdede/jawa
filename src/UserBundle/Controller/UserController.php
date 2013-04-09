<?php

namespace UserBundle\Controller;

use KernelBundle\Controller\Controller;
use UserBundle\Entity\User;
use UserBundle\View\LoginView;
use UserBundle\View\IndexView;
use UserBundle\View\UsuarioNovoView;
use UserBundle\Controller\GroupController;
use UserBundle\Entity\Group;

use DocumentBundle\Controller\DocumentController;
use \DocumentBundle\Entity\Document;

use ClienteBundle\Controller\ClienteController;
use ClienteBundle\Entity\Cliente;

/**
 * Description of UserController
 *
 * @author andre
 */
class UserController extends Controller {

    public function novoAction(User $userOn, User $user) {

        $indexView = new UsuarioNovoView();
        
        if (isset($_POST['nome']) && isset($_POST['group']) && isset($_POST['login']) &&
                isset($_POST['senha']) && isset($_POST['email']) && $_POST['group'] != "") {
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
            return $template->render('/src/UserBundle/View/src/usuarioNovo.html', array('nome' => $userOn->getNome(), 'user' => $userOn, 'group' => $groupList));
        }
    }

    public function editarAction(User $userOn, User $user) {

        $indexView = new UsuarioNovoView();
        if (isset($_POST['nome']) && isset($_POST['group']) && isset($_POST['login'])
                && isset($_POST['email']) && $_POST['group'] != "") {
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
                return $template->render('/src/UserBundle/View/src/usuarioEditar.html', array('nome' => $userOn->getNome(), 'user' => $userOn, 'usr' => $user,'group' => $groupList));
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
                return $template->render('/src/UserBundle/View/src/usuarioDeletar.html', array('nome' => $userOn->getNome(), 'user' => $userOn, "usr" => $user));
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
        return $template->render('/src/UserBundle/View/src/usuarioListar.html', array('nome' => $userOn->getNome(), 'user' => $userOn, 'list' => $userList));
    }

    public function loginAction() {

        $loginView = new LoginView();

        $template = $loginView->getTemplate();
        return $template->render('/src/UserBundle/View/src/login.html', array());
    }

    public function indexAction(User $user) {

        $indexView = new IndexView();
        
        $cliController = new ClienteController();
        $cli = new Cliente();
        
        $cliList = $cliController->listAction($cli);
        foreach($cliList as $k => $v){
            $cli = new Cliente();
            $cliList[] = $cli->fetchEntity($v);
        }
        
        $doc = new Document();
        $docController = new DocumentController();
        $criterio = array(
            'doc_12_active' => 1
        );
        
        $listDoc = $docController->listAction($doc,"",$criterio,"DISTINCT cli_10_id");
        $listCli = array();
        foreach($listDoc as $kDoc => $vDoc){
            $listCli[] = $vDoc['cli_10_id'];
        }
        
        $critCli = array(
            'cli_10_id' => array(
                'operator' => 'IN (',
                'val'      => implode(",", $listCli).')'
            )
        );
        
        $cli = new Cliente();
        $cliController = new ClienteController();
        $cliList = $cliController->listAction($cli, "", $critCli);
        $cliRet = array();
        foreach($cliList as $kCli => $vCli){
            $cliObj = new Cliente();
            $cliObj->fetchEntity($vCli);
            $cliRet[] = $cliObj;
        }

        $template = $indexView->getTemplate();
        return $template->render('/src/UserBundle/View/src/index.html', array('nome' => $user->getNome(), 'user' => $user, 'cliList' => $cliRet));
    }

    public function indexClienteAction(User $user) {

        $indexView = new IndexView();
        
        $cliController = new ClienteController();
        $cli = new Cliente();
        
        $cliList = $cliController->listAction($cli, $_GET['cliId']);
        foreach($cliList as $k => $v){
            $cli = new Cliente();
            $cli->fetchEntity($v);
        }
        
        $doc = new Document();
        $docController = new DocumentController();
        $criterio = array(
            'doc_12_active' => 1,
            'cli_10_id' => $_GET['cliId']
        );
        
        $listDoc = $docController->listAction($doc,"",$criterio);
        $retDoc = array();
        foreach($listDoc as $kDoc => $vDoc){
            $docNew = new Document();
            $docNew->fetchEntity($vDoc);
            $fileSize = (filesize($docNew->getPath()))/1024;
            $fileSize = number_format($fileSize,1);
            $docNew->setFileSize($fileSize);
            $retDoc[] = $docNew;
        }

        $template = $indexView->getTemplate();
        return $template->render('/src/UserBundle/View/src/indexCliente.html', array('nome' => $user->getNome(), 'user' => $user, 'docList' => $retDoc, 'cli' => $cli));
    }

    public function loginVerifyAction(User $user) {

        $retUser = $this->listAction($user, "", $user->assocEntity());

        if ($user->fetchEntity($retUser[1]) instanceof User) {
            return $user;
        } else {
            return false;
        }
    }

}

?>