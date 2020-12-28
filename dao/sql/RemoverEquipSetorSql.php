<?php

class RemoverEquipSetorSql {
    
    public static function consultar_equip_alocados($idSetor){
        $sql = 'SELECT alocar.id_alocar, 
                        tipo.nome_tipo_equipamento, 
                        modelo.nome_modelo_equipamento, 
                        equip.identificacao_equipamento, 
                        equip.descricao_equipamento, 
                        setor.nome_setor  
                FROM tb_alocar alocar
                    INNER JOIN  tb_equipamento equip
                        ON alocar.id_equipamento = equip.id_equipamento
                    INNER JOIN  tb_tipo_equipamento tipo
                        ON equip.id_tipo = tipo.id_tipo_equipamento
                    INNER JOIN tb_modelo_equipamento modelo
                        ON equip.id_modelo = modelo.id_modelo_equipamento
                    INNER JOIN tb_setor setor
                        ON alocar.id_setor = setor.id_setor
                WHERE alocar.id_usuario_adm = ? AND alocar.data_remover IS NULL' ;
        
        if ($idSetor != 0) {
            $sql .= ' AND alocar.id_setor = ?';
        }
        
        $sql .= ' ORDER BY tipo.nome_tipo_equipamento';
        return $sql;
    }
    
    public static function remover_equipamento_setor(){
        $sql = 'UPDATE tb_alocar SET data_remover = ? , situacao_alocar = ? WHERE id_alocar = ?';
        return $sql;
    }
    
       
}