<?php

require $_SERVER['DOCUMENT_ROOT'] . '/controleOS/dao/UsuariosDao.php';
require_once 'UtilCTRL.php';


class UsuarioController {

    public function inserirUsuarios(UsuarioVo $usuario) {

        if ($usuario->getNome() == '' ||
                $usuario->getSobrenome() == '' ||
                $usuario->getEmail() == '') {

            return $ret = 0;
        }

        $dao = new UsuariosDao();

        $usuario->setLogin(UtilCTRL::criarUsuarioLogin($usuario->getNome(), $usuario->getSobrenome()));
        $usuario->setSenha(UtilCTRL::senhaHash($usuario->getNome(), $usuario->getSobrenome()));
        $usuario->setStatus(UtilCTRL::disponivel());

        return $dao->inserirUsuario($usuario);
    }

    public function inserirFuncionario(FuncionarioVo $func) {

        if ($func->getNome() == '' ||
                $func->getSobrenome() == '' ||
                $func->getIdSetor() == '0' ||
                $func->getEmail() == '' ||
                $func->getTel() == '' ||
                $func->getEndereco() == '') {

            return $ret = 0;
        }

        $dao = new UsuariosDao();

        $func->setLogin(UtilCTRL::criarUsuarioLogin($func->getNome(), $func->getSobrenome()));
        $func->setSenha(UtilCTRL::senhaHash($func->getNome(), $func->getSobrenome()));
        $func->setStatus(UtilCTRL::disponivel());
        $func->setIdUserAdm(UtilCTRL::codigoAdmLogado());

        return $dao->inserirFuncionario($func);
    }

    public function inserirTecnico(TecnicoVO $tec) {

        if ($tec->getNome()      == '' ||
            $tec->getSobrenome() == '' ||
            $tec->getEmail()     == '' ||
            $tec->getTel()       == '' ||
            $tec->getEndereco()  == '') 
        {
            return $ret = 0;
        }

        $dao = new UsuariosDao();

        $tec->setLogin(UtilCTRL::criarUsuarioLogin($tec->getNome(), $tec->getSobrenome()));
        $tec->setSenha(UtilCTRL::senhaHash($tec->getNome(), $tec->getSobrenome()));
        $tec->setStatus(UtilCTRL::disponivel());
        $tec->setIdUserAdm(UtilCTRL::codigoAdmLogado());

        return $dao->inserirTecnico($tec);
    }

    public function consultarUsuarios($tipo) {
        $dao = new UsuariosDao();
        return $dao->consultarUsuarios($tipo, UtilCTRL::codigoAdmLogado(), UtilCTRL::disponivel());
    }

    public function detalharUsuario($idUsuario, $tipo) {
        $dao = new UsuariosDao();
        return $dao->detalharUsuario($tipo, UtilCTRL::disponivel(), UtilCTRL::codigoAdmLogado(), $idUsuario);
    }

    public function alterarUsuario($tipo, $idUsuario, $user) {
        $dao = new UsuariosDao();
        return $dao->alterarUsuario($idUsuario, UtilCTRL::codigoAdmLogado(), $tipo, $user);
    }

    public function excluirUsuario($tipo, $idUsuario) {
        $dao = new UsuariosDao();
        return $dao->excluirUsuario($tipo, UtilCTRL::indisponivel(), $idUsuario, UtilCTRL::codigoAdmLogado());
    }

    public function validarLoginUsuario($login, $senha) {
        $dao = new UsuariosDao();
        return $dao->ValidarUsuario($login, $senha, UtilCTRL::disponivel());
    }

    public function verificarEmailDuplicado($email, $id) {
        $dao = new UsuariosDao();
        $ret = $dao->verificarEmailDuplicado($email, $id);

        return $ret[0]['contar'];
    }

    public function pesquisarUsuarioNome($nome) {
        $dao = new UsuariosDao();
        return $dao->pesquisar_usuario_nome($nome);
    }

