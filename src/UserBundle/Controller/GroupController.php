<?php

namespace UserBundle\Controller;

use KernelBundle\Controller\Controller;
use UserBundle\Entity\Group;
use UserBundle\Entity\User;
use UserBundle\View\GroupNovoView;

/**
 * Description of UserController
 *
 * @author andre
 */
class GroupController extends Controller {

    public function novoAction(User $user, Group $group) {

        $indexView = new GroupNovoView();

        if (isset($_POST['name']) && $_POST['name'] != "") {
            $group->setName($_POST['name']);
            $group->setActive($_POST['active']);
            $this->insertAction($group);
            header('Location: groupListar.php');
        } else {

            $template = $indexView->getTemplate();
            return $template->render('/src/UserBundle/View/src/groupNovo.html', array('user' => $user, 'nome' => $user->getNome()));
        }
    }

    public function editarAction(User $user, Group $group) {

        $indexView = new GroupNovoView();

        if (isset($_POST['name']) && $_POST['name'] != "" && isset($_POST['id'])) {
            $group->setId($_POST['id']);
            $group->setName($_POST['name']);
            $group->setActive($_POST['active']);
            $this->editAction($group);
            header('Location: groupListar.php');
        } else {

            if (!$group->getId()) {
                header('Location: groupListar.php');
            } else {
                $template = $indexView->getTemplate();
                return $template->render('/src/UserBundle/View/src/groupEditar.html', array('nome' => $user->getNome(), 'user' => $user, "group" => $group));
            }
        }
    }

    public function deletarAction(User $user, Group $group) {

        $indexView = new GroupNovoView();

        if (isset($_POST['id'])) {
            $group->setId($_POST['id']);
            $this->deleteAction($group);
            header('Location: groupListar.php');
        } else {

            if (!$group->getId()) {
                header('Location: groupListar.php');
            } else {
                $template = $indexView->getTemplate();
                return $template->render('/src/UserBundle/View/src/groupDeletar.html', array('nome' => $user->getNome(), 'user' => $user, "group" => $group));
            }
        }
    }

    public function listarAction(User $user, Group $group) {

        $indexView = new GroupNovoView();
        $groupList = array();

        foreach ($this->listAction($group) as $k => $v) {
            $grp = new Group();
            $groupList[] = $grp->fetchEntity($v);
        }

        $template = $indexView->getTemplate();
        return $template->render('/src/UserBundle/View/src/groupListar.html', array('nome' => $user->getNome(), 'user' => $user, 'list' => $groupList));
    }

}

?>