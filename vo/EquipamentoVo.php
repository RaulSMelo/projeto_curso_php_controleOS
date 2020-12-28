<?php


class EquipamentoVo {
    
    private $id;
    private $identificacao;
    private $descricao;
    private $idTipo;
    private $idModelo;
    private $idUserAdm;
    public function getId() {
        return $this->id;
    }

    public function getIdentificacao() {
        return $this->identificacao;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getIdTipo() {
        return $this->idTipo;
    }

    public function getIdModelo() {
        return $this->idModelo;
    }

    public function getIdUserAdm() {
        return $this->idUserAdm;
    }

    public function setId($id) {
        $this->id = trim($id);
    }

    public function setIdentificacao($identificacao) {
        $this->identificacao = trim($identificacao);
    }

    public function setDescricao($descricao) {
        $this->descricao = trim($descricao);
    }

    public function setIdTipo($idTipo) {
        $this->idTipo = trim($idTipo);
    }

    public function setIdModelo($idModelo) {
        $this->idModelo = trim($idModelo);
    }

    public function setIdUserAdm($idUserAdm) {
        $this->idUserAdm = trim($idUserAdm);
    }


}
