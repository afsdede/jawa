<?php

namespace DocumentBundle\Controller;

use KernelBundle\Controller\Controller;
use KernelBundle\Util\SimpleImage;
use UserBundle\Entity\User;
use DocumentBundle\Entity\Categoria;
use DocumentBundle\View\CategoriaView;

/**
 * Description of UserController
 *
 * @author andre
 */
class CategoriaController extends Controller {

    public function novoAction(User $user, Categoria $cat) {

        $indexView = new CategoriaView();

        if (isset($_POST['name']) && $_POST['name'] != "") {
            $cat->setName($_POST['name']);
            $cat->setParent($_POST['parent']);
            $cat->setActive($_POST['active']);
            $cat->setFile($_FILES['image']);
            
            $this->uploadImageAction($cat);
            $this->insertAction($cat);
            
            header('Location: categoriaListar.php');
        } else {

            $catList = array();
            $categoria = new Categoria();
            foreach ($this->listAction($categoria) as $k => $v) {
                $categoria = new Categoria();
                $catList[] = $categoria->fetchEntity($v);
            }

            $template = $indexView->getTemplate();
            return $template->render('/src/DocumentBundle/View/src/categoriaNovo.html', array('nome' => $user->getNome(), 'user' => $user, 'cat' => $catList));
        }
    }

    public function listarAction(User $user, Categoria $cat) {

        $indexView = new CategoriaView();
        $catList = array();

        $catController = new CategoriaController();
        foreach ($this->listAction($cat) as $k => $v) {
            $categoria = new Categoria();
            $categoria->fetchEntity($v);
            if ($categoria->getParent() != 0) {
                $catNome = $catController->listAction($cat, $categoria->getParent());
                $categoria->setParent(utf8_encode($catNome[1]['cat_30_nome']));
            } else {
                $categoria->setParent("Principal");
            }
            $catList[] = $categoria;
        }

        $template = $indexView->getTemplate();
        return $template->render('/src/DocumentBundle/View/src/categoriaListar.html', array('nome' => $user->getNome(), 'user' => $user, 'list' => $catList));
    }

    public function editarAction(User $user, Categoria $cat) {

        $indexView = new CategoriaView();

        if (isset($_POST['name']) && $_POST['name'] != "" && isset($_POST['id'])) {
            $cat->setId($_POST['id']);
            $cat->setName($_POST['name']);
            $cat->setParent($_POST['parent']);
            $cat->setActive($_POST['active']);
            var_dump($_FILES);
            $cat->setFile($_FILES['image']);
            
            $this->uploadImageAction($cat);
            $this->editAction($cat);
            header('Location: categoriaListar.php');
        } else {

            if (!$cat->getId()) {
                header('Location: categoriaListar.php');
            } else {

                $catList = array();
                $categoria = new Categoria();
                foreach ($this->listAction($categoria) as $k => $v) {
                    $categoria = new Categoria();
                    $catList[] = $categoria->fetchEntity($v);
                }

                $template = $indexView->getTemplate();
                return $template->render('/src/DocumentBundle/View/src/categoriaEditar.html', array('nome' => $user->getNome(), 'user' => $user, "cat" => $cat, 'catList' => $catList));
            }
        }
    }

    public function deletarAction(User $user, Categoria $cat) {

        $indexView = new CategoriaView();

        if (isset($_POST['id'])) {
            $cat->setId($_POST['id']);
            $this->deleteAction($cat);
            header('Location: categoriaListar.php');
        } else {

            if (!$cat->getId()) {
                header('Location: categoriaListar.php');
            } else {
                $template = $indexView->getTemplate();
                return $template->render('/src/DocumentBundle/View/src/categoriaDeletar.html', array('nome' => $user->getNome(), 'user' => $user, "cat" => $cat));
            }
        }
    }

    public function uploadImageAction(Categoria $categoria) {

        $imgEdit = new SimpleImage();

        if ($categoria->getImage() != "") {
            if (is_file($categoria->getUploadRootDir().$categoria->getImage())){
                unlink($categoria->getUploadRootDir().$categoria->getImage());
            }
        }

        $imageFile = $categoria->getFile();

        $categoria->setImage(uniqid() . "-" . str_replace(" ", "-", $imageFile["name"]));
        move_uploaded_file($imageFile['tmp_name'], $categoria->getUploadRootDir() . $categoria->getImage());

        $imgEdit->load($categoria->getUploadRootDir() . $categoria->getImage());
        $imgEdit->adjustImage(300, 300);
        $imgEdit->save($categoria->getUploadRootDir() . $categoria->getImage());
        
        return true;
    }

}

?>