<?php


class UsuarioVo {
    
    private $idUser;
    private $nome;
    private $sobrenome;
    private $login;
    private $senha;
    private $tipo;
    private $status;
    private $email;
    
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

        
    public function getIdUser() {
        return $this->idUser;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getSobrenome() {
        return $this->sobrenome;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setIdUser($idUser) {
        $this->idUser = trim($idUser);
    }

    public function setNome($nome) {
        $this->nome = trim($nome);
    }

    public function setSobrenome($sobrenome) {
        $this->sobrenome = trim($sobrenome);
    }

    public function setLogin($login) {
        $this->login = trim($login);
    }

    public function setSenha($senha) {
        $this->senha = trim($senha);
    }

    public function setTipo($tipo) {
        $this->tipo = trim($tipo);
    }

    public function setStatus($status) {
        $this->status = trim($status);
    }


}
