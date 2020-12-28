<?php

class UtilCTRL {

    public static function iniciar_sessao() {
        if (!isset($_SESSION)) {
            return session_start();
        }
    }

    public static function criar_sessao($id_usuario, $tipo, $nome, $sobrenome, $id_setor) {

        self::iniciar_sessao();

        $_SESSION['id_user'] = $id_usuario;
        $_SESSION['tipo'] = $tipo;
        $_SESSION['nome'] = $nome . ' ' . $sobrenome;
        $_SESSION['id_setor'] = $id_setor;
    }

    public static function deslogar_sessao() {

        unset($_SESSION['id_user']);
        unset($_SESSION['tipo']);
        unset($_SESSION['nome']);
        unset($_SESSION['sobrenome']);
        unset($_SESSION['id_setor']);

        header('LOCATION: http://localhost/controleOS/acesso/login/login.php');
        exit;
    }

    public static function ver_logado() {

        self::iniciar_sessao();

        if (!isset($_SESSION['id_user'])) {
            header('LOCATION: http://localhost/controleOS/acesso/login/login.php');
            exit;
        }
    }

    public static function ver_tipo_logado($tipo) {

        self::iniciar_sessao();

        if ($_SESSION['tipo'] != $tipo) {
            header('LOCATION: http://localhost/controleOS/acesso/login/login.php');
        }
    }

    public static function nome_logado() {
        self::iniciar_sessao();
        return $_SESSION['nome'];
    }

    public static function tipo_logado() {
        self::iniciar_sessao();
        return $_SESSION['tipo'];
    }

    public static function setor_logado() {
        self::iniciar_sessao();
        return $_SESSION['id_setor'];
    }

    public static function codigoAdmLogado() {
        self::iniciar_sessao();
        return $_SESSION['id_user'];
    }

    private static function setFusoHorario() {
        date_default_timezone_set("America/Sao_Paulo");
    }

    public static function dataAtual() {
        self::setFusoHorario();
        return date('Y-m-d');
    }

    public static function disponivel() {
        return 1;
    }

    public static function indisponivel() {
        return 0;
    }

    public static function tipoUsuarioNome($tipo) {

        $nome = '';

        switch ($tipo) {
            case 1:
                $nome = "Administrador";
                break;
            case 2:
                $nome = "Funcionário";
                break;
            case 3:
                $nome = "Técnico";
                break;
        }

        return $nome;
    }

    public static function criarUsuarioLogin($nome, $sobrenome) {

        $sobrenomes = explode(" ", $sobrenome);

        if (count($sobrenomes) > 2) {

            $sobrenome = $sobrenomes[count($sobrenomes) - 1];
            
        }

        return strtolower($nome) . '.' . strtolower($sobrenome);
    }

    public static function senhaHash($nome, $sobrenome) {
        $senha = self::criarUsuarioLogin($nome, $sobrenome);
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    public static function validarSenha($senha, $senha_hash) {
        return password_verify($senha, $senha_hash);
    }
    
    public static function devolver_criptografado($senha) {
        return password_hash($senha, PASSWORD_DEFAULT);
    }
    
    public static function nome_situacao($sit) {
        
        $nome_situacao = '';
        
        switch ($sit) {
            case 1:
                
                $nome_situacao = 'Aguardando';
                    
                break;
            case 2:
                
                $nome_situacao = 'Atendimento';
                    
                break;
            case 3:
                
                $nome_situacao = 'Finalizado';
                    
                break;

        }
        
        return $nome_situacao;
        
    }
    
    public static function aguardando() {
       return 1; 
    }
    public static function atendimento() {
       return 2; 
    }
    public static function finalizado() {
       return 3; 
    }
    
    public static function retorna_data_formatada($data) {
        
        $dts = explode('-',$data);
        return $dts[2] . '/' . $dts[1] . '/' . $dts[0];
        
    }
    

}
