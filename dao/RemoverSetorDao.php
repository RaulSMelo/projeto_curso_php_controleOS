<?php

require_once 'Conexao.php';
require_once 'sql/RemoverEquipSetorSql.php';

class RemoverSetorDao extends Conexao{
    
    public function consultarEquipAlocados($idSetor,$idUserAdm){
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(RemoverEquipSetorSql::consultar_equip_alocados($idSetor));
        $sql->bindValue(1, $idUserAdm);
        
        if($idSetor != 0){
            $sql->bindValue(2, $idSetor);
        }
        
        $sql->execute();
        
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removerEquipamentoSetor($idAlocar, $dataAtual){
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(RemoverEquipSetorSql::remover_equipamento_setor());
        $sql->bindValue(1, $dataAtual);
        $sql->bindValue(2, 2);
        $sql->bindValue(3,$idAlocar);
        
        try {
           $sql->execute();
           return 1;
        } catch (Exception $e) {
           echo $e->getMessage();
           return -1; 
        }
    }
    
}
