<?php

require_once 'sql/EquipamentoSql.php';
require_once 'Conexao.php';

class EquipamentoDao extends Conexao {

    public function inserirEquipamento(EquipamentoVo $equipVo) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(EquipamentoSql::inserir_equipamento());
        $i = 1;
        $sql->bindValue($i++, $equipVo->getIdentificacao());
        $sql->bindValue($i++, $equipVo->getDescricao());
        $sql->bindValue($i++, $equipVo->getIdTipo());
        $sql->bindValue($i++, $equipVo->getIdUserAdm());
        $sql->bindValue($i++, $equipVo->getIdModelo());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return -1;
        }
    }

    public function pesquisarEquipamentosPorTipo($idTipo, $idUserAdm, $situacao) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(EquipamentoSql::pesquisar_equipamento_por_tipo($idTipo));
        $sql->bindValue(1, $idUserAdm);
        $sql->bindValue(2, $situacao);

        if ($idTipo != 0) {
            $sql->bindValue(3, $idTipo);
        }

        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function detalharEquipamentosPorTipo($idEquip, $idUserAdm) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(EquipamentoSql::detalhar_equipamento_por_tipo());
        $sql->bindValue(1, $idEquip);
        $sql->bindValue(2, $idUserAdm);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function filtrarEquipamentoDisponivel($idUserAdm, $situacao){
        $conexao = parent::retornaConexao();
        $sql = $conexao->prepare(EquipamentoSql::filtrar_equipamento_disponivel());
        $sql->bindValue(1,$idUserAdm);
        $sql->bindValue(2,$situacao);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function alterarEquipamento(EquipamentoVo $equip){
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(EquipamentoSql::alterar_equipamento());
        $i = 1;
        $sql->bindValue($i++, $equip->getIdentificacao());
        $sql->bindValue($i++, $equip->getDescricao());
        $sql->bindValue($i++, $equip->getIdTipo());
        $sql->bindValue($i++, $equip->getIdModelo());
        $sql->bindValue($i++, $equip->getId());
        
        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return -1;
        }
        
    }
    
    public function excluirEquipamento($situacao, $codAdmLogado, $idEquip){
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(EquipamentoSql::deletar_equipamento());
        $sql->bindValue(1, $situacao);
        $sql->bindValue(2, $codAdmLogado);
        $sql->bindValue(3, $idEquip);
        
        try {
            $sql->execute();
            return 1;    
        } catch (Exception $e) {
          echo $e->getMessage();
          return -1;
        }
        
    }

}
