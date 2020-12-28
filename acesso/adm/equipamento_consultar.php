<?php
require_once '../../controller/equipamentoController.php';
require_once '../../controller/TipoEquipamentoController.php';
require_once '../../controller/AlocarController.php';
require_once '../../controller/UtilCTRL.php';
UtilCTRL::ver_logado();
UtilCTRL::ver_tipo_logado(1);
$ctrl_tipoEquip = new TipoEquipamentoController();
$ctrl_equipamento = new equipamentoController();
$ctrl_alocar = new AlocarController();

if (isset($_GET['ret'])) {
    $ret = $_GET['ret'];
}

if (isset($_POST['btn_pesquisar'])) {
    $idTipo = $_POST['tipo'];
    $equipamentos = $ctrl_equipamento->pesquisarEquipamentoPorTipo($idTipo);

    for ($i = 0; $i < count($equipamentos); $i++) {
        $alocados = $ctrl_alocar->verificarEquipamentosAlocados($equipamentos[$i]['id_equipamento']);
        if ($alocados > 0) {
            $equipamentos[$i]['alocado'] = true;
            $equipamentos[$i]['data_alocar'] = $alocados['data_alocar'];
            $equipamentos[$i]['nome_setor'] = $alocados['nome_setor'];
        } else {
            $equipamentos[$i]['alocado'] = false;
            $equipamentos[$i]['data_alocar'] = NULL;
            $equipamentos[$i]['nome_setor'] = NULL;
        }
    }
}

if (isset($_POST['btnExcluirEquipamento'])) {
    $idEquip = $_POST['id_equipamento'];

    $ret = $ctrl_equipamento->excluirEquipamento($idEquip);
}

$tiposEquipamentos = $ctrl_tipoEquip->ConsultarTipoEquipamento();
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
                            <h2>Gerenciar equipamentos</h2>   
                            <h5>Aqui você podera consultar / alterar/ excluir todos os equipamentos cadastrados </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <form method="POST" action="equipamento_consultar.php">
                        <div class="form-group">
                            <label>Selecione o tipo</label>
                            <select class="form-control"  name="tipo" id="tipo">
                                <option value="0">Todos...</option>
                                <?php for ($i = 0; $i < count($tiposEquipamentos); $i++) { ?>
                                    <option value="<?= $tiposEquipamentos[$i]['id_tipo_equipamento'] ?>" <?= isset($idTipo) ? ($idTipo == $tiposEquipamentos[$i]['id_tipo_equipamento'] ? 'selected' : '') : '' ?> ><?= $tiposEquipamentos[$i]['nome_tipo_equipamento'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button name="btn_pesquisar" class="btn btn-info">Pesquisar</button>
                    </form>
                    <hr/>
                    <?php if (isset($equipamentos)) { ?>
                        <?php if (count($equipamentos) > 0) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Advanced Tables -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                           <?= (count($equipamentos) <= 1) ? 'Equipamento cadastrado: <strong>' . count($equipamentos) . '</strong>' : 'Equipamentos cadastrados:  <strong> ' . count($equipamentos) . '</strong>' ?>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Tipo</th>
                                                            <th>Modelo</th>
                                                            <th>Identificação</th>
                                                            <th>Descrição</th>
                                                            <th>Ação</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php for ($i = 0; $i < count($equipamentos); $i++) { ?>
                                                            <tr class="odd gradeX">
                                                                <td><?= $equipamentos[$i]['nome_tipo_equipamento'] ?></td>
                                                                <td><?= $equipamentos[$i]['nome_modelo_equipamento'] ?></td>
                                                                <td><?= $equipamentos[$i]['identificacao_equipamento'] ?></td>
                                                                <td><?= $equipamentos[$i]['descricao_equipamento'] ?></td>

                                                                <td>
                                                                    <a href="equipamento.php?cod=<?= $equipamentos[$i]['id_equipamento'] ?>" class="btn btn-warning btn-xs btn-padrao">Alterar</a>

                                                                    <a href="#" class="btn <?= ($equipamentos[$i]['alocado']) ? 'btn-primary' : 'btn-danger' ?> btn-xs btn-padrao" 
                                                                       data-toggle="modal" 
                                                                       data-target="<?= ($equipamentos[$i]['alocado']) ? '#modal-alocado' : '#modal-excluir-equipamento' ?>" 
                                                                       onclick="<?= ($equipamentos[$i]['alocado']) ? "carregarModalEquipAlocados('{$equipamentos[$i]['id_equipamento']}','{$equipamentos[$i]['data_alocar']}','{$equipamentos[$i]['nome_setor']}')" : "carregarModalEquip('{$equipamentos[$i]['id_equipamento']}','{$equipamentos[$i]['nome_tipo_equipamento']}','{$equipamentos[$i]['nome_modelo_equipamento']}','{$equipamentos[$i]['identificacao_equipamento']}','{$equipamentos[$i]['descricao_equipamento'] }')" ?>" > <?= ($equipamentos[$i]['alocado']) ? 'Alocado' : 'Excluir' ?></a>

                                                                </td>  
                                                            </tr>

                                                        <?php } ?>

                                                    </tbody>
                                                </table>

                                                <?php } else {
                                                            echo '<div class="alert alert-danger">
                                                                    Não existe registro 
                                                                </div>';
                                                        }
                                            ?>
                                        <?php } ?>

                                        <form action="equipamento_consultar.php" method="POST">

                                            <!--Modal excluir equipamento-->
                                            <div class="modal fade" id="modal-excluir-equipamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Deseja excluir o equipamento ?</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_equipamento" id="id_equipamento" />
                                                            <div class="form-group">
                                                                <label>Tipo</label>
                                                                <input class="form-control" name="tipo_equipamento" id="tipo_equipamento" disabled />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Modelo</label>
                                                                <input class="form-control" name="modelo_equipamento" id="modelo_equipamento" disabled />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Identificação</label>
                                                                <input class="form-control" name="identificacao_equipamento" id="identificacao_equipamento" disabled />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Descrição</label>
                                                                <input class="form-control" name="descricao_equipamento" id="descricao_equipamento" disabled />
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                            <button class="btn btn-danger" name="btnExcluirEquipamento">Excluir</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Modal informações dos esquipamentos alocados-->
                                            <div class="modal fade" id="modal-alocado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header title-modal-alocado">
                                                            <button type="button" id="exit-modal-alocado" class="close bg-warning" data-dismiss="modal" aria-hidden="true"><i class="fas fa-arrow-left"></i></button>
                                                            <h4 class="modal-title" id="myModalLabel">Informações do equipamento</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_equipamento_alocado" id="id_equipamento" />
                                                            <div class="form-group">
                                                                <label>Data de alocação: </label>
                                                                <mark id="data-alocacao" ></mark>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Setor: </label>
                                                                <mark id="setor-alocado" ></mark>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-info" data-dismiss="modal">Voltar</button>
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


