<?php


class ModeloVo {
    
    private $id;
    private $nome;
    private $idUserAdm;
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getIdUserAdm() {
        return $this->idUserAdm;
    }

    public function setId($id) {
        $this->id = trim($id);
    }

    public function setNome($nome) {
        $this->nome = trim($nome);
    }

    public function setIdUserAdm($idUserAdm) {
        $this->idUserAdm = trim($idUserAdm);
    }


}
