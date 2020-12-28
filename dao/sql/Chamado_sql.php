<?php

class Chamado_sql {

    public static function carregar_equip_disponivel() {

        $sql = 'SELECT 
                    al.id_alocar,
                    al.id_equipamento,
                    equip.identificacao_equipamento,
                    equip.descricao_equipamento
                FROM tb_alocar al
                INNER JOIN tb_equipamento equip
                    ON al.id_equipamento = equip.id_equipamento
                WHERE al.situacao_alocar = ?
                AND al.id_setor = ?';

        return $sql;
    }

    public static function abrir_chamado() {

        $sql = 'INSERT INTO tb_chamado 
                            (data_abertura,
                             desc_chamado,
                             situacao_chamado,
                             id_usuario_func, 
                             id_equipamento)
                        VALUES(?, ?, ?, ?, ?)';

        return $sql;
    }

    public static function alterar_situacao_alocar() {
        $sql = 'UPDATE tb_alocar SET situacao_alocar = ? WHERE id_equipamento = ?';
        return $sql;
    }

    public static function chamados_setor($idSetor, $situacao) {
        $sql = 'SELECT 
                       ch.id_chamado,
                       ch.data_abertura,
                       us_fun.nome_usuario as func,
                       us_fun.sobre_nome as sobrenome_func,
                       ch.desc_chamado,
                       ch.data_atendimento,
                       us_tec.nome_usuario as tec,
                       us_tec.sobre_nome as sobrenome_tec,
                       ch.laudo_chamado,
                       ch.situacao_chamado,
                       equip.identificacao_equipamento,
                       equip.descricao_equipamento,
                       setor.nome_setor,
                       ch.data_encerramento
                FROM 
                    tb_chamado ch
                    
                    INNER JOIN tb_funcionario fun
                        ON ch.id_usuario_func = fun.id_usuario_func
                    INNER JOIN tb_usuario us_fun
                        ON fun.id_usuario_func = us_fun.id_usuario
                    LEFT JOIN tb_tecnico tec 
                        ON ch.id_usuario_tec = tec.id_usuario_tec
                    LEFT JOIN tb_usuario us_tec
                        ON tec.id_usuario_tec = us_tec.id_usuario
                    INNER JOIN tb_equipamento equip
                        ON ch.id_equipamento = equip.id_equipamento
                    INNER JOIN tb_alocar al
                        ON equip.id_equipamento = al.id_equipamento
                    INNER JOIN tb_setor setor
                        ON al.id_setor = setor.id_setor';
                    
        
                if($idSetor != '' && $situacao == 0){
                    $sql .= ' WHERE al.id_setor = ?';
                }else if($idSetor != '' && $situacao != 0){
                     $sql .= ' WHERE al.id_setor = ? AND ch.situacao_chamado = ?';
                }else if($idSetor == '' && $situacao != 0){
                    $sql .= ' WHERE ch.situacao_chamado = ?';
                }
                
        return $sql;
    }
    public static function detalhar_chamado_tecnico() {
        $sql = 'SELECT 
                       ch.id_chamado,
                       ch.data_abertura,
                       us_fun.nome_usuario as func,
                       us_fun.sobre_nome as sobrenome_func,
                       ch.desc_chamado,
                       ch.data_atendimento,
                       us_tec.nome_usuario as tec,
                       us_tec.sobre_nome as sobrenome_tec,
                       ch.laudo_chamado,
                       ch.situacao_chamado,
                       equip.identificacao_equipamento,
                       equip.descricao_equipamento,
                       setor.nome_setor,
                       ch.data_encerramento
                FROM 
                    tb_chamado ch
                    
                    INNER JOIN tb_funcionario fun
                        ON ch.id_usuario_func = fun.id_usuario_func
                    INNER JOIN tb_usuario us_fun
                        ON fun.id_usuario_func = us_fun.id_usuario
                    LEFT JOIN tb_tecnico tec 
                        ON ch.id_usuario_tec = tec.id_usuario_tec
                    LEFT JOIN tb_usuario us_tec
                        ON tec.id_usuario_tec = us_tec.id_usuario
                    INNER JOIN tb_equipamento equip
                        ON ch.id_equipamento = equip.id_equipamento
                    INNER JOIN tb_alocar al
                        ON equip.id_equipamento = al.id_equipamento
                    INNER JOIN tb_setor setor
                        ON al.id_setor = setor.id_setor

                WHERE ch.id_chamado = ?';

                
        return $sql;
    }
    
    public static function atender_chamado_tec (){
        $sql = 'UPDATE tb_chamado SET 
                                    data_atendimento = ?,
                                    situacao_chamado = ?, 
                                    id_usuario_tec = ?
                    WHERE id_chamado = ? ';
        return $sql;
    }
    
    public static function finalizar_chamado_tec (){
        $sql = 'UPDATE tb_chamado SET   
                                    laudo_chamado = ?, 
                                    situacao_chamado = ?, 
                                    id_usuario_tec = ?, 
                                    data_encerramento = ?
                    WHERE id_chamado = ? ';
        return $sql;
    }

    public static function grafico_chamado(){
        $sql = 'select
                (select count(*) from tb_chamado where situacao_chamado = ?) as aguardando,
                (select count(*) from tb_chamado where situacao_chamado = ?) as atendimento,
                (select count(*) from tb_chamado where situacao_chamado = ?) as finalizado;';
        return $sql;
    }

}