    public function alterarUsuarioAdm(UsuarioVo $usuario) {

        if ($usuario->getNome()      == '' ||
            $usuario->getSobrenome() == '' ||
            $usuario->getEmail()     == '') 
            {
                return $ret = 0;
            }

        $dao = new UsuariosDao();
        return $dao->alterarUsuarioADM($usuario);
    }

    public function alterarFuncionario(FuncionarioVo $func) {

        if ($func->getNome()      == '' ||
            $func->getSobrenome() == '' ||
            $func->getIdSetor()   == '' ||
            $func->getEmail()     == '' ||
            $func->getTel()       == '' ||
            $func->getEndereco()  == '') 
        {
            return $ret = 0;
        }
        
        $dao = new UsuariosDao();
        return $dao->alterarFuncionario($func);
    }

    public function alterarTecnico(TecnicoVO $tec) {

        if ($tec->getNome()      == '' ||
            $tec->getSobrenome() == '' ||
            $tec->getEmail()     == '' ||
            $tec->getTel()       == '' ||
            $tec->getEndereco()  == '') 
        {
            return $ret = 0;
        }

        $dao = new UsuariosDao();
        return $dao->alterarTecnico($tec);
    }

    public function detalharUsuarioAdm($idUsuario) {
        $dao = new UsuariosDao();
        return $dao->detalharUsuarioAdm($idUsuario);
    }

    public function excluirUsuarioAdm($idUsuario) {
        $dao = new UsuariosDao();
        return $dao->excluirUsuarioAdm($idUsuario);
    }

    public function excluirFuncionario($idFunc) {
        $dao = new UsuariosDao();
        return $dao->excluirFuncionario($idFunc, UtilCTRL::codigoAdmLogado());
    }

    public function excluirTecnico($idTec) {
        $dao = new UsuariosDao();
        return $dao->excluirTecnico($idTec, UtilCTRL::codigoAdmLogado());
    }

    public function validarUsuario($login, $senha) {

        if (trim($login) == '' || trim($senha) == '') {
            return 0;
        }
        $dao = new UsuariosDao();
        $dados = $dao->validarUsuario($login, UtilCTRL::disponivel());
        

        if (count($dados) > 0) {
            if (UtilCTRL::validarSenha($senha, $dados[0]['senha_usuario'])) {
                UtilCTRL::criar_sessao(
                        $dados[0]['id_usuario'], $dados[0]['tipo_usuario'], $dados[0]['nome_usuario'], $dados[0]['sobre_nome'], $dados[0]['id_setor']
                );

                switch ($dados[0]['tipo_usuario']) {
                    case '1':
                        header('LOCATION: http://localhost/controleOS/acesso/adm/consultar_usuario.php');
                        break;
                    case '2':
                        header('LOCATION: http://localhost/controleOS/acesso/funcionario/meus_chamados.php');
                        break;
                    case '3':
                        header('LOCATION: http://localhost/controleOS/acesso/tecnico/consultar_chamados.php');
                        break;
                }
            } else {
                return -7;
            }
        } else {
            return -7;
        }
    }

    public function alterarSenhaUsuario($senha_atual, $nova_senha, $repetir_senha) {
        
        if(trim($senha_atual)   == '' || 
           trim($nova_senha)    == '' || 
           trim($repetir_senha) == '')
        {
          return 0;  
        }
        
        $dao = new UsuariosDao();

        $senha_anterior = $dao->buscarSenhaAtual(UtilCTRL::codigoAdmLogado());

        if (!UtilCTRL::validarSenha($senha_atual, $senha_anterior[0]['senha_usuario'])) {
            return -8;
        } else if (strlen(trim($nova_senha)) < 6) {
            return -9;
        } else if (trim($nova_senha) != trim($repetir_senha)) {
            return -10;
        } else {
            
            $nova_senha = UtilCTRL::devolver_criptografado($nova_senha);
        
            return $dao->alterarSenhaUsuario(UtilCTRL::codigoAdmLogado(), $nova_senha);
        }
    }
}   