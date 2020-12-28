<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controleOS/controller/UtilCTRL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controleOS/controller/UsuarioController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controleOS/vo/FuncionarioVo.php';

UtilCTRL::ver_logado();
UtilCTRL::ver_tipo_logado(2);

$ctrl = new UsuarioController();

if (isset($_POST['btn_gravar'])) {

    $vo = new FuncionarioVo();
    
    $vo->setNome($_POST['nome']);
    $vo->setSobrenome($_POST['sobrenome']);
    $vo->setIdSetor(UtilCTRL::setor_logado());
    $vo->setEmail($_POST['email']);
    $vo->setTel($_POST['tel']);
    $vo->setEndereco($_POST['end']);
    $vo->setIdUser(UtilCTRL::codigoAdmLogado());

    $ret = $ctrl->alterarFuncionario($vo);
}

$dados = $ctrl->detalharUsuarioAdm(UtilCTRL::codigoAdmLogado());
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
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include_once '../../template/_msg.php'; ?>
                            <h2>Meus dados</h2>   
                            <h5>Aqui você pode cadastrar seus dados pessoais </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->

                    <hr />

                    <form method="POST" action="meus_dados.php">

                        <div class="col-md-6">
                            <div class="form-group" id="divNomeFunc">
                                <label>Nome</label>
                                <input readonly class="form-control" value="<?= $dados[0]['nome_usuario'] ?>" type="text" name="nome" id="nome" placeholder="Digite aqui..." />
                                <label id="val-nome-func" class="validar-campos"></label>
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group" id="divNomeFunc">
                                <label>Sobrenome</label>
                                <input readonly class="form-control" value="<?= $dados[0]['sobre_nome'] ?>" type="text" name="sobrenome" id="sobrenome" placeholder="Digite aqui..." />
                                <label id="val-nome-func" class="validar-campos"></label>
                            </div>
                        </div> 

                        <div class="col-md-12">
                            <div class="form-group" id="divEmailfunc">
                                <label>E-mail</label>
                                <input onchange="return validarTela(9)" value="<?= $dados[0]['email_usuario'] ?>" class="form-control" type="email" name="email" id="email" placeholder="Digite aqui..." />
                                <label id="val-email-func" class="validar-campos"></label>
                            </div>
                            <div class="form-group" id="divTelFunc">
                                <label>Telefone</label>
                                <input onchange="return validarTela(9)" value="<?= $dados[0]['tel_funcionario'] ?>" class="form-control" type="text" name="tel" id="tel" placeholder="Digite aqui..." />
                                <label id="val-tel-func" class="validar-campos"></label>
                            </div>
                            <div class="form-group" id="divEndFunc">
                                <label>Endereço</label>
                                <input onchange="return validarTela(9)" value="<?= $dados[0]['endereco_funcionario'] ?>" class="form-control" type="text" name="end" id="end" placeholder="Digite aqui..." />
                                <label id="val-end-func" class="validar-campos"></label>
                            </div>
                            <button onclick="return validarTela(9)" name="btn_gravar" class="btn btn-success">Gravar</button>
                        </div>
                    </form>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>




