<?php

class ChamadoVo {
   
    private $id;
    private $datAbertura;
    private $descricao;
    private $datAtendimento;
    private $laudo;
    private $situacao;
    private $idUserFuncionario;
    private $idEquipamento;
    private $idUserTec;
   
    public function getId() {
        return $this->id;
    }

    public function getDatAbertura() {
        return $this->datAbertura;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getDatAtendimento() {
        return $this->datAtendimento;
    }

    public function getLaudo() {
        return $this->laudo;
    }

    public function getSituacao() {
        return $this->situacao;
    }

    public function getIdUserFuncionario() {
        return $this->idUserFuncionario;
    }

    public function getIdEquipamento() {
        return $this->idEquipamento;
    }

    public function getIdUserTec() {
        return $this->idUserTec;
    }

    public function setId($id) {
        $this->id = trim($id);
    }

    public function setDatAbertura($datAbertura) {
        $this->datAbertura =trim($datAbertura);
    }

    public function setDescricao($descricao) {
        $this->descricao = trim($descricao);
    }

    public function setDatAtendimento($datAtendimento) {
        $this->datAtendimento = trim($datAtendimento);
    }

    public function setLaudo($laudo) {
        $this->laudo = trim($laudo);
    }

    public function setSituacao($situacao) {
        $this->situacao = trim($situacao);
    }

    public function setIdUserFuncionario($idUserFuncionario) {
        $this->idUserFuncionario = trim($idUserFuncionario);
    }

    public function setIdEquipamento($idEquipamento) {
        $this->idEquipamento = trim($idEquipamento);
    }

    public function setIdUserTec($idUserTec) {
        $this->idUserTec = trim($idUserTec);
    }


}
