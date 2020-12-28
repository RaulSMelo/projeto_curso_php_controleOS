<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/controleOS/dao/TipoEquipamentoDao.php';
require_once 'UtilCTRL.php';

class TipoEquipamentoController {
    
    public function inserirTipoEquipamento(TipoEquipamentoVo $tipoEquip ) {
        
        if($tipoEquip->getNome() == ''){
            return 0;
        }
        $tipoEquip->setIdUserAdm(UtilCTRL::codigoAdmLogado());
        $dao = new TipoEquipamentoDao();
        
        return $dao->inserirTipoEquipamento($tipoEquip);    
    }
    
    public function ConsultarTipoEquipamento(){
        $dao = new TipoEquipamentoDao();
        return $dao->consultarTipoEquipamento(UtilCTRL::codigoAdmLogado());  
    }
    
    public function alterarTipoEquipamento(TipoEquipamentoVo $tipoEquip) {
        $dao = new TipoEquipamentoDao();
        return $dao->alterarTipoEquipamento($tipoEquip);
    }
    
    public function excluirTipoEquipamento($id){
        $dao = new TipoEquipamentoDao();
        return $dao->excluirTipoEquipamento($id);
    }
}
