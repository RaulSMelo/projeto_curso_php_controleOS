<?php

    require_once '../../controller/AlocarController.php';
    require_once '../../controller/equipamentoController.php';
    require_once '../../controller/UtilCTRL.php';

    if(isset($_POST['btn_pesquisar'])){
        $historicoCTRL = new AlocarController();
        $dados = $historicoCTRL->historicoAlocados($_POST['hist_equip']);
    }

    $CTRLequip = new equipamentoController();

    $equips = $CTRLequip->pesquisarEquipamentoPorTipo(0);

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

                    <h2>Histórico de alocação</h2>
                    <h5>Aqui você vê os histórico do equipamento alocado</h5>

                </div>
            </div>
            <!-- /. ROW  -->
            <hr />

            <form method="post" action="historico_alocado.php">

                <div class="form-group" id="divNome">
                    <label>Equipamentos</label>
                    <select class="form-control" id="hist_equip" name="hist_equip">
                        <option value="">Selecione...</option>
                        <?php for($i = 0; $i < count($equips); $i++ ){?>
                            <option value="<?= $equips[$i]['id_equipamento'] ?>"><?= $equips[$i]['identificacao_equipamento'] . " " . $equips[$i]['descricao_equipamento'] ?></option>
                        <?php } ?>
                    </select>
                    <label id="val-nome" class="validar-campos"></label>
                </div>

                <button name="btn_pesquisar" onclick="" class="btn btn-info" >Pesquisar</button>
            </form>
            <hr/>
            <?php if(isset($dados)) { ?>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Resultados encontrados
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>Data de alocação</th>
                                        <th>Setor</th>
                                        <th>Data de remoção</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php for ($i = 0; $i < count($dados); $i++) { ?>
                                        <tr class="odd gradeX">
                                            <td><?= UtilCTRL::retorna_data_formatada($dados[$i]['data_alocar']) ?></td>
                                            <td><?= $dados[$i]['nome_setor'] ?></td>
                                            <td><?= $dados[$i]['data_remover'] != '' ? UtilCTRL::retorna_data_formatada($dados[$i]['data_remover']) : '' ?></td>
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
            <?php } ?>

        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
</body>
</html>

