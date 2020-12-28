<?php

require_once 'UtilCTRL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controleOS/dao/SetorDao.php';

class SetorController {

    public function InserirSetor(SetorVo $v) {

        if ($v->getNome() == '') {
            return 0;
        }

        $v->setIduserAdm(UtilCTRL::codigoAdmLogado());
        $dao = new SetorDao();

        return $dao->inserirSetor($v);
    }
    
    public function consultarSetor(){
        $dao =  new SetorDao();
        return $dao->ConsultarSetor(UtilCTRL::codigoAdmLogado());
    }
    
    public function excluirSetor($idSetor) {
        $dao = new SetorDao();
        return $dao->excluirSetor($idSetor);
    }
    
    public function alterarSetor(SetorVo $vo){
        if($vo->getNome() == ''){
            return 0;  
        }
       $dao = new SetorDao();
       return $dao->alterarSetor($vo);         
    }
}
