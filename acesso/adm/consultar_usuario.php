<?php

    require_once  '../../controller/UtilCTRL.php';
    require_once '../../controller/UsuarioController.php';
    require_once '../../controller/SetorController.php';
    require_once '../../vo/UsuarioVo.php';
    require_once '../../vo/FuncionarioVo.php';
    require_once '../../vo/TecnicoVO.php';

    UtilCTRL::ver_logado();
    UtilCTRL::ver_tipo_logado(1);
    
    $ctrlSetor = new SetorController();
    $ctrl_usuario = new UsuarioController();
    
    if(isset($_POST['btn_pesquisar'])){
        
        $nome = $_POST['nome_usuario'];
        
        $users = $ctrl_usuario->pesquisarUsuarioNome($nome);
        
        //var_dump($users);exit;
        
        $ret = (count($users) > 0) ? null : -6 ;
        
    }
    
    
    if(isset($_POST['btn_alterar_usuario'])){
        
        $tipo = $_POST['tipo'];
        
        switch ($tipo) {
            case 1:
                
                $usuario = new UsuarioVo();
                $usuario->setNome($_POST['nome']);
                $usuario->setSobrenome($_POST['sobrenome']);
                $usuario->setEmail($_POST['email']);
                $usuario->setIdUser($_POST['id_usuario']);
                
                $ret = $ctrl_usuario->alterarUsuarioAdm($usuario);

                break;
            case 2:
                
                $func = new FuncionarioVo();
                $func->setNome($_POST['nome']);
                $func->setSobrenome($_POST['sobrenome']);
                $func->setEmail($_POST['email']);
                $func->setIdSetor($_POST['setor']);
                $func->setTel($_POST['tel']);
                $func->setEndereco($_POST['end']);
                $func->setIdUser($_POST['id_usuario']);
                
                
                $ret = $ctrl_usuario->alterarFuncionario($func);
                

                break;
            case 3:
                
                $tec = new TecnicoVO();
                $tec->setNome($_POST['nome']);
                $tec->setSobrenome($_POST['sobrenome']);
                $tec->setEmail($_POST['email']);
                $tec->setTel($_POST['tel']);
                $tec->setEndereco($_POST['end']);
                $tec->setIdUser($_POST['id_usuario']);
                
                $ret = $ctrl_usuario->alterarTecnico($tec);


                break;

        }
        
    }
    
    if(isset($_POST['btnExcluir'])){
        
        echo $_POST['id_excluir'] . "<br>";
        
        $dados = explode(' ', $_POST['id_excluir']);
        $idUsuario = (int) $dados[0];
        $tipo = (int) $dados[1];
        
        switch ($tipo) {
            case 1:

                $ret = $ctrl_usuario->excluirUsuarioAdm($idUsuario);
                
                break;
            case 2:

                $ret = $ctrl_usuario->excluirFuncionario($idUsuario);
                
                break;
            case 3:

                $ret = $ctrl_usuario->excluirTecnico($idUsuario);

                break;

        }
        
        
    }
 
    $setores = $ctrlSetor->consultarSetor();

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
                            <h2>Consultar usuários</h2>   
                            <h5>Aqui você podera consultar / alterar/ excluir todos os usuários cadastrados </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    
                    <form action="consultar_usuario.php" method="POST">
                        <div class="form-group" id="divUsuarioConsultar">
                            <label>Digite o nome do usuário</label>
                            <input class="form-control" id="usuario-consultar" name="nome_usuario">
                            <label id="val-usuario-consultar" class="validar-campos"></label>
                        </div>

                        <button onclick="return validarTela(8)" name="btn_pesquisar" class="btn btn-info">Pesquisar</button>
                    </form>


                    <hr/>
                    <?php if(isset($users) && count($users) > 0){ ?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?= (count($users) <= 1) ? 'Usuário cadastrado: <strong>'. count($users) . '</strong>' : 'Usuários cadastrados:  <strong> ' . count($users) . '</strong>' ?>  
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Tipo</th>
                                                    <th>Email</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for($i = 0; $i < count($users); $i++){ 
                                                    
                                                    $id = $users[$i]['id_usuario'];
                                                    $nome = $users[$i]['nome_usuario'];
                                                    $sobrenome = $users[$i]['sobre_nome'];
                                                    $tipo = $users[$i]['tipo_usuario'];
                                                    $email = $users[$i]['email_usuario'];
                                                    $setor = $users[$i]['id_setor'];
                                                    $tel = ($users[$i]['tipo_usuario'] == 2) ? $users[$i]['tel_funcionario'] : $users[$i]['tel_tecnico'];
                                                    $endereco = ($users[$i]['tipo_usuario'] == 2) ? $users[$i]['endereco_funcionario'] : $users[$i]['endereco_tecnico'];
                                                    
                                                ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $users[$i]['nome_usuario'] . ' ' . $users[$i]['sobre_nome'] ?></td>
                                                         <td><?= UtilCTRL::tipoUsuarioNome($users[$i]['tipo_usuario']) ?></td>
                                                        <td><?= $users[$i]['email_usuario'] ?></td>
                                                        <td>
                                                            <a onclick="carregar_modal_alterar_usuario('<?= $id ?>','<?= $nome ?>','<?= $sobrenome ?>','<?= $tipo ?>','<?= $email ?>','<?= $tel ?>','<?= $endereco ?>', '<?= $setor ?>')" data-toggle="modal" data-target="#modal_alterar_usuario" class="btn btn-warning btn-xs">Alterar</a>
                                                            <a onclick="carregarModalExcluirUsuario('<?= $id ?>', '<?= $tipo ?>', '<?= $nome . ' ' . $sobrenome ?>')" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal_excluir">Excluir</a>   
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        </div>
                    </div>
                    <?php }?>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        
        <form action="consultar_usuario.php" method="POST">
            
            <?php include_once '../../template/_modal_excluir.php'; ?>

            <div class="modal fade" id="modal_alterar_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Alterar usuário</h4>
                        </div>
                        
                        <div class="modal-body">
                            
                            <input type="hidden" name="id_usuario" id="id_usuario" />
                            <input type="hidden" name="tipo" id="id_tipo" />

                            <div  class="form-group" id="divNomeUsuario_alterar">
                                <label>Nome</label>
                                <input onchange="validarTela(15)" class="form-control" name="nome" id="nome-alterar-usuario"/>
                                <label class="validar-campos" id="val-nome-alterar"></label>
                            </div>
                            
                            <div  class="form-group" id="divSobrenomeUsuario_alterar">
                                <label>Sobrenome</label>
                                <input onchange="validarTela(15)" class="form-control" name="sobrenome" id="sobrenome-alterar-usuario"/>
                                <label class="validar-campos" id="val-sobrenome-alterar"></label>
                            </div>
                            
                            <div  class="form-group" id="divSetorUsuario_alterar">
                                <label>Setor</label>
                                <select class="form-control" name="setor" id="setor-alterar-usuario">
                                    <?php for($i = 0; $i < count($setores); $i++){ ?>
                                        <option value="<?= $setores[$i]['id_setor']?>"><?= $setores[$i]['nome_setor'] ?></option>
                                    <?php } ?>
                                </select>
                                <label class="validar-campos" id="val-setor-alterar"></label>
                            </div>
                            
                            <div  class="form-group" id="divEmailUsuario_alterar">
                                <label>Email</label>
                                <input onchange="validarEmail()" class="form-control" name="email" id="email-alterar-usuario"/>
                                <div id="mensagem-erro"></div>
                                <label class="validar-campos" id="val-email-alterar"></label>
                            </div>
                            
                            <div  class="form-group" id="divTelefoneUsuario_alterar">
                                <label>Telefone</label>
                                <input onchange="validarTela(15)" class="form-control" name="tel" id="tel-alterar-usuario"/>
                                <label class="validar-campos" id="val-tel-alterar"></label>
                            </div>
                            
                            <div  class="form-group" id="divEnderecoUsuario_alterar">
                                <label>Endereço</label>
                                <input onchange="validarTela(15)" class="form-control" name="end" id="end-alterar-usuario"/>
                                <label class="validar-campos" id="val-end-alterar"></label>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button onclick="return validarTela(15)" class="btn btn-warning" name="btn_alterar_usuario">Alterar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
    </body>
</html>





