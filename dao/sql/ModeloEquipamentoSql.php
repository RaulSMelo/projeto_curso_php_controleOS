<?php

class ModeloEquipamentoSql {
   
    public static function inserir_modelo_equipamento() {
        $sql = "INSERT INTO tb_modelo_equipamento (nome_modelo_equipamento, id_usuario_adm) VALUES (?, ?)";
        return $sql;
    }
    
    public static function consultar_modelo_equipamento(){
        $sql = "SELECT id_modelo_equipamento, nome_modelo_equipamento FROM tb_modelo_equipamento WHERE id_usuario_adm = ? ORDER BY nome_modelo_equipamento";
        return $sql;
    }
    
    public static function alterar_modelo_equipamento(){
        $sql = "UPDATE tb_modelo_equipamento SET nome_modelo_equipamento = ? WHERE id_modelo_equipamento = ?";
        return $sql;
    }
    
    public static function excluir_modelo_equipamento(){
        $sql = "DELETE FROM tb_modelo_equipamento WHERE id_modelo_equipamento = ?";
        return $sql;
    }
}
