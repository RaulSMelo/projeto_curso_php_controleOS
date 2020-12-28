<?php
require_once '../../vo/EquipamentoVo.php';
require_once '../../controller/TipoEquipamentoController.php';
require_once '../../controller/ModeloEquipamentoController.php';
require_once '../../controller/equipamentoController.php';

require_once '../../controller/UtilCTRL.php';
UtilCTRL::ver_tipo_logado(1);

$ctrl_tipoEquip = new TipoEquipamentoController();
$ctrl_modeloEquip = new ModeloEquipamentoController();
$ctrl_equipamento = new equipamentoController();



if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $dados = $ctrl_equipamento->detalharEquipamentos($_GET['cod']);
    if (count($dados) == 0) {
        header('location: equipamento_consultar.php');
        exit;
    }
}



if (isset($_POST['btn_gravar'])) {

    $equipVo = new EquipamentoVo();
    $equipVo->setIdentificacao($_POST['ident']);
    $equipVo->setDescricao($_POST['desc']);
    $equipVo->setIdTipo($_POST['tipo']);
    $equipVo->setIdModelo($_POST['modelo']);

    if ($_POST['id_equipamento'] != 0) {
        $equipVo->setId($_POST['id_equipamento']);
        $ret = $ctrl_equipamento->alterarEquipamento($equipVo);
        if ($ret == 1) {
            header('location: equipamento_consultar.php?ret=' . $ret);
            exit;
        }
    } else {
        $ret = $ctrl_equipamento->inserirEquipamento($equipVo);
    }
}

$tiposEquipamentos = $ctrl_tipoEquip->ConsultarTipoEquipamento();
$modelosEquipamentos = $ctrl_modeloEquip->consultarModeloEquipamento();
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
                            <h2><?= isset($dados) ? 'Alterar' : 'Novo' ?> Equipamentos</h2>   
                            <h5>Aqui você <?= isset($dados) ? 'altera' : 'cadastra' ?> os equipamentos da empresa</h5>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <form method="POST" action="equipamento.php">
                        <input type="hidden" id="id_equipamento" name="id_equipamento" value="<?= isset($_GET['cod']) ? $_GET['cod'] : 0 ?>">
                            <div class="form-group" id="divNomeTipo">
                                <label>Tipo do equipamento</label>
                                <select class="form-control"  name="tipo" id="tipo" onchange="validarTela(2)">
                                    <option value="">Selecione...</option>
                                    <?php for ($i = 0; $i < count($tiposEquipamentos); $i++) { ?>
                                        <option value="<?= $tiposEquipamentos[$i]['id_tipo_equipamento'] ?>" <?= isset($dados) ? ($dados[0]['id_tipo'] == $tiposEquipamentos[$i]['id_tipo_equipamento'] ? 'selected' : '') : '' ?> ><?= $tiposEquipamentos[$i]['nome_tipo_equipamento'] ?></option>
                                    <?php } ?>
                                </select>
                                <label class="validar-campos" id="val-tipo"></label>
                            </div>
                            <div class="form-group" id="divNomeModelo">
                                <label>Modelo equipamento</label>
                                <select class="form-control"  name="modelo" id="modelo" onchange="validarTela(2)">
                                    <option value="">Selecione...</option>
                                    <?php for ($i = 0; $i < count($modelosEquipamentos); $i++) { ?>
                                        <option value="<?= $modelosEquipamentos[$i]['id_modelo_equipamento'] ?>" <?= isset($dados) ? ($dados[0]['id_modelo'] == $modelosEquipamentos[$i]['id_modelo_equipamento'] ? 'selected' : '') : '' ?>  ><?= $modelosEquipamentos[$i]['nome_modelo_equipamento'] ?></option>
                                    <?php } ?>
                                </select>
                                <label class="validar-campos" id="val-modelo"></label>
                            </div>
                            <div class="form-group" id="divIdentEquip">
                                <label>Identificação</label>
                                <input class="form-control" name="ident" id="ident" onchange="validarTela(2)" placeholder="Digite aqui..." value="<?= isset($dados) ? $dados[0]['identificacao_equipamento'] : '' ?>"/>
                                <label class="validar-campos" id="val-ident"></label>
                            </div>
                            <div class="form-group" id="divDescEquip">
                                <label>Descrição</label>
                                <textarea class="form-control" name="desc" onchange="validarTela(2)" id="desc" placeholder="Digite a especificção do equipamento"><?= isset($dados) ? $dados[0]['descricao_equipamento'] : '' ?></textarea>
                                <label class="validar-campos" id="val-desc"></label>
                            </div>
                            <button name="btn_gravar" class="btn <?= isset($_GET['cod']) ? 'btn-warning' : 'btn-success' ?>" onclick="return validarTela(2)"><?= isset($_GET['cod']) ? 'Alterar' : 'Gravar' ?></button>    

                    </form>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>

