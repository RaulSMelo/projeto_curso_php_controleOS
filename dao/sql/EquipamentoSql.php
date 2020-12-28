<?php

class EquipamentoSql {

    public static function inserir_equipamento() {
        $sql = "INSERT INTO tb_equipamento (identificacao_equipamento, descricao_equipamento, id_tipo, id_usuario_adm, id_modelo) VALUES (?, ?, ?, ?, ?)";
        return $sql;
    }

    public static function pesquisar_equipamento_por_tipo($idTipo) {

        $sql = 'SELECT equip.id_equipamento, tipo.nome_tipo_equipamento, modelo.nome_modelo_equipamento, 
                     equip.identificacao_equipamento, equip.descricao_equipamento FROM tb_equipamento equip  
                INNER JOIN tb_tipo_equipamento tipo 
                    ON equip.id_tipo = tipo.id_tipo_equipamento
                INNER JOIN tb_modelo_equipamento modelo 
                    ON equip.id_modelo = modelo.id_modelo_equipamento
                WHERE equip.id_usuario_adm = ?
                    AND equip.situacao = ?';

        if ($idTipo != 0) {
            $sql .= ' AND equip.id_tipo = ?';
        }
        $sql .= ' ORDER BY tipo.nome_tipo_equipamento';
        return $sql;
    }

    public static function detalhar_equipamento_por_tipo() {

        $sql = 'SELECT  equip.id_equipamento,
                        equip.id_tipo,
                        equip.id_modelo,
                        equip.identificacao_equipamento, 
                        equip.descricao_equipamento 
                    FROM tb_equipamento equip  
                WHERE equip.id_equipamento = ? AND equip.id_usuario_adm = ? ';
        return $sql;
    }

    public static function filtrar_equipamento_disponivel() {
        $sql = 'SELECT     equip.id_equipamento, 
                            equip.identificacao_equipamento,
                            equip.descricao_equipamento FROM tb_equipamento equip
                        WHERE equip.id_usuario_adm = ?
                        AND equip.situacao = ?
                        AND equip.id_equipamento NOT IN (SELECT al.id_equipamento
                                                    FROM tb_alocar as al 
                                                    WHERE data_remover IS NULL)';
        return $sql;
    }
    
    public static function alterar_equipamento(){
        $sql = 'UPDATE tb_equipamento SET identificacao_equipamento = ?, 
                                           descricao_equipamento = ?,
                                           id_tipo = ?,
                                           id_modelo = ? 
                                WHERE id_equipamento = ?';
        return $sql;
    }
    
    public static function deletar_equipamento(){
        $sql = 'UPDATE tb_equipamento SET situacao = ? WHERE id_usuario_adm = ? AND id_equipamento = ? ';
        return $sql;
    }

}
