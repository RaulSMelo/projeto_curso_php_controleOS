<?php

class UsuariosSql {

    public static function inserir_usuario() {
        $sql = 'INSERT INTO tb_usuario 
                    (nome_usuario, sobre_nome, login_usuario, senha_usuario, tipo_usuario, email_usuario, status_usuario) 
                        VALUES(?, ?, ?, ?, ?, ?, ?)';
        return $sql;
    }

    public static function inserir_funcionario() {
        $sql = 'INSERT INTO tb_funcionario 
                    (id_usuario_func,  tel_funcionario, endereco_funcionario, id_usuario_adm, id_setor) 
                        VALUES(?, ?, ?, ?, ?)';
        return $sql;
    }

    public static function inserir_tecnico() {
        $sql = 'INSERT INTO tb_tecnico 
                    (id_usuario_tec, tel_tecnico, endereco_tecnico, id_usuario_adm) 
                        VALUES(?, ?, ?, ?)';
        return $sql;
    }

    public static function validar_email($id) {

        $sql = 'SELECT COUNT(*) AS contar FROM tb_usuario WHERE email_usuario = ? ';

        if ($id != '') {
            $sql .= ' AND id_usuario <> ?';
        }

        return $sql;
    }

    public static function pesquisar_usuario_nome() {

        $sql = ' SELECT us.id_usuario,
                        us.nome_usuario,
                        us.sobre_nome,
                        us.tipo_usuario,
                        us.email_usuario,
                        func.tel_funcionario,
                        func.endereco_funcionario,
                        func.id_setor,
                        tec.tel_tecnico,
                        tec.endereco_tecnico
                        
                FROM tb_usuario us
                    LEFT JOIN tb_funcionario func
                        ON us.id_usuario = func.id_usuario_func
                    LEFT JOIN tb_tecnico tec
                        ON us.id_usuario = tec.id_usuario_tec
                    WHERE nome_usuario like ?
                    ORDER BY nome_usuario';

        return $sql;
    }

    public static function alterar_usuario_adm() {

        $sql = 'UPDATE tb_usuario 
                    SET nome_usuario = ?,
                        sobre_nome = ?, 
                        email_usuario = ? 
                    WHERE id_usuario = ? ';

        return $sql;
    }

    public static function alterar_funcionario() {

        $sql = 'UPDATE 
                    tb_funcionario 
                    SET 
                        tel_funcionario = ?, 
                        endereco_funcionario = ?, 
                        id_setor = ? 
                WHERE   id_usuario_func = ?';

        return $sql;
    }

    public static function alterar_tecnico() {

        $sql = 'UPDATE 
                      tb_tecnico 
                    SET   tel_tecnico = ?,
                          endereco_tecnico = ?
                WHERE id_usuario_tec = ?';

        return $sql;
    }

    public static function detalhar_usuario_adm() {

        $sql = 'SELECT  us.nome_usuario, 
                        us.sobre_nome,   
                        us.email_usuario,
                        func.tel_funcionario,
                        func.endereco_funcionario, 
                        func.id_setor,
                        tec.tel_tecnico, 
                        tec.endereco_tecnico 
                FROM tb_usuario us
                    LEFT JOIN tb_funcionario func
                        ON us.id_usuario = func.id_usuario_func
                    LEFT JOIN tb_tecnico tec
                        ON us.id_usuario = tec.id_usuario_tec
                    WHERE us.id_usuario = ?';

        return $sql;
    }

    public static function excluirUsuarioAdm() {
        $sql = 'DELETE FROM tb_usuario WHERE id_usuario = ?';
        return $sql;
    }

    public static function excluirFuncionario() {
        $sql = 'DELETE FROM tb_funcionario WHERE id_usuario_func = ? AND id_usuario_adm = ?';
        return $sql;
    }

    public static function excluirTecnico() {
        $sql = 'DELETE FROM tb_tecnico WHERE id_usuario_tec = ? AND id_usuario_adm = ?';
        return $sql;
    }

    /*********************************************************************************** */

    public static function validar_usuario() {
        $sql = 'SELECT  user.id_usuario, 
                        user.nome_usuario,
                        user.sobre_nome,
                        user.senha_usuario,
                        user.tipo_usuario , 
                        func.id_setor
                FROM tb_usuario user
                LEFT JOIN tb_funcionario func
                    ON user.id_usuario = func.id_usuario_func
                WHERE login_usuario = ? AND status_usuario = ?';
        return $sql;
    }

    public static function buscar_senha_atual() {

        $sql = 'SELECT  senha_usuario FROM tb_usuario WHERE id_usuario = ?';
        return $sql;
    }
    
    public static function alterar_senha_usuario() {

        $sql = 'UPDATE tb_usuario SET senha_usuario = ?  WHERE id_usuario = ?';
        return $sql;
    }

}
