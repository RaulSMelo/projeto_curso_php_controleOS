<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/controleOS/dao/chamadoDao.php';
require_once 'UtilCTRL.php';

class ChamadoController {

    public function carregarEquipDisponivel() {
        $dao = new ChamadoDao();
        return $dao->carregarEquipDisponivel(UtilCTRL::disponivel(), UtilCTRL::setor_logado());
    }

    public function abrirChamado(ChamadoVo $vo) {

        if ($vo->getIdEquipamento() == '' || trim($vo->getDescricao()) == '') {
            return 0;
        }

        $dao = new ChamadoDao();

        $vo->setDatAbertura(UtilCTRL::dataAtual());
        $vo->setSituacao(UtilCTRL::disponivel());
        $vo->setIdUserFuncionario(UtilCTRL::codigoAdmLogado());

        return $dao->abrirChamado($vo);
    }

    public function chamadosSetor($situacao_chamado) {
        $dao = new ChamadoDao();
        return $dao->chamados_setor(UtilCTRL::setor_logado(), $situacao_chamado);
    }

    public function chamadosTecnico($situacao_chamado) {
        $dao = new ChamadoDao();
        return $dao->consultar_chamado_tecnico(UtilCTRL::setor_logado(), $situacao_chamado);
    }

    public function atenderChamadoTec($id_chamado) {
        $dao = new ChamadoDao();
        return $dao->atenderChamadoTecnico
                        (
                            UtilCTRL::dataAtual(), 
                            UtilCTRL::atendimento(), 
                            UtilCTRL::codigoAdmLogado(), 
                            $id_chamado
                        );
    }
    
    public function finalizarChamadoTec($laudo, $id_chamado) {
        $dao = new ChamadoDao();
        return $dao->finalizarChamadoTecnico
                        (
                            $laudo, 
                            UtilCTRL::finalizado(), 
                            UtilCTRL::codigoAdmLogado(),
                            UtilCTRL::dataAtual(),
                            $id_chamado
                        );
    }

    public function detalhesChamadoTecnico($id_chamado) {
        $dao = new ChamadoDao();
        return $dao->detalhar_chamado_tecnico($id_chamado);
    }

    public function dadosGraficoChamadosCtrl(){
       $dao = new ChamadoDao();
       return $dao->dadosGraficoChamados(UtilCTRL::aguardando(),UtilCTRL::atendimento(),UtilCTRL::finalizado());
    }

}
