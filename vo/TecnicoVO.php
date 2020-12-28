<?php

require_once 'UsuarioVo.php';

class TecnicoVO extends UsuarioVo{
    
    private $id_usuario_tec;
    private $tel;
    private $endereco;
    private $idUserAdm;
            
    
    public function getId_usuario_tec() {
        return $this->id_usuario_tec;
    }

    public function setId_usuario_tec($id_usuario_tec) {
        $this->id_usuario_tec = $id_usuario_tec;
    }


    public function getTel() {
        return $this->tel;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setTel($tel) {
        $this->tel = trim($tel);
    }

    public function setEndereco($endereco) {
        $this->endereco = trim($endereco);
    }
    public function getIdUserAdm() {
        return $this->idUserAdm;
    }

    public function setIdUserAdm($idUserAdm) {
        $this->idUserAdm = $idUserAdm;
    }



    
}
