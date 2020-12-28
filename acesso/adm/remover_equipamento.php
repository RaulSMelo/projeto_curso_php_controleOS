<?php
require_once '../../controller/RemoverEquipSetorController.php';
require_once '../../controller/SetorController.php';

require_once '../../controller/UtilCTRL.php';
UtilCTRL::ver_tipo_logado(1);

$equipamentosAlocados = new RemoverEquipSetorController();
$consultarSetores = new SetorController();
$idSetor = 0;

if (isset($_POST['btn_pesquisar'])) {
    if ($_POST['setor'] != 0) {
        $idSetor = $_POST['setor'];
        $todosEquipAlocados = $equipamentosAlocados->consultarEquipSetor($idSetor);

        if (count($todosEquipAlocados) == 0) {
            $ret = -4;
        }
    } else {
        $ret = -3;
    }
} else if (isset($_POST['btnRemoverEquipSetor'])) {
    $idAlocar = $_POST['id_alocar'];
    $ret = $equipamentosAlocados->removerEquipamentoSetor($idAlocar);
}

$setores = $consultarSetores->consultarSetor();
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

                            <h2>Remover equipamento</h2>   
                            <h5>Aqui você pode remover um equipamento de um determinado setor</h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->

                    <hr />

                    <form action="remover_equipamento.php" method="POST">
                        <div class="form-group" id="divNomeSetorRemover">
                            <label>Selecione o setor</label>
                            <select onchange="return validarTela(6)" class="form-control"  name="setor" id="setor">
                                <option value="0">Selecione...</option>
                                <?php for ($i = 0; $i < count($setores); $i++) { ?>
                                    <option value="<?= $setores[$i]['id_setor'] ?>" <?= isset($idSetor) ? ($idSetor == $setores[$i]['id_setor'] ? 'selected' : '') : '' ?> > <?= $setores[$i]['nome_setor'] ?></option>
                                <?php } ?>
                            </select>
                            <label id="val-nome-setor-remover" class="validar-campos"></label>

                        </div>

                        <button onclick="return validarTela(6)" name="btn_pesquisar" class="btn btn-info">Pesquisar</button>

                    </form>

                    <hr/>

                    <?php if (isset($todosEquipAlocados) && count($todosEquipAlocados) > 0) { ?>

                        <div class="row">
                            <div class="col-md-12">
                                <!-- Advanced Tables -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?= (count($todosEquipAlocados) <= 1) ? 'Equipamento alocado: <strong>' . count($todosEquipAlocados) . '</strong>' : 'Equipamentos alocados:  <strong> ' . count($todosEquipAlocados) . '</strong>' ?>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Modelo</th>
                                                        <th>Equipamento</th>
                                                        <th>Ação</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php for ($i = 0; $i < count($todosEquipAlocados); $i++) { ?>
                                                        <tr class="odd gradeX">
                                                            <td><?= $todosEquipAlocados[$i]['nome_tipo_equipamento'] ?></td>
                                                            <td><?= $todosEquipAlocados[$i]['nome_modelo_equipamento'] ?></td>
                                                            <td><?= $todosEquipAlocados[$i]['identificacao_equipamento'] . ' ' . $todosEquipAlocados[$i]['descricao_equipamento'] ?></td>
                                                            <td>
                                                                <a href="#" data-toggle="modal" data-target="#modal_remover_equipamento" onclick="carregarModalExcluirEquipAlocados('<?= $todosEquipAlocados[$i]['nome_setor'] ?>', '<?= $todosEquipAlocados[$i]['id_alocar'] ?>', '<?= $todosEquipAlocados[$i]['nome_tipo_equipamento'] ?>', '<?= $todosEquipAlocados[$i]['nome_modelo_equipamento'] ?>', '<?= $todosEquipAlocados[$i]['descricao_equipamento'] ?>')" class="btn btn-danger btn-xs">Remover</a>   
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                            <form action="remover_equipamento.php" method="POST">

                                                <div class="modal fade" id="modal_remover_equipamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title" id="myModalLabel">Deseja remover o equipamento do setor <strong id="nome_setor"></strong> ?</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id_alocar" id="id_alocar" />
                                                                <div class="form-group">
                                                                    <label>Tipo</label>
                                                                    <input class="form-control" name="tipo_equipamento" id="tipo_equipamento" disabled />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Modelo</label>
                                                                    <input class="form-control" name="modelo_equipamento" id="modelo_equipamento" disabled />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Descrição</label>
                                                                    <input class="form-control" name="descricao_equipamento" id="descricao_equipamento" disabled />
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                <button class="btn btn-danger" name="btnRemoverEquipSetor">Remover</button>
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

                    <?php } ?>

                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>







