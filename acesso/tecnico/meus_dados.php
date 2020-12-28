<?php

require_once '../../controller/UtilCTRL.php';
require_once '../../controller/UsuarioController.php';
require_once '../../vo/TecnicoVO.php';

UtilCTRL::ver_logado();
UtilCTRL::ver_tipo_logado(3);

    $ctrl_tec = new UsuarioController();
    
    if(isset($_POST['btn_gravar'])){
        
        $vo = new TecnicoVO();
        
        $vo->setNome($_POST['nome']);
        $vo->setSobrenome($_POST['sobrenome']);
        $vo->setEmail($_POST['email']);
        $vo->setTel($_POST['tel']);
        $vo->setEndereco($_POST['end']);
        $vo->setIdUser(UtilCTRL::codigoAdmLogado());
        
        $ret = $ctrl_tec->alterarTecnico($vo);
    }




    $dados = $ctrl_tec->detalharUsuarioAdm(UtilCTRL::codigoAdmLogado());

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
                    <form action="meus_dados.php" method="POST">
                        
                        <div class="col-md-6">
                            <div class="form-group" id="divNomeTec">
                                <label>Nome</label>
                                <input readonly  value="<?= $dados[0]['nome_usuario'] ?>"  class="form-control" type="text" name="nome" id="nome" placeholder="Digite aqui..." />
                                <label id="val-nome-tec" class="validar-campos"></label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" id="divNomeTec">
                                <label>Sobrenome</label>
                                <input readonly value="<?= $dados[0]['sobre_nome'] ?>"  class="form-control" type="text" name="sobrenome" id="sobrenome" placeholder="Digite aqui..." />
                                <label id="val-nome-tec" class="validar-campos"></label>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group" id="divEmailTec">
                                <label>E-mail</label>
                                <input onchange="return validarTela(13)" value="<?= $dados[0]['email_usuario'] ?>"  class="form-control" type="email" name="email" id="email" placeholder="Digite aqui..." />
                                <label id="val-email-tec" class="validar-campos"></label>
                            </div>
                            <div class="form-group" id="divTelTec">
                                <label>Telefone</label>
                                <input onchange="return validarTela(13)" value=" <?= $dados[0]['tel_tecnico'] ?> "  class="form-control" type="text" name="tel" id="tel" placeholder="Digite aqui..." />
                                <label id="val-tel-tec" class="validar-campos"></label>
                            </div>
                            <div class="form-group" id="divEndTec">
                                <label>Endereço</label>
                                <input onchange="return validarTela(13)" value="<?= $dados[0]['endereco_tecnico'] ?>" class="form-control" type="text" name="end" id="end" placeholder="Digite aqui..." />
                                <label id="val-end-tec" class="validar-campos"></label>
                            </div>
                            
                            <button onclick="return validarTela(13)" name="btn_gravar" class="btn btn-success">Gravar</button>
                       
                        </div>
                    </form>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>




