<?php

namespace UserBundle\Entity;

use KernelBundle\Model\Entity;

/**
 * Class that maps the user
 *
 * @author andre
 */
class User implements Entity{
    
    function __construct(){
        
        $this->setType(1);
        
    }


    private $id;
    
    /* User Type List:
     * 1: Administrador
     * 2: Usuário normal
     */
    private $type;
    
    private $group;
    
    private $nome;
    
    private $login;
    
    private $senha;
    
    private $email;
    
    private $active;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getGroup() {
        return $this->group;
    }

    public function setGroup($group) {
        $this->group = $group;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function assocEntity() {
        $fields = array(
            "usr_10_id"            => $this->getId(),
            "usr_10_group"         => $this->getGroup(),
            "usr_12_type"          => $this->getType(),
            "usr_30_nome"          => $this->getNome(),
            "usr_30_username"      => $this->getLogin(),
            "usr_30_password"      => $this->getSenha(),
            "usr_30_email"         => $this->getEmail(),
            "usr_12_active"        => $this->getActive()
        );
        
        return $fields;
    }

    public function fetchEntity($row) {
        
        $this->setId($row['usr_10_id']);
        $this->setGroup(utf8_encode($row['usr_10_group']));
        $this->setType($row['usr_12_type']);
        $this->setNome(utf8_encode($row['usr_30_nome']));
        $this->setLogin($row['usr_30_username']);
        $this->setSenha($row['usr_30_password']);
        $this->setEmail($row['usr_30_email']);
        $this->setActive($row['usr_12_active']);
        
        return $this;
        
    }
    
    public function encriptPassword($password){

        for ($i = 20; $i <= 20; $i++) {
            $password = md5($password);
        }

        $password = base64_encode($password);
        
        return $password;
        
    }
    
    public function tableName(){
        return "usr_usr_user";
    }
    
    public function primaryKey(){
        return "usr_10_id";
    }

}

?>