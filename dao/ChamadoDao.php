<?php

require_once 'Conexao.php';
require_once 'sql/Chamado_sql.php';

class ChamadoDao extends Conexao {

    public function carregarEquipDisponivel($situacao, $idSetor) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(Chamado_sql::carregar_equip_disponivel());
        $sql->bindValue(1, $situacao);
        $sql->bindValue(2, $idSetor);

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function abrirChamado(ChamadoVo $vo) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(Chamado_sql::abrir_chamado());
        $i = 1;
        $sql->bindValue($i++, $vo->getDatAbertura());
        $sql->bindValue($i++, $vo->getDescricao());
        $sql->bindValue($i++, $vo->getSituacao());
        $sql->bindValue($i++, $vo->getIdUserFuncionario());
        $sql->bindValue($i++, $vo->getIdEquipamento());

        $conexao->beginTransaction();
        try {
            $sql->execute();

            $sql = $conexao->prepare(Chamado_sql::alterar_situacao_alocar());
            $sql->bindValue(1, 3);
            $sql->bindValue(2, $vo->getIdEquipamento());

            $sql->execute();
            $conexao->commit();
            return 1;
        } catch (Exception $e) {
            $conexao->rollBack();
            $e->getMessage();
            return -1;
        }
    }


    public static function chamados_setor($idSetor, $situacao_chamado) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(Chamado_sql::chamados_setor($idSetor, $situacao_chamado));
        $sql->bindValue(1, $idSetor);
        
        if($situacao_chamado != 0){
           $sql->bindValue(2, $situacao_chamado); 
        }
        
        $sql->execute();
        
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function consultar_chamado_tecnico($idSetor, $situacao_chamado) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(Chamado_sql::chamados_setor($idSetor, $situacao_chamado));
        
        if($situacao_chamado != 0){
           $sql->bindValue(1, $situacao_chamado); 
        }
        
        $sql->execute();
        
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function detalhar_chamado_tecnico($id_chamado) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(Chamado_sql::detalhar_chamado_tecnico());

        $sql->bindValue(1, $id_chamado); 
        
        $sql->execute();
        
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function atenderChamadoTecnico($dt_atendimento, $sit_chamado, $id_tecnico, $id_chamado) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(Chamado_sql::atender_chamado_tec());
        $sql->bindValue(1, $dt_atendimento); 
        $sql->bindValue(2, $sit_chamado);   
        $sql->bindValue(3, $id_tecnico); 
        $sql->bindValue(4, $id_chamado); 
        
        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
           echo  $e->getMessage();
           return -1;
        }
    }
    
    public static function finalizarChamadoTecnico($laudo, $sit_chamado, $id_tecnico, $dt_encerramento ,$id_chamado) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(Chamado_sql::finalizar_chamado_tec());
        $sql->bindValue(1, $laudo); 
        $sql->bindValue(2, $sit_chamado);   
        $sql->bindValue(3, $id_tecnico); 
        $sql->bindValue(4, $dt_encerramento); 
        $sql->bindValue(5, $id_chamado); 
        
        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
           echo  $e->getMessage();
           return -1;
        }
    }

    public function dadosGraficoChamados($aguardando, $atendido, $finalizado){
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(Chamado_sql::grafico_chamado());
        $sql->bindValue(1,$aguardando);
        $sql->bindValue(2,$atendido);
        $sql->bindValue(3,$finalizado);

        $sql->execute();
         return $sql->fetchAll(PDO::FETCH_ASSOC);

    }
}
