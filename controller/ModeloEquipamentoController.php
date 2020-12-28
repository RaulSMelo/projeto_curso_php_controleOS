<?php
require_once 'UtilCTRL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controleOS/dao/ModeloEquipamentoDao.php';

class ModeloEquipamentoController {
    
    public function inserirModeloEquipamento(ModeloVo $modeloEquip){
       if($modeloEquip->getNome() == ''){
           return 0; 
       }
       $dao = new ModeloEquipamentoDao();
       $modeloEquip->setIdUserAdm(UtilCTRL::codigoAdmLogado());
       return $dao->inserirModeloEquipamento($modeloEquip);  
    }
    
    public function consultarModeloEquipamento(){
        $dao = new ModeloEquipamentoDao();
        return $dao->consultarModeloEquipamento(UtilCTRL::codigoAdmLogado());
    }
    
    public function alterarModeloEquipamento(ModeloVo $modeloEquip){
        if($modeloEquip->getNome() == ''){
           return 0; 
        }
        $dao = new ModeloEquipamentoDao();
        return $dao->alterarModeloEquipamento($modeloEquip);
    }
    
    public function excluirModeloEquipamento($idModeloEquip){
        $dao = new ModeloEquipamentoDao();
        return $dao->excluirModeloEquipamento($idModeloEquip);
    }
}
