
<?php

    require_once '../../controller/UsuarioController.php';
    
    if(isset($_POST['btn_logar'])){
        $user_controller = new UsuarioController;
        
       $ret = $user_controller->validarUsuario($_POST['login'], $_POST['senha']);
       
       echo $ret;
    }

?>


<!DOCTYPE html>
<html pt="pt-br">
    <head>
        <?php include_once '../../template/_head.php'; ?>

    </head>
    <body>
        <div class="container">
            <div class="row text-center ">
                <div class="col-md-12">
                    <br /><br />
                    <h2> Acesso - controle OS</h2>
                    <br />
                </div>
            </div>
            <div class="row ">

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>  Entre com seus dados </strong>  
                        </div>
                        <div class="panel-body">
                            <?php include_once '../../template/_msg.php'; ?>
                            <form action="login.php" method="POST">
                                <br />
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                    <input type="text" name="login" id="login" class="form-control" placeholder="Seu login " />
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <input type="password" name="senha" id="senha" class="form-control"  placeholder="Sua senha" />
                                </div>

                                <button name="btn_logar" id="btn_logar" class="btn btn-primary ">Acessar</button>

                            </form>
                        </div>

                    </div>
                </div>


            </div>
        </div>

    </body>
</html>


