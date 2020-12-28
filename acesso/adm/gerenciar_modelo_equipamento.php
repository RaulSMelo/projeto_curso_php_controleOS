<?php
require_once '../../controller/ModeloEquipamentoController.php';
require_once '../../vo/ModeloVo.php';
require_once '../../controller/UtilCTRL.php';
UtilCTRL::ver_tipo_logado(1);

$ctrl = new ModeloEquipamentoController();

if (isset($_POST['btn_gravar'])) {
    $modeloVo = new ModeloVo();
    $modeloVo->setNome($_POST['modelo']);
    $ret = $ctrl->inserirModeloEquipamento($modeloVo);
} else if (isset($_POST['btnExcluir'])) {
    $id = $_POST['id_excluir'];
    $ret = $ctrl->excluirModeloEquipamento($id);
} else if (isset($_POST['btn_alterar'])) {
    $modeloVo = new ModeloVo();
    $modeloVo->setNome($_POST['alterar_nome_modelo_equipamento']);
    $modeloVo->setId($_POST['id_alterar_modelo_equipamento']);
    $ret = $ctrl->alterarModeloEquipamento($modeloVo);
}

$modelos = $ctrl->consultarModeloEquipamento();
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
                            <h2>Gerenciar modelo de equipamentos</h2>   
                            <h5>Aqui você gerencia modelos cadastrados. </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <form action="gerenciar_modelo_equipamento.php" method="post">
                        <div class="form-group" id="divNomeModeloEquipamento">
                            <label>Nome do modelo</label>
                            <input onchange="return validarTela(4)" class="form-control"  name="modelo" id="modelo" placeholder="Digite aqui...">
                                <label id="val-nome-modelo" class="validar-campos"></label>
                        </div>
                        <button onclick="return validarTela(4)" name="btn_gravar" class="btn btn-success" >Salvar</button>
                    </form>

                    <hr/>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?= (count($modelos) <= 1) ? 'Modelo cadastrado: <strong>'. count($modelos) . '</strong>' : 'Modelos cadastrados:  <strong> ' . count($modelos) . '</strong>' ?>  
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($i = 0; $i < count($modelos); $i++) { ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $modelos[$i]['nome_modelo_equipamento'] ?></td>
                                                        <td>
                                                            <a onclick="carregarModalAlterarModeloEquipamento('<?= $modelos[$i]['id_modelo_equipamento'] ?>', '<?= $modelos[$i]['nome_modelo_equipamento'] ?>', 4)" href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal_alterar">Alterar</a>
                                                            <a onclick="carregarModalExcluir('<?= $modelos[$i]['id_modelo_equipamento'] ?>', '<?= $modelos[$i]['nome_modelo_equipamento'] ?>')" href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal_excluir">Excluir</a>   
                                                        </td> 
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                        <form method="POST" action="gerenciar_modelo_equipamento.php">
                                            <?php include_once '../../template/_modal_excluir.php'; ?>

                                            <div class="modal fade" id="modal_alterar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Alterar nome do modelo do equipamento</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_alterar_modelo_equipamento" id="id_alterar_modelo_equipamento" />
                                                            <div class="form-group" id="divAlterarModelo">
                                                                <label>Nome do modelo</label>
                                                                <input onchange="return validarTela(4)" class="form-control" name="alterar_nome_modelo_equipamento" id="alterar_nome_modelo_equipamento" />
                                                                <label id="val-nome-alterar-modelo" class="validar-campos"></label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                            <button onclick="return validarTela(4)" class="btn btn-success" name="btn_alterar">Confirmar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        </div>
                    </div>

                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>
