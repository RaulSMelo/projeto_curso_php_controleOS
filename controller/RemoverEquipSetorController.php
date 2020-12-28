<?php

require_once 'UtilCTRL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controleOS/dao/RemoverSetorDao.php';

class RemoverEquipSetorController{
    
    public function consultarEquipSetor($idSetor){
        $dao = new RemoverSetorDao();
        return $dao->consultarEquipAlocados($idSetor, UtilCTRL::codigoAdmLogado());

    }
    
    public function removerEquipamentoSetor($idAlocar){
        $dao = new RemoverSetorDao();
        return $dao->removerEquipamentoSetor($idAlocar, UtilCTRL::dataAtual());
    }
    
}
