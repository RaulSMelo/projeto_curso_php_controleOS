<?php

class SetorVo {

    private $id;
    private $nome;
    private $iduserAdm;

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getIduserAdm() {
        return $this->iduserAdm;
    }

    public function setId($id) {
        $this->id = trim($id);
    }

    public function setNome($nome) {
        $this->nome = trim($nome);
    }

    public function setIduserAdm($iduserAdm) {
        $this->iduserAdm = trim($iduserAdm);
    }

}
