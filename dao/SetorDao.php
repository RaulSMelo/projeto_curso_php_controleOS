<?php

require_once 'Conexao.php';
require_once 'sql/Setor_sql.php';

class SetorDao extends Conexao {

    public function InserirSetor(SetorVO $v) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(Setor_sql::inserir_setor());
        $i = 1;
        $sql->bindValue($i++, $v->getNome());
        $sql->bindValue($i++, $v->getIdUserAdm());
        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ConsultarSetor($idLogado) {

        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(Setor_sql::consultar_setor());
        $sql->bindValue(1, $idLogado);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }
    
    public function excluirSetor($idSetor) {

        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(Setor_sql::excluir_setor());
        $sql->bindValue(1, $idSetor);
        
        try {
           $sql->execute();
           return 1;
        } catch (Exception $ex) {
           return -2;
        }   
    }
    
      public function alterarSetor(SetorVo $vo) {

        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(Setor_sql::alterar_setor());
        $sql->bindValue(1, $vo->getNome());
        $sql->bindValue(2, $vo->getId());
        
        try {
           $sql->execute();
           return 1;
        } catch (Exception $ex) {
           return -2;
        }   
    }
}