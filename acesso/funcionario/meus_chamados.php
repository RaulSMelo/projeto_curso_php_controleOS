<?php
require_once '../../controller/ChamadoController.php';
require_once '../../controller/UtilCTRL.php';

UtilCTRL::ver_logado();
UtilCTRL::ver_tipo_logado(2);

$ctrlChamado = new ChamadoController();
$sit = '';

if (isset($_POST['btn_pesquisar'])) {
    $sit = $_POST['sit'];
    $chamados = $ctrlChamado->chamadosSetor($sit);
    
    if(count($chamados) == 0){
      $ret = -11;  
    }
        
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
                            <?php include_once '../../template/_msg.php';?>
                            <h2>Meus chamados</h2>   
                            <h5>Aqui você pode consultar o andamento dos seus chamados</h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <form action="meus_chamados.php" method="POST">


                        <div class="form-group">

                            <label>Escolha a situação</label>

                            <select class="form-control"  name="sit" id="sit" >
                                <option value="0" <?= $sit == 0 ? ' selected' : '' ?>>Todos</option>
                                <option value="1" <?= $sit == 1 ? ' selected' : '' ?>>Aguardando atendimento</option>
                                <option value="2"<?= $sit == 2 ? ' selected' : '' ?>>Atendimento</option>
                                <option value="3"<?= $sit == 3 ? ' selected' : '' ?>>Finalizado</option>
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
                                       <?= count($chamados) <= 1 ? 'Chamado encontrado: <strong> ' . count($chamados) . '</strong>' : 'Chamados encontrados: <strong>' . count($chamados) . '</strong>'  ?>
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
                                                        <th>Ação</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php for ($i = 0; $i < count($chamados); $i++) { ?>

                                                        <tr class="odd gradeX">
                                                            <td><?= UtilCTRL::retorna_data_formatada($chamados[$i]['data_abertura']) ?></td>
                                                            <td><?= $chamados[$i]['func'] . ' ' . $chamados[$i]['sobrenome_func'] ?></td>
                                                            <td><?= $chamados[$i]['identificacao_equipamento'] . ' ' . $chamados[$i]['descricao_equipamento'] ?></td>
                                                            <td><?= $chamados[$i]['desc_chamado'] ?></td>

                                                            <td>
                                                                <?php if ($chamados[$i]['data_atendimento'] != '') { ?>
                                                                    <a onclick="carregarModalChamados(
                                                                                '<?= UtilCTRL::retorna_data_formatada($chamados[$i]['data_atendimento'])?>',
                                                                                '<?= $chamados[$i]['tec'] . ' ' . $chamados[$i]['sobrenome_tec'] ?>',
                                                                                '<?= UtilCTRL::nome_situacao($chamados[$i]['situacao_chamado']) ?>',
                                                                                '<?= $chamados[$i]['laudo_chamado'] ?>'
                                                                            )" data-toggle="modal" data-target="#modal_chamado" href="#" class="btn btn-info btn-xs">Ver mais</a>
                                                                <?php } ?>
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

        <div class="modal fade" id="modal_chamado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Detalhes do atendimento</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-group" >
                            <label>Data de atendimento</label>
                            <input readonly class="form-control" id="data_atendimento" />
                        </div>
                        <div class="form-group">
                            <label>Técnico</label>
                            <input readonly class="form-control" id="tec" />
                        </div>
                        <div class="form-group">
                            <label>Situacao do chamado</label>
                            <input readonly class="form-control" id="situacao_chamado" />
                        </div>
                        <div class="form-group" id="divLaudo">
                            <label>Laudo</label>
                            <textarea readonly class="form-control" id="laudo" ></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>






