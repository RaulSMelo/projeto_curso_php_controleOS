<?php

require_once 'sql/ModeloEquipamentoSql.php';
require_once 'Conexao.php';

class ModeloEquipamentoDao extends Conexao {
    
    public function inserirModeloEquipamento(ModeloVo $modeloEquip){
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(ModeloEquipamentoSql::inserir_modelo_equipamento());
        $i = 1;
        $sql->bindValue($i++,$modeloEquip->getNome());
        $sql->bindValue($i++,$modeloEquip->getIdUserAdm());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
          echo $e->getMessage();
          return -1;
        }    
    }
    
    public function consultarModeloEquipamento($idUserAdm){
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(ModeloEquipamentoSql::consultar_modelo_equipamento());
        $sql->bindValue(1, $idUserAdm);
        
        try {
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);   
        } catch (Exception $e) {
           echo $e->getMessage();
           return -1;
        }
    }
    
    public function alterarModeloEquipamento(ModeloVo $modeloEquip) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(ModeloEquipamentoSql::alterar_modelo_equipamento());
        $i = 1;
        $sql->bindValue($i++, $modeloEquip->getNome());
        $sql->bindValue($i++, $modeloEquip->getId());
        
        try {
            $sql->execute();
            return 1;  
        } catch (Exception $e) {
            echo $e->getMessage();
            return -2;
        }
    }
    
    public function excluirModeloEquipamento($idModeloEquip){
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(ModeloEquipamentoSql::excluir_modelo_equipamento());
        $sql->bindValue(1, $idModeloEquip);
        
        try {
            $sql->execute();
            return 1;    
        } catch (Exception $e) {
            echo $e->getMessage();
            return -2;
        }
    }
}
