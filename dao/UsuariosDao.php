<?php

require_once 'Conexao.php';
require_once 'sql/UsuariosSql.php';

class UsuariosDao extends Conexao {

    public function inserirUsuario(UsuarioVo $usuario) {

        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::inserir_usuario());
        $i = 1;
        $sql->bindValue($i++, $usuario->getNome());
        $sql->bindValue($i++, $usuario->getSobrenome());
        $sql->bindValue($i++, $usuario->getLogin());
        $sql->bindValue($i++, $usuario->getSenha());
        $sql->bindValue($i++, $usuario->getTipo());
        $sql->bindValue($i++, $usuario->getEmail());
        $sql->bindValue($i++, $usuario->getStatus());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
            $e->getMessage();
            return -1;
        }
    }

    public function inserirFuncionario(FuncionarioVo $func) {

        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::inserir_usuario());
        $i = 1;
        $sql->bindValue($i++, $func->getNome());
        $sql->bindValue($i++, $func->getSobrenome());
        $sql->bindValue($i++, $func->getLogin());
        $sql->bindValue($i++, $func->getSenha());
        $sql->bindValue($i++, $func->getTipo());
        $sql->bindValue($i++, $func->getEmail());
        $sql->bindValue($i++, $func->getStatus());

        $conexao->beginTransaction();

        try {

            $sql->execute();

            $sql = $conexao->prepare(UsuariosSql::inserir_funcionario());
            $i = 1;
            $sql->bindValue($i++, $conexao->lastInsertId());
            $sql->bindValue($i++, $func->getTel());
            $sql->bindValue($i++, $func->getEndereco());
            $sql->bindValue($i++, $func->getIdUserAdm());
            $sql->bindValue($i++, $func->getIdSetor());

            $sql->execute();

            $conexao->commit();

            return 1;
        } catch (Exception $e) {
            $conexao->rollBack();
            $e->getMessage();
            return -1;
        }
    }

    public function inserirTecnico(TecnicoVO $tec) {

        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::inserir_usuario());
        $i = 1;
        $sql->bindValue($i++, $tec->getNome());
        $sql->bindValue($i++, $tec->getSobrenome());
        $sql->bindValue($i++, $tec->getLogin());
        $sql->bindValue($i++, $tec->getSenha());
        $sql->bindValue($i++, $tec->getTipo());
        $sql->bindValue($i++, $tec->getEmail());
        $sql->bindValue($i++, $tec->getStatus());

        $conexao->beginTransaction();

        try {
            $sql->execute();

            $sql = $conexao->prepare(UsuariosSql::inserir_tecnico());
            $i = 1;
            $sql->bindValue($i++, $conexao->lastInsertId());
            $sql->bindValue($i++, $tec->getTel());
            $sql->bindValue($i++, $tec->getEndereco());
            $sql->bindValue($i++, $tec->getIdUserAdm());

            $sql->execute();

            $conexao->commit();
            return 1;
        } catch (Exception $e) {
            $conexao->rollBack();
            $e->getMessage();
            return -1;
        }
    }

    public function consultarUsuarios($tipo, $codAdmLogado, $status) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::consultar_usuario($tipo));
        $sql->bindValue(1, $codAdmLogado);
        $sql->bindValue(2, $tipo);
        $sql->bindValue(3, $status);

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function detalharUsuario($tipo, $status, $codUsuarioLogado, $idUsuario) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::detalhar_usuario($tipo));
        $sql->bindValue(1, $status);
        $sql->bindValue(2, $codUsuarioLogado);
        $sql->bindValue(3, $idUsuario);

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluirUsuario($tipo, $status, $idUsuario, $codUsuarioLogado) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::excluir_usuario($tipo));
        $sql->bindValue(1, $status);
        $sql->bindValue(2, $idUsuario);
        $sql->bindValue(3, $codUsuarioLogado);

        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return -1;
        }
    }

