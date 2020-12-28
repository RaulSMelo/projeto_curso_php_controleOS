<?php

class TipoEquipamentoSql {
    
    public static function inserir_tipo_equipamento(){
        $sql = "INSERT INTO tb_tipo_equipamento (nome_tipo_equipamento,id_usuario_adm) VALUES (? , ?)";
        return $sql;
    }
    
    public static function consultar_tipo_equipamento(){
        $sql = "SELECT id_tipo_equipamento, nome_tipo_equipamento FROM tb_tipo_equipamento WHERE id_usuario_adm = ? ORDER BY nome_tipo_equipamento";
        return $sql;
    }
    
    public static function alterar_tipo_equipamento () {
        $sql = "UPDATE tb_tipo_equipamento SET nome_tipo_equipamento = ? WHERE id_tipo_equipamento = ?";
        return$sql;
    }
    
    public static function excluir_tipo_equipamento(){
        $sql = "DELETE FROM tb_tipo_equipamento WHERE id_tipo_equipamento = ?";
        return $sql;
    }           
}
