<?php


class AlocarVo {
    
    private $id;
    private $dataAlocar;
    private $datRemover;
    private $situacao;
    private $idEquipamento;
    private $idUserAdm;
    private $idSetor;
    
    public function getId() {
        return $this->id;
    }

    public function getDataAlocar() {
        return $this->dataAlocar;
    }

    public function getDatRemover() {
        return $this->datRemover;
    }

    public function getSituacao() {
        return $this->situacao;
    }

    public function getIdEquipamento() {
        return $this->idEquipamento;
    }

    public function getIdUserAdm() {
        return $this->idUserAdm;
    }

    public function getIdSetor() {
        return $this->idSetor;
    }

    public function setId($id) {
        $this->id = trim($id);
    }

    public function setDataAlocar($dataAlocar) {
        $this->dataAlocar = trim($dataAlocar);
    }

    public function setDatRemover($datRemover) {
        $this->datRemover = trim($datRemover);
    }

    public function setSituacao($situacao) {
        $this->situacao = trim($situacao);
    }

    public function setIdEquipamento($idEquipamento) {
        $this->idEquipamento = trim($idEquipamento);
    }

    public function setIdUserAdm($idUserAdm) {
        $this->idUserAdm = trim($idUserAdm);
    }

    public function setIdSetor($idSetor) {
        $this->idSetor = trim($idSetor);
    }


}
