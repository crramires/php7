<?php

class Usuario {
    
    private $idusuario;
    private $deslogin;
    private $dessenha;

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function setIdusuario($value) {
        $this->idusuario = $value;   
    }

    public function getLogin() {
        return $this->deslogin;
    }

    public function setLogin($value) {
        $this->deslogin = $value;   
    }


    public function getSenha() {
        return $this->dessenha;
    }

    public function setSenha($value) {
        $this->dessenha = $value;   
    }

    // Lista por ID passado como parametro
    public function loadByID($id) {

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            "ID"=>$id
        ));

        if ( count($results) > 0 ) {
            
            $this->setData($results[0]);
        }

    }

    // Lista tudo que está na tabela
    public static function getList() {

        $sql = new Sql();

        $list = $sql->select("SELECT * FROM tb_usuarios ORDER BY idusuario;");
        return $list;
    }

    // Pesquisa por login que é recebido por parametro
    public static function search($login) {

        $sql = new Sql();

        $pesq = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY idusuario", array(
            ':SEARCH'=>"%".$login."%"
        ));

        return $pesq;

    }

    public function login($login, $password) {
        
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));

        if ( count($results) > 0 ) {
            
            $this->setData($results[0]);
        
        } else {

            throw new Exception("Login e/ou senha inválidos");
            

        }
    }

    public function setData($data) {
        
        $this->setIdusuario($data['idusuario']);
        $this->setLogin($data['deslogin']);
        $this->setSenha($data['dessenha']);
    }


    public function insert() {

        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ":LOGIN"=>$this->getLogin(),
            ":PASSWORD"=>$this->getSenha()
        ));

        if( count($results) > 0 ) {
            $this->setData($results[0]);
        }

    }

    public function __toString() {
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getLogin(),
            "dessenha"=>$this->getSenha()
        ));
    }


}

?>