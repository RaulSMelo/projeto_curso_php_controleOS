<?php
require_once '../../controller/SetorController.php';
require_once '../../controller/UsuarioController.php';
require_once '../../controller/UtilCTRL.php';
require_once '../../vo/UsuarioVo.php';
require_once '../../vo/FuncionarioVo.php';
require_once '../../vo/TecnicoVO.php';

UtilCTRL::ver_tipo_logado(1);

$ctrl_setor = new SetorController();
$ctrl_usuario = new UsuarioController();

if (isset($_POST['btn_gravar'])) {

    $tipo = $_POST['tipo'];

    switch ($tipo) {
        case 1:

            $usuario = new UsuarioVo();

            $usuario->setNome($_POST['nome']);
            $usuario->setSobrenome($_POST['sobrenome']);
            $usuario->setEmail($_POST['email']);
            $usuario->setTipo($tipo);

            $ret = $ctrl_usuario->inserirUsuarios($usuario);

            break;
        case 2:

            $func = new FuncionarioVo();

            $func->setNome($_POST['nome']);
            $func->setSobrenome($_POST['sobrenome']);
            $func->setIdSetor($_POST['setor']);
            $func->setEmail($_POST['email']);
            $func->setTel($_POST['tel']);
            $func->setEndereco($_POST['end']);
            $func->setTipo($tipo);

            $ret = $ctrl_usuario->inserirFuncionario($func);

            break;
        case 3:

            $tec = new TecnicoVO();

            $tec->setNome($_POST['nome']);
            $tec->setSobrenome($_POST['sobrenome']);
            $tec->setEmail($_POST['email']);
            $tec->setTel($_POST['tel']);
            $tec->setEndereco($_POST['end']);
            $tec->setTipo($tipo);

            $ret = $ctrl_usuario->inserirTecnico($tec);

            break;
    }
}
$setores = $ctrl_setor->consultarSetor();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        include_once '../../template/_head.php';
        ?>
    </head>
    <body>
        <div id="wrapper">
            <?php
            include_once '../../template/_topo.php';
            include_once '../../template/_menu.php';
            ?>
            <div id="page-wrapper" >
                <div class="<?= isset($dados) ? 'bg-alterar' : '' ?>"  id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include_once '../../template/_msg.php'; ?>
                            <h2>Cadastrar</h2>   
                            <h5>Aqui você pode Cadastrar um novo usuário </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->

                    <hr />
                    <form action="novo_usuario.php" method="POST">
                        <div class="form-group" id="divTipoUsuario">

                            <label>Selecione o tipo de usuário</label>
                            <select onchange="exibirCamposPorTipoUsuario()"  class="form-control"  name="tipo" id="tipo">
                                <option value="0">Selecione...</option>
                                <option value="1" <?= isset($dados) ? ($dados[0]['tipo_usuario'] == $tiposUsuarios[$i]['id_tipo_usuario'] ? 'selected' : '') : '' ?> >Administrador</option>
                                <option value="2" <?= isset($dados) ? ($dados[0]['tipo_usuario'] == $tiposUsuarios[$i]['id_tipo_usuario'] ? 'selected' : '') : '' ?> >Funcionário</option>
                                <option value="3" <?= isset($dados) ? ($dados[0]['tipo_usuario'] == $tiposUsuarios[$i]['id_tipo_usuario'] ? 'selected' : '') : '' ?> >Técnico</option>
                            </select>
                            <label id="val-tipo-usuario" class="validar-campos"></label>
                        </div>

                        <div class="form-group" id="divNomeUsuario" style="display: none">
                            <label>Nome</label>
                            <input onchange="return validarTela(7)" class="form-control" name="nome" id="nome" placeholder="Digite aqui..."/>
                            <label id="val-nome-usuario" class="validar-campos"></label>
                        </div>
                        <div class="form-group" id="divSobrenomeUsuario" style="display: none">
                            <label>Sobrenome</label>
                            <input onchange="return validarTela(7)" class="form-control" name="sobrenome" id="sobrenome" placeholder="Digite aqui..." value="<?= isset($dados) ? $dados[0]['sobre_nome'] : '' ?>" />
                            <label id="val-sobrenome-usuario" class="validar-campos"></label>
                        </div>
                        <div class="form-group" id="divSetorUsuario" style="display: none">
                            <label>Setor</label>
                            <select onchange="return validarTela(7)" class="form-control" name="setor" id="setor">
                                <option value="0">Selecione...</option>
                                <?php for ($i = 0; $i < count($setores); $i++) { ?>
                                    <option value="<?= $setores[$i]['id_setor'] ?>" <?= isset($dados) && isset($dados[0]['id_setor']) ? ($dados[0]['id_setor'] == $setores[$i]['id_setor'] ? 'selected' : '') : '' ?> > <?= $setores[$i]['nome_setor'] ?></option>
                                <?php } ?>    
                            </select>
                            <label id="val-setor-usuario" class="validar-campos"></label>
                        </div>
                        <div class="form-group" id="divEmailUsuario" style="display: none">
                            <label>E-mail</label>
                            <input onchange="validarEmail()" class="form-control" type="email" name="email" id="email" placeholder="Digite aqui..." />
                            <label id="val-email-usuario" class="validar-campos"></label>
                            <div id="mensagem-erro"></div>
                        </div>
                        <div class="form-group" id="divTelefoneUsuario" style="display: none">
                            <label>Telefone</label>
                            <input onchange="return validarTela(7)" class="form-control" type="text" name="tel" id="tel" placeholder="Digite aqui..." />
                            <label id="val-telefone-usuario" class="validar-campos"></label>
                        </div>
                        <div class="form-group" id="divEnderecoUsuario" style="display: none">
                            <label>Endereço</label>
                            <input onchange="return validarTela(7)" class="form-control" type="text" name="end" id="end" placeholder="Digite aqui..." />
                            <label id="val-endereco-usuario" class="validar-campos"></label>
                        </div>
                        <button style="display: none" id="btn_gravar_usuario" onclick="return validarTela(7)" name="btn_gravar" class="btn btn-success">Gravar</button>
                    </form>

                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>




