<?php

require_once '../../controller/UtilCTRL.php';
require_once '../../controller/UsuarioController.php';

    UtilCTRL::ver_logado();
    UtilCTRL::ver_tipo_logado(3);
    
    if(isset($_POST['btn_gravar'])){
        
        $ctrl = new UsuarioController();
        
        $ret = $ctrl->alterarSenhaUsuario($_POST['senha'], $_POST['novaSenha'], $_POST['repSenha']);
    }

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
                            <h2>Mudar senha</h2>   
                            <h5>Altere sua senha aqui</h5>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    
                    <hr />
                    
                    <form action="mudar_senha.php" method="POST">
                        <div class="form-group" id="divSenhaAtual-tec">
                            <label>Senha atual</label>
                            <input onchange="return validarTela(14)" class="form-control" type="password" name="senha" id="senha" placeholder="Digite aqui..." />
                            <label id="val-senha-atual-tec" class="validar-campos"></label>
                        </div>
                        <div class="form-group" id="divNovaSenha-tec">
                            <label>Nova senha</label>
                            <input onchange="return validarTela(14)" class="form-control" type="password" name="novaSenha" id="novaSenha" placeholder="Digite aqui..." />
                            <label id="val-nova-senha-tec" class="validar-campos"></label>
                        </div>
                        <div class="form-group" id="divRepSenha-tec">
                            <label>Repetir senha</label>
                            <input onchange="return validarTela(14)" class="form-control" type="password" name="repSenha" id="repSenha" placeholder="Digite aqui..." />
                            <label id="val-rep-senha-tec" class="validar-campos"></label>
                        </div>

                        <button onclick="return validarTela(14)" name="btn_gravar" class="btn btn-success">Gravar</button>
                    </form>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>




