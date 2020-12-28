<?php

class Setor_sql {
    
    public static function inserir_setor(){
        $sql = 'insert into tb_setor (nome_setor, id_usuario_adm) values (? , ?)';
         return $sql;      
    }
    
    public static function consultar_setor(){
        $sql = 'select id_setor, nome_setor from tb_setor where id_usuario_adm = ? ORDER BY nome_setor';
        return $sql;
    }
    
    public static function excluir_setor(){
        $sql = 'delete from tb_setor where id_setor = ?';
        return $sql;
    }
    
    public static function alterar_setor() {
        $sql = 'update tb_setor set nome_setor = ? where id_setor = ?';
        return $sql;
    }
           
   
}
