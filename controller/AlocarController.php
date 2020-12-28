<?php

require_once 'UtilCTRL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controleOS/dao/AlocarDao.php';
class AlocarController {
 
    public function inserirAlocarEquipamento(AlocarVo $alocarVo){
        $dao = new AlocarDao();
        $alocarVo->setDataAlocar(UtilCTRL::dataAtual());
        $alocarVo->setSituacao(1);
        $alocarVo->setIdUserAdm(UtilCTRL::codigoAdmLogado());
        return $dao->inserirAlocarEquipamento($alocarVo);
    }
    
    public function verificarEquipamentosAlocados($idEquip){
       $dao = new AlocarDao();
       return $dao->verificarEquipamentosAlocados($idEquip, UtilCTRL::codigoAdmLogado(), UtilCTRL::disponivel());
    }

    public function historicoAlocados($idEquip){
       $dao = new AlocarDao();
       return $dao->relatorioEquipamentosAlocados($idEquip);
    }


}
