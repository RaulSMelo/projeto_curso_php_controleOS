<?php

require_once 'Conexao.php';
require_once 'sql/TipoEquipamentoSql.php';

class TipoEquipamentoDao extends Conexao {
    
    public function inserirTipoEquipamento(TipoEquipamentoVo $tipoEquip){
        
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(TipoEquipamentoSql::inserir_tipo_equipamento());
        $i = 1;
        $sql->bindValue($i++, $tipoEquip->getNome());
        $sql->bindValue($i++, $tipoEquip->getIdUserAdm());
        
        try {
            $sql->execute();
            return 1;
            
        } catch (Exception $e) {
            echo $e->getMessage(); 
            return -1;
        }
    }
    
    public function consultarTipoEquipamento($idAdmLogado){
       $conexao = parent::retornaConexao();
       $sql = new PDOStatement();
       $sql = $conexao->prepare(TipoEquipamentoSql::consultar_tipo_equipamento());
       
       $sql->bindValue(1, $idAdmLogado);
       
       try {
           $sql->execute();
           return $sql->fetchAll(PDO::FETCH_ASSOC);
           
       } catch (Exception $e) {
           echo $e->getMessage(); 
           return -1;
       }
       
    }
    
    public function alterarTipoEquipamento(TipoEquipamentoVo $tipoEquip){
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(TipoEquipamentoSql::alterar_tipo_equipamento());
        $i = 1;
        $sql->bindValue($i++, $tipoEquip->getNome());
        $sql->bindValue($i++, $tipoEquip->getId());
        
        try {
            $sql->execute();
            return 1;
            
        } catch (Exception $e) {
            echo $e->getMessage();
            return -2;
        }        
    }
    
    public function excluirTipoEquipamento($id) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(TipoEquipamentoSql::excluir_tipo_equipamento());
        $sql->bindValue(1,$id);

        try {
             $sql->execute();
             return 1;
        } catch (Exception $e) {
             echo $e->getMessage();
             return -2;
        }
    }
   
}
