<?php
require_once'../../controller/SetorController.php';
require_once '../../vo/SetorVo.php';
require_once '../../controller/UtilCTRL.php';
UtilCTRL::ver_tipo_logado(1);

$ctrl = new SetorController();

if (isset($_POST ['btn_gravar'])) {

    $v = new SetorVo();
    $v->setNome($_POST['setor']);
    $ret = $ctrl->InserirSetor($v);
} else if (isset($_POST['btnExcluir'])) {
    $id = $_POST['id_excluir'];
    $ret = $ctrl->excluirSetor($id);
} else if (isset($_POST['btnAlterar'])) {
    $setorVo = new SetorVo();
    $setorVo->setId($_POST['id_alterar']);
    $setorVo->setNome($_POST['nome_alterar']);
    $ret = $ctrl->alterarSetor($setorVo);
}

$setores = $ctrl->consultarSetor();
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

                            <h2>Gerenciar setor</h2>   
                            <h5>Aqui você gerencia todos setores cadastrados. </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <form method="post" action="gerenciar_setor.php">

                        <div class="form-group" id="divNome">
                            <label>Nome do setor</label>
                            <input onchange="return validarTela(1)" class="form-control"  placeholder="Digite aqui..." name="setor" id="setor"/>
                            <label id="val-nome" class="validar-campos"></label>
                        </div>

                        <button name="btn_gravar" onclick="return validarTela(1)" class="btn  btn-success" >Gravar</button>
                    </form>
                    <hr/>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?= (count($setores) <= 1) ? 'Setor cadastrado: <strong>'. count($setores) . '</strong>' : 'Setores cadastrados:  <strong> ' . count($setores) . '</strong>' ?>  
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

                                                <?php for ($i = 0; $i < count($setores); $i++) { ?>
                                                    <tr class="odd gradeX">

                                                        <td><?= $setores[$i]['nome_setor'] ?></td>
                                                        <td>
                                                            <a onclick="carregarModalAlterarSetor('<?= $setores[$i]['id_setor'] ?>', '<?= $setores[$i]['nome_setor'] ?>', 1)" href="#" data-toggle="modal" data-target="#modal_alterar" class="btn btn-warning btn-xs">Alterar</a>
                                                            <a onclick="carregarModalExcluir('<?= $setores[$i]['id_setor'] ?>', '<?= $setores[$i]['nome_setor'] ?>')" href="#" data-toggle="modal" data-target="#modal_excluir" class="btn btn-danger btn-xs">Excluir</a>   
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                        <form method="POST" action="gerenciar_setor.php">
                                            <?php include_once '../../template/_modal_excluir.php'; ?>

                                            <div class="modal fade" id="modal_alterar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Alterar setor</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_alterar" id="id_alterar" />
                                                            <div class="form-group" id="divAlterarNomeSetor">
                                                                <label>Nome do setor</label>
                                                                <input class="form-control" name="nome_alterar" id="nome_alterar" />
                                                                <label class="validar-campos" id="val-nome-alterar"></label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                            <button class="btn btn-success" onclick="return validarTela(1)" name="btnAlterar">Confirmar</button>
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
