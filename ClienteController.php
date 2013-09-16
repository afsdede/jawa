<?php

namespace ClienteBundle\Controller;

use KernelBundle\Controller\Controller;

use UserBundle\Entity\User;

use ClienteBundle\Entity\Cliente;
use ClienteBundle\View\ClienteView;

/**
 * Description of UserController
 *
 * @author andre
 */
class ClienteController extends Controller{
    
    public function novoAction(User $user, Cliente $cliente) {

        $indexView = new ClienteView();
        
        if (isset($_POST['name']) && $_POST['name'] != "") {
            $cliente->setName($_POST['name']);
            $cliente->setDesc($_POST['desc']);
            $cliente->setActive($_POST['active']);
            $this->insertAction($cliente);
            header('Location: clienteListar.php');
        } else {

            $template = $indexView->getTemplate();
            return $template->render('/src/ClienteBundle/View/src/clienteNovo.html', array('nome' => $user->getNome(), 'user' => $user));
        }
    }
    
    public function listarAction(User $user, Cliente $cli) {

        $indexView = new ClienteView();
        $cliList = array();

        foreach ($this->listAction($cli) as $k => $v) {
            $cliente = new Cliente();
            $cliList[] = $cliente->fetchEntity($v);
        }

        $template = $indexView->getTemplate();
        return $template->render('/src/ClienteBundle/View/src/clienteListar.html', array('nome' => $user->getNome(), 'user' => $user, 'list' => $cliList));
    }
    
    public function editarAction(User $user, Cliente $cli) {

        $indexView = new ClienteView();

        if (isset($_POST['name']) && $_POST['name'] != "" && isset($_POST['id'])) {
            $cli->setId($_POST['id']);
            $cli->setName($_POST['name']);
            $cli->setDesc($_POST['desc']);
            $cli->setActive($_POST['active']);
            $this->editAction($cli);
            header('Location: clienteListar.php');
        } else {

            if (!$cli->getId()) {
                header('Location: clienteListar.php');
            } else {
                $template = $indexView->getTemplate();
                return $template->render('/src/ClienteBundle/View/src/clienteEditar.html', array('nome' => $user->getNome(), 'user' => $user, "cli" => $cli));
            }
        }
    }
    
    public function deletarAction(User $user, Cliente $cli) {

        $indexView = new ClienteView();

        if (isset($_POST['id'])) {
            $cli->setId($_POST['id']);
            $this->deleteAction($cli);
            header('Location: clienteListar.php');
        } else {

            if (!$cli->getId()) {
                header('Location: groupListar.php');
            } else {
                $template = $indexView->getTemplate();
                return $template->render('/src/ClienteBundle/View/src/clienteDeletar.html', array('nome' => $user->getNome(), 'user' => $user, "cli" => $cli));
            }
        }
    }
    
}

?>