//    public function ValidarUsuario($login, $senha, $status) {
//        $conexao = parent::retornaConexao();
//        $sql = new PDOStatement();
//        $sql = $conexao->prepare(UsuariosSql::validar_usuario());
//        $sql->bindValue(1, $login);
//        $sql->bindValue(2, $senha);
//        $sql->bindValue(3, $status);
//
//        try {
//            $sql->execute();
//            return $sql->fetchAll(PDO::FETCH_ASSOC);
//        } catch (Exception $e) {
//            echo $e->getMessage();
//            return -1;
//        }
//    }

    public function verificarEmailDuplicado($email, $id) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::validar_email($id));
        $sql->bindValue(1, $email);

        if ($id != '') {
            $sql->bindValue(2, $id);
        }

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pesquisar_usuario_nome($nome) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::pesquisar_usuario_nome());
        $sql->bindValue(1, '%' . $nome . '%');

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function alterarUsuarioADM(UsuarioVo $usuario) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::alterar_usuario_adm());
        $i = 1;
        $sql->bindValue($i++, $usuario->getNome());
        $sql->bindValue($i++, $usuario->getSobrenome());
        $sql->bindValue($i++, $usuario->getEmail());
        $sql->bindValue($i++, $usuario->getIdUser());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
            $e->getMessage();
            return -1;
        }
    }

    public function alterarFuncionario(FuncionarioVo $func) {

        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::alterar_usuario_adm());
        $i = 1;
        $sql->bindValue($i++, $func->getNome());
        $sql->bindValue($i++, $func->getSobrenome());
        $sql->bindValue($i++, $func->getEmail());
        $sql->bindValue($i++, $func->getIdUser());

        $conexao->beginTransaction();

        try {
            $sql->execute();

            $sql = $conexao->prepare(UsuariosSql::alterar_funcionario());
            $i = 1;
            $sql->bindValue($i++, $func->getTel());
            $sql->bindValue($i++, $func->getEndereco());
            $sql->bindValue($i++, $func->getIdSetor());
            $sql->bindValue($i++, $func->getIdUser());
            $sql->execute();

            $conexao->commit();

            return 1;
        } catch (Exception $e) {
            $conexao->rollBack();
            $e->getMessage();
            return -1;
        }
    }

    public function alterarTecnico(TecnicoVO $tec) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::alterar_usuario_adm());
        $i = 1;
        $sql->bindValue($i++, $tec->getNome());
        $sql->bindValue($i++, $tec->getSobrenome());
        $sql->bindValue($i++, $tec->getEmail());
        $sql->bindValue($i++, $tec->getIdUser());

        $conexao->beginTransaction();

        try {
            $sql->execute();

            $sql = $conexao->prepare(UsuariosSql::alterar_tecnico());
            $i = 1;
            $sql->bindValue($i++, $tec->getTel());
            $sql->bindValue($i++, $tec->getEndereco());
            $sql->bindValue($i++, $tec->getIdUser());

            $sql->execute();

            $conexao->commit();

            return 1;
        } catch (Exception $e) {
            $conexao->rollBack();
            $e->getMessage();
            return -1;
        }
    }

    public function detalharUsuarioAdm($idUsuario) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::detalhar_usuario_adm());
        $sql->bindValue(1, $idUsuario);

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluirUsuarioAdm($idUsuario) {

        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::excluirUsuarioAdm());
        $sql->bindValue(1, $idUsuario);

        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
            $e->getMessage();
            return -1;
        }
    }

    public function excluirFuncionario($idfunc, $idUsuarioAdm) {

        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::excluirFuncionario());
        $sql->bindValue(1, $idfunc);
        $sql->bindValue(2, $idUsuarioAdm);

        $conexao->beginTransaction();

        try {
            $sql->execute();
            $sql = $conexao->prepare(UsuariosSql::excluirUsuarioAdm());
            $sql->bindValue(1, $idfunc);
            $sql->execute();

            $conexao->commit();

            return 1;
        } catch (Exception $e) {
            $conexao->rollBack();
            $e->getMessage();
            return -1;
        }
    }

    public function excluirTecnico($idTec, $idUsuarioAdm) {

        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::excluirTecnico());
        $sql->bindValue(1, $idTec);
        $sql->bindValue(2, $idUsuarioAdm);

        $conexao->beginTransaction();

        try {
            $sql->execute();

            $sql = $conexao->prepare(UsuariosSql::excluirUsuarioAdm());
            $sql->bindValue(1, $idTec);
            $sql->execute();

            $conexao->commit();

            return 1;
        } catch (Exception $e) {
            $conexao->rollBack();
            $e->getMessage();
            return -1;
        }
    }

    public function validarUsuario($login, $status) {

        
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::validar_usuario());
        $sql->bindValue(1, $login);
        $sql->bindValue(2, $status);

        $sql->execute();
        
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarSenhaAtual($idUser) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::buscar_senha_atual());
        $sql->bindValue(1, $idUser);

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function alterarSenhaUsuario($idUser, $nova_senha) {
        $conexao = parent::retornaConexao();
        $sql = new PDOStatement();
        $sql = $conexao->prepare(UsuariosSql::alterar_senha_usuario());
        $sql->bindValue(1, $nova_senha);
        $sql->bindValue(2, $idUser);

        $sql->execute();

        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
            $e->getMessage();
            return -1;
        }
    }

}
