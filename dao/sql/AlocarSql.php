<?php

class AlocarSql {
    
    public static function inserir_alocar_equipamento(){
        $sql = 'INSERT INTO tb_alocar 
                (data_alocar, situacao_alocar, id_equipamento, id_setor,id_usuario_adm) VALUES (?, ?, ?, ?, ? )';
        return $sql;
    }
    
    public static function verificar_equipamento_alocado(){
        $sql = 'SELECT alocar.data_alocar, setor.nome_setor, alocar.data_remover, alocar.situacao_alocar, alocar.id_equipamento, alocar.id_setor FROM tb_alocar alocar
                    INNER JOIN tb_setor setor
                        ON alocar.id_setor = setor.id_setor
                    WHERE   alocar.id_equipamento = ? 
                        AND alocar.id_usuario_adm = ? 
                        AND alocar.situacao_alocar = ?';
        return $sql;
    }

    public static function relatorio_equip_alocados(){
        $sql = 'SELECT al.data_alocar, 
                        setor.nome_setor, 
                        al.data_remover,
                        equip.id_equipamento,
                        equip.identificacao_equipamento,
                        equip.descricao_equipamento
                FROM tb_alocar al
                     INNER JOIN tb_setor setor
                        ON al.id_setor = setor.id_setor
                     INNER JOIN tb_equipamento equip
                        ON al.id_equipamento = equip.id_equipamento
                WHERE al.id_equipamento = ?';

        return $sql;
    }
}
