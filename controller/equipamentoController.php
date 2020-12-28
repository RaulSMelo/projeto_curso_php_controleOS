<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/controleOS/dao/EquipamentoDao.php';
require_once 'UtilCTRL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controleOS/dao/AlocarDao.php';

class equipamentoController {
    
    public function inserirEquipamento(EquipamentoVo $equipVo){
        $dao = new EquipamentoDao();
        $equipVo->setIdUserAdm(UtilCTRL::codigoAdmLogado());
        return $dao->inserirEquipamento($equipVo);  
    }

    public function pesquisarEquipamentoPorTipo($idTipo){
        $dao = new EquipamentoDao();
        return $dao->pesquisarEquipamentosPorTipo($idTipo, UtilCTRL::codigoAdmLogado(), UtilCTRL::disponivel());
    }
    
    public function detalharEquipamentos($idEquip){
        $dao = new EquipamentoDao();
        return $dao->detalharEquipamentosPorTipo($idEquip, UtilCTRL::codigoAdmLogado());
    }
    
        
    public function filtrarEquipamentoDisponivel(){
        $dao = new EquipamentoDao();
        return $dao->filtrarEquipamentoDisponivel(UtilCTRL::codigoAdmLogado(), UtilCTRL::disponivel());
    }
    
    public function alterarEquipamento(EquipamentoVo $equip){
        $dao = new EquipamentoDao();
        return $dao->alterarEquipamento($equip);
    }
    
    public function excluirEquipamento($idEquip){
        $dao = new EquipamentoDao();
        return $dao->excluirEquipamento(UtilCTRL::indisponivel(), UtilCTRL::codigoAdmLogado(), $idEquip);
    }
}
