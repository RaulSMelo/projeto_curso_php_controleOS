<?php 
    require_once '../../controller/equipamentoController.php';
    require_once '../../controller/SetorController.php';
    require_once '../../controller/AlocarController.php';
    require_once '../../vo/AlocarVo.php';
    require_once '../../controller/UtilCTRL.php';
    UtilCTRL::ver_tipo_logado(1);
    
    $ctrl_equipamento = new equipamentoController();
    $ctrl_setor = new SetorController();
    $ctrl_alocar_equip = new AlocarController();
    
    if(isset($_POST['btn_gravar'])){
        $alocarVo = new AlocarVo();
        $alocarVo->setIdEquipamento($_POST['equip']);
        $alocarVo->setIdSetor($_POST['setor']);

        $ret = $ctrl_alocar_equip->inserirAlocarEquipamento($alocarVo);
    }
    $equipamentos = $ctrl_equipamento->filtrarEquipamentoDisponivel();
    $setores = $ctrl_setor->consultarSetor();
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
                            <h2>Alocar equipamentos</h2>   
                            <h5>Aqui você pode alocar um equipamento para um determinado setor</h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->

                    <hr />
                    
                    <form method="POST" action="alocar_equipamento.php">
                        <div class="form-group" id="divNomeEquipamento">
                            <label> Selecione o equipamento</label>
                            <select onchange="return validarTela(5)" class="form-control"  name="equip" id="equip">
                                <option value="">Selecione...</option>
                                <?php for($i = 0; $i < count($equipamentos); $i++){ ?>
                                    <option value="<?= $equipamentos[$i]['id_equipamento'] ?>"><?= $equipamentos[$i]['identificacao_equipamento'] . " - " . $equipamentos[$i]['descricao_equipamento']?></option>
                                <?php } ?>
                            </select>
                            <label class="validar-campos" id="val-nome-equipamento"></label>
                        </div>
                        <div class="form-group" id="divNomeSetor">
                            <label> Selecione o setor</label>
                            <select onchange="return validarTela(5)" class="form-control"  name="setor" id="setor">
                                <option value="">Selecione...</option>
                                <?php for($i = 0; $i < count($setores); $i++){ ?>
                                    <option value="<?= $setores[$i]['id_setor'] ?>"><?= $setores[$i]['nome_setor'] ?></option>
                                <?php } ?>
                            </select>
                            <label class="validar-campos" id="val-nome-setor"></label>
                        </div>
                        <button onclick="return validarTela(5)" name="btn_gravar" id="btn_gravar"class="btn btn-success">Gravar</button>
                    </form>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        
    </body>
</html>






