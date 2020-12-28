<?php
require_once '../../vo/TipoEquipamentoVo.php';
require_once '../../controller/TipoEquipamentoController.php';
require_once '../../controller/UtilCTRL.php';
UtilCTRL::ver_tipo_logado(1);

$ctrl = new TipoEquipamentoController();

if (isset($_POST['btn_gravar'])) {
    $tipoEquip = new TipoEquipamentoVo();
    $tipoEquip->setNome($_POST['nome_tipo']);
    $ret = $ctrl->inserirTipoEquipamento($tipoEquip);
} else if (isset($_POST['btnAlterarTipoEquipamento'])) {
    $tipoEquip = new TipoEquipamentoVo();
    $tipoEquip->setId($_POST['id_alterar_tipo_equipamento']);
    $tipoEquip->setNome($_POST['nome_alterar_tipo_equipamento']);
    $ret = $ctrl->alterarTipoEquipamento($tipoEquip);
} else if (isset($_POST['btnExcluir'])) {
    $id = $_POST['id_excluir'];
    $ret = $ctrl->excluirTipoEquipamento($id);
}

$tipos_equipamentos = $ctrl->ConsultarTipoEquipamento();
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

                            <h2>Gerenciar tipo de equipamentos</h2>   
                            <h5>Aqui você gerencia todos os tipos de equipamentos cadastrados. </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->

                    <hr />
                    <form action="gerenciar_tipo_equipamento.php" method="POST">
                        <div class="form-group" id="divNomeTipoEquipamento">
                            <label>Nome do tipo</label>
                            <input onchange="return validarTela(3)"  class="form-control" name="nome_tipo" id="nome_tipo_equipamento" placeholder="Digite aqui...">
                                <label id="val-nome-tipo-equipamento" class="validar-campos"></label>    
                        </div>
                        <button onclick="return validarTela(3)" name="btn_gravar" class="btn  btn-success" >Salvar</button>
                    </form>

                    <hr/>

                    <div class="row">
                        <div class="col-md-12">

                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?= (count($tipos_equipamentos) <= 1) ? 'Tipo de equipamento cadastrado: <strong>' . count($tipos_equipamentos) . '</strong>' : 'Tipos de equipamentos cadastrados:  <strong> ' . count($tipos_equipamentos) . '</strong>' ?>  
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

                                                <?php for ($i = 0; $i < count($tipos_equipamentos); $i++) { ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $tipos_equipamentos[$i]['nome_tipo_equipamento'] ?></td>
                                                        <td>
                                                            <a onclick="carregarModalAlterarTipoEquipamento('<?= $tipos_equipamentos[$i]['id_tipo_equipamento'] ?>', '<?= $tipos_equipamentos[$i]['nome_tipo_equipamento'] ?>', 3)" data-toggle="modal" data-target="#modal_alterar_tipo_equipamento" href="#" class="btn btn-warning btn-xs">Alterar</a>
                                                            <a onclick="carregarModalExcluir('<?= $tipos_equipamentos[$i]['id_tipo_equipamento'] ?>', '<?= $tipos_equipamentos[$i]['nome_tipo_equipamento'] ?>')"  data-toggle="modal" data-target="#modal_excluir" href="#" class="btn btn-danger btn-xs">Excluir</a>   
                                                        </td>
                                                    </tr>

                                                <?php } ?>

                                            </tbody>
                                        </table>

                                        <form method="POST" action="gerenciar_tipo_equipamento.php">

                                            <?php include_once '../../template/_modal_excluir.php'; ?>

                                            <div class="modal fade" id="modal_alterar_tipo_equipamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Alterar tipo de equipamento</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_alterar_tipo_equipamento" id="id_alterar_tipo_equipamento" />
                                                            <div class="form-group" id="divAlterarNomeTipoEquipamento">
                                                                <label>Nome do tipo de equipamento</label>
                                                                <input  onchange="return validarTela(3)" class="form-control" name="nome_alterar_tipo_equipamento" id="nome_alterar_tipo_equipamento" />
                                                                <label class="validar-campos" id="val-nome-alterar"></label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button  type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                            <button onclick="return validarTela(3)" class="btn btn-success"  name="btnAlterarTipoEquipamento">Confirmar</button>
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
