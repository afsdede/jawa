<?php

namespace DocumentBundle\Controller;

use KernelBundle\Controller\Controller;
use KernelBundle\Util\Upload;
use UserBundle\Entity\User;
use DocumentBundle\Entity\Document;
use DocumentBundle\Entity\Categoria;
use DocumentBundle\Controller\CategoriaController;
use DocumentBundle\View\DocumentView;
use ClienteBundle\Entity\Cliente;
use ClienteBundle\Controller\ClienteController;

/**
 * Description of UserController
 *
 * @author andre
 */
class DocumentController extends Controller {

    public function novoAction(User $user, Document $doc) {

        $indexView = new DocumentView();

        if (isset($_POST['name']) && $_POST['name'] != "" &&
                isset($_POST['client']) && $_POST['client'] != "") {

            $doc->setName($_POST['name']);
            $doc->setClient($_POST['client']);
            $doc->setCategory($_POST['category']);
            $doc->setActive($_POST['active']);
            $doc->setArchive($_FILES['archive']);


            $upload = new Upload("app/upload/" . $doc->getClient() . "/", $doc->getArchive(), "");
            $path = $upload->upload();

            $doc->setPath($path);
            $this->insertAction($doc);

            header('Location: documentoListar.php');
        } else {

            $catList = array();
            $categoria = new Categoria();
            foreach ($this->listAction($categoria) as $k => $v) {
                $categoria = new Categoria();
                $catList[] = $categoria->fetchEntity($v);
            }

            $cliList = array();
            $cliente = new Cliente();
            foreach ($this->listAction($cliente) as $k => $v) {
                $cliente = new Cliente();
                $cliList[] = $cliente->fetchEntity($v);
            }

            $template = $indexView->getTemplate();
            return $template->render('/src/DocumentBundle/View/src/documentoNovo.html', array('nome' => $user->getNome(), 'cat' => $catList, 'cli' => $cliList));
        }
    }

    public function listarAction(User $user, Document $doc) {

        $indexView = new DocumentView();
        $docList = array();

        $catController = new CategoriaController();
        $cliController = new ClienteController();
        foreach ($this->listAction($doc) as $k => $v) {
            $documento = new Document();
            $documento->fetchEntity($v);
            $cat = new Categoria();
            if ($documento->getCategory() != 0) {
                $catNome = $catController->listAction($cat, $documento->getCategory());
                $documento->setCategory(utf8_encode($catNome[1]['cat_30_nome']));
            } else {
                $documento->setCategory("Principal");
            }
            $cli = new Cliente();
            if ($documento->getClient() != 0) {
                $cliNome = $cliController->listAction($cli, $documento->getClient());
                $documento->setClient(utf8_encode($cliNome[1]['cli_30_nome']));
            } else {
                $documento->setClient("Principal");
            }
            $docList[] = $documento;
        }

        $template = $indexView->getTemplate();
        return $template->render('/src/DocumentBundle/View/src/documentoListar.html', array('nome' => $user->getNome(), 'list' => $docList));
    }

    public function editarAction(User $user, Document $doc) {

        $indexView = new DocumentView();

        if (isset($_POST['name']) && $_POST['name'] != "" &&
                isset($_POST['client']) && $_POST['client'] != "") {
            $doc->setId($_POST['id']);
            $doc->setName($_POST['name']);
            $doc->setClient($_POST['client']);
            $doc->setCategory($_POST['category']);
            $doc->setActive($_POST['active']);
            if (isset($_FILES['archive'])) {
                $doc->setArchive($_FILES['archive']);
                $upload = new Upload("app/upload/" . $doc->getClient() . "/", $doc->getArchive(), "");
                $path = $upload->upload();
                
                unlink($doc->getPath());

                $doc->setPath($path);
            }
            
            $this->editAction($doc);
            header('Location: documentoListar.php');
        } else {

            if (!$doc->getId()) {
                header('Location: documentoListar.php');
            } else {

                $catList = array();
                $categoria = new Categoria();
                foreach ($this->listAction($categoria,$doc->getCategory()) as $k => $v) {
                    $categoria = new Categoria();
                    $catList[] = $categoria->fetchEntity($v);
                }

                $cliList = array();
                $cliente = new Cliente();
                foreach ($this->listAction($cliente,$doc->getClient()) as $k => $v) {
                    $cliente = new Cliente();
                    $cliList[] = $cliente->fetchEntity($v);
                }

                $template = $indexView->getTemplate();
                return $template->render('/src/DocumentBundle/View/src/documentoEditar.html', array('nome' => $user->getNome(), 'doc' => $doc, 'cat' => $catList, 'cli' => $cliList));
                
            }
        }
    }
    
    public function deletarAction(User $user, Document $doc) {

        $indexView = new DocumentView();

        if (isset($_POST['id'])) {
            $doc->setId($_POST['id']);
            
            unlink($doc->getPath());
            
            $this->deleteAction($doc);
            header('Location: documentoListar.php');
        } else {

            if (!$doc->getId()) {
                header('Location: documentoListar.php');
            } else {
                $template = $indexView->getTemplate();
                return $template->render('/src/DocumentBundle/View/src/documentoDeletar.html', array('nome' => $user->getNome(), "doc" => $doc));
            }
        }
    }

}

?>
