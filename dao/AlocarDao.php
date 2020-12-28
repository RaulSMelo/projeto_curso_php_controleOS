<?php
require_once 'Conexao.php';
require_once 'sql/AlocarSql.php';

class AlocarDao extends Conexao {
    
    public function inserirAlocarEquipamento(AlocarVo $alocarVo){
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(AlocarSql::inserir_alocar_equipamento());
        $i = 1;
        $sql->bindValue($i++, $alocarVo->getDataAlocar());
        $sql->bindValue($i++, $alocarVo->getSituacao());
        $sql->bindValue($i++, $alocarVo->getIdEquipamento());
        $sql->bindValue($i++, $alocarVo->getIdSetor());
        $sql->bindValue($i++, $alocarVo->getIdUserAdm());
        
        try {
            $sql->execute();
            return 1;    
        } catch (Exception $e) {
            echo $e->getMessage();
            return -1;
        }
    } 
    
    public function verificarEquipamentosAlocados($idEquip, $codAdmLogado, $situacao){
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(AlocarSql::verificar_equipamento_alocado());
        $sql->bindValue(1, $idEquip);
        $sql->bindValue(2, $codAdmLogado);
        $sql->bindValue(3, $situacao);
        
        $sql->execute();
        
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function relatorioEquipamentosAlocados($idEquip){
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(AlocarSql::relatorio_equip_alocados());
        $sql->bindValue(1, $idEquip);

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }
    
}
