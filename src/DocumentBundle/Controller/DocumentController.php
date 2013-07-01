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
                isset($_POST['client']) && $_POST['client'] != "" &&
                isset($_POST['date']) && $_POST['date'] != "") {

            $doc->setName($_POST['name']);
            $doc->setClient($_POST['client']);
            $doc->setCategory($_POST['category']);
            $doc->setActive($_POST['active']);
            $expTime = explode("/", $_POST['date']);
            $timeDoc = mktime(0, 0, 1, $expTime[1], $expTime[0], $expTime[2]);
            $doc->setDate($timeDoc);
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
            return $template->render('/src/DocumentBundle/View/src/documentoNovo.html', array('nome' => $user->getNome(), 'user' => $user, 'cat' => $catList, 'cli' => $cliList));
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
        return $template->render('/src/DocumentBundle/View/src/documentoListar.html', array('nome' => $user->getNome(), 'user' => $user, 'list' => $docList));
    }
    
    public function listarDocumentoCategoriaAction(User $user, $idCategory) {

        $indexView = new DocumentView();
        $docList = array();

        $catController = new CategoriaController();
        $cat = new Categoria();

        if ($idCategory){
            $idCategory = $idCategory;
        }else {
            $idCategory = '0';
        }
        $critDocuments = array(
            'cat_10_id' => $idCategory
        );
        $docRet = array();
        $docYear = array();

        $doc = new Document();
        $docController = new DocumentController();
        $docList = $docController->listAction($doc, "", $critDocuments);
        foreach($docList as $kDoc => $vDoc){
            $newDoc = new Document();
            $newDoc->fetchEntity($vDoc);
            $docYear[] = date("Y",$newDoc->getDate());
        }
        $template = $indexView->getTemplate();
        return $template->render('/src/DocumentBundle/View/src/listar-documento-categoria.html', array('nome' => $user->getNome(), 'user' => $user, 'catId' => $idCategory ,"docYear" => array_unique($docYear)));
    }
    
    public function listarDocumentoCategoriaAnoAction(User $user, $idCategory, $ano) {
        $indexView = new DocumentView();
        $docList = array();

        if ($idCategory){
            $idCategory = $idCategory;
        }else {
            $idCategory = '0';
        }
        
        $inicioData = mktime(0, 0, 1, 1, 1, $ano);
        $finalData = mktime(24, 60, 0, 12, 31, $ano);
        
        $critDocuments = array(
            'cat_10_id' => $idCategory,
            'doc_10_data' => array(
                'operator' => '>',
                'val' => $inicioData
            ),
            'doc_10_data' => array(
                'operator' => '<',
                'val' => $finalData
            )
        );
        $docRet = array();
        $docYear = array();

        $doc = new Document();
        $docController = new DocumentController();
        $docList = $docController->listAction($doc, "", $critDocuments);
        $cliList = array();
        foreach($docList as $kDoc => $vDoc){
            $newDoc = new Document();
            $newDoc->fetchEntity($vDoc);
            $cli = new Cliente();
            $cliController = new ClienteController();
            if (!in_array($newDoc->getClient(), $cliList)){
                $cliRet = $cliController->listAction($cli, $newDoc->getClient());
                $cliList[$newDoc->getClient()] = $cli->fetchEntity($cliRet[1]);
            }
        }
        $template = $indexView->getTemplate();
        return $template->render('/src/DocumentBundle/View/src/listar-documento-categoria-ano.html', array('nome' => $user->getNome(), 'user' => $user, 'catId' => $idCategory ,"docYear" => $ano, 'listCli' => $cliList));
    }
    
    public function listarDocumentoCategoriaAnoClienteAction(User $user, $idCategory, $ano, $idCliente) {
        $indexView = new DocumentView();
        $docList = array();

        if ($idCategory){
            $idCategory = $idCategory;
        }else {
            $idCategory = '0';
        }
        
        $inicioData = mktime(0, 0, 1, 1, 1, $ano);
        $finalData = mktime(24, 60, 0, 12, 31, $ano);
        
        $critDocuments = array(
            'cat_10_id' => $idCategory,
            'doc_10_data' => array(
                'operator' => '>',
                'val' => $inicioData
            ),
            'doc_10_data' => array(
                'operator' => '<',
                'val' => $finalData
            ),
            'cli_10_id' => $idCliente
        );
        $docRet = array();

        $doc = new Document();
        $docController = new DocumentController();
        $docList = $docController->listAction($doc, "", $critDocuments);
        foreach($docList as $kDoc => $vDoc){
            $newDoc = new Document();
            $newDoc->fetchEntity($vDoc);
            $docRet[] = $newDoc;
        }
        $template = $indexView->getTemplate();
        return $template->render('/src/DocumentBundle/View/src/listar-documento-categoria-ano-cliente.html', array('nome' => $user->getNome(), 'user' => $user, 'docList' => $docRet));
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
            $expTime = explode("/", $_POST['date']);
            $timeDoc = mktime(0, 0, 1, $expTime[1], $expTime[0], $expTime[2]);
            $doc->setDate($timeDoc);
            if ($_FILES['archive']["name"] != "") {
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

                $doc->setDate(date("d/m/Y",$doc->getDate()));
                $template = $indexView->getTemplate();
                return $template->render('/src/DocumentBundle/View/src/documentoEditar.html', array('nome' => $user->getNome(), 'user' => $user, 'doc' => $doc, 'cat' => $catList, 'cli' => $cliList));
                
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
                return $template->render('/src/DocumentBundle/View/src/documentoDeletar.html', array('nome' => $user->getNome(), 'user' => $user, "doc" => $doc));
            }
        }
    }

}

?>
