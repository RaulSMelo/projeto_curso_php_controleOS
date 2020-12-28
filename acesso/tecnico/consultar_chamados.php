
<?php
require_once '../../controller/ChamadoController.php';
require_once '../../controller/UtilCTRL.php';

UtilCTRL::ver_logado();
UtilCTRL::tipoUsuarioNome(3);

$situacao = '';

if (isset($_POST['btn_pesquisar'])) {

    $ctrlChamadoTec = new ChamadoController();

    $chamados = $ctrlChamadoTec->chamadosTecnico($_POST['sit']);
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
                            <h2>Consultar chamados</h2>   
                            <h5>Consulte todos os seus chamados e realize os atendimentos</h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <form action="consultar_chamados.php" method="POST">

                        <div class="form-group">

                            <label>Escolha a situação</label>

                            <select class="form-control"  name="sit" id="sit">
                                <option value="0">Todos</option>
                                <option value="1" <?= $situacao == 1 ? 'selected' : '' ?>>Aguardando atendimento</option>
                                <option value="2" <?= $situacao == 2 ? 'selected' : '' ?>>Em andamento</option>
                                <option value="3" <?= $situacao == 3 ? 'selected' : '' ?>>Finalizado</option>
                            </select>

                        </div>

                        <button name="btn_pesquisar" class="btn btn-info">Pesquisar</button>

                    </form>


                    <hr/>

                    <?php if (isset($chamados)) { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Advanced Tables -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?= count($chamados) <= 1 ? 'Chamado encontrado: ' . count($chamados) : 'chamados encontrados: ' . count($chamados) ?>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>Data de abertura</th>
                                                        <th>Funcionário</th>
                                                        <th>Equipamento</th>
                                                        <th>Problema</th>
                                                        <th>Situação</th>
                                                        <th>Ação</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    for ($i = 0; $i < count($chamados); $i++) {

                                                        $param = 'id=' . $chamados[$i]['id_chamado'] .
                                                                '&dt_ab=' . ($chamados[$i]['data_abertura'] != '' ? UtilCTRL::retorna_data_formatada($chamados[$i]['data_abertura']) : '') .
                                                                '&func=' . $chamados[$i]['func'] . ' ' . $chamados[$i]['sobrenome_func'] .
                                                                '&setor=' . $chamados[$i]['nome_setor'] .
                                                                '&equip=' . ($chamados[$i]['identificacao_equipamento'] . ' ' . $chamados[$i]['descricao_equipamento']) .
                                                                '&prob=' . $chamados[$i]['desc_chamado'] .
                                                                '&laudo=' . $chamados[$i]['laudo_chamado'] .
                                                                '&situacao=' . $chamados[$i]['situacao_chamado'] .
                                                                '&dt_enc=' . ($chamados[$i]['data_encerramento'] != '' ? UtilCTRL::retorna_data_formatada($chamados[$i]['data_encerramento']) : '') .
                                                                '&tec=' . $chamados[$i]['tec'] . ' ' . $chamados[$i]['sobrenome_tec'];
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td><?= UtilCTRL::retorna_data_formatada($chamados[$i]['data_abertura']) ?></td>
                                                            <td><?= $chamados[$i]['func'] . ' ' . $chamados[$i]['sobrenome_func'] ?></td>
                                                            <td><?= $chamados[$i]['identificacao_equipamento'] . ' ' . $chamados[$i]['descricao_equipamento'] ?></td>
                                                            <td><?= $chamados[$i]['desc_chamado'] ?></td>
                                                            <td><?= UtilCTRL::nome_situacao($chamados[$i]['situacao_chamado']) ?></td>
                                                            <td>
                                                                <div  style="writing-mode: horizontal-tb">
                                                                    <a href="atender_chamado.php?<?= $param ?>" class="btn btn-info btn-xs">Ver mais</a>
                                                                </div>
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
                    <?php } ?>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>






