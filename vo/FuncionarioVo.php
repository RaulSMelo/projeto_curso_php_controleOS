<?php

require_once 'UsuarioVo.php';

class FuncionarioVo extends UsuarioVo {
    
    private $tel;
    private $endereco;
    private $idUserAdm;
    private $idSetor;
    
 
    public function getTel() {
        return $this->tel;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getIdUserAdm() {
        return $this->idUserAdm;
    }

    public function getIdSetor() {
        return $this->idSetor;
    }


    public function setTel($tel) {
        $this->tel = trim($tel);
    }

    public function setEndereco($endereco) {
        $this->endereco = trim($endereco);
    }

    public function setIdUserAdm($idUserAdm) {
        $this->idUserAdm = trim($idUserAdm);
    }

    public function setIdSetor($idSetor) {
        $this->idSetor = trim($idSetor);
    }

    
}
