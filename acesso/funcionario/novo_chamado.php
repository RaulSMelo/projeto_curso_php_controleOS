
<?php

require_once '../../controller/ChamadoController.php';
require_once '../../vo/ChamadoVo.php';

    $ctrlChamado = new ChamadoController();

    if(isset($_POST['btn_gravar'])){
        
        $vo = new ChamadoVo();
        
        $vo->setIdEquipamento($_POST['equip']);
        $vo->setDescricao($_POST['desc_problema']);
        
       $ret = $ctrlChamado->abrirChamado($vo);
    }
 
    $dados = $ctrlChamado->carregarEquipDisponivel();

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
                            <h2>Novo chamado</h2>   
                            <h5>Realize abertura de chamados nesta página</h5>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    
                    <hr />
                    <form action="novo_chamado.php" method="POST">
                        <div class="form-group" id="divEquipamento">
                            <label>Escolha o equipamento</label>
                            <select onchange="return validarTela(10)" class="form-control" name="equip" id="equip">
                                <option value="">Selecione...</option>
                                <?php for($i = 0; $i < count($dados); $i++){ ?>
                                    <option value="<?= $dados[$i]['id_equipamento']  ?>"><?= $dados[$i]['identificacao_equipamento'] . ' '. $dados[$i]['descricao_equipamento']?></option>
                                <?php }?>
                            </select>
                            <label id="val-equipamento" class="validar-campos"></label>
                        </div>

                        <div class="form-group" id="divDescProblema">
                            <label>Descreva o problema</label>
                            <textarea onchange="return validarTela(10)" class="form-control" name="desc_problema" id="desc_problema" placeholder="Digite aqui..."></textarea>
                            <label id="val-desc-problema" class="validar-campos"></label>
                        </div>

                        <button onclick="return validarTela(10)" name="btn_gravar" class="btn  btn-success" >Gravar</button>    
                    </form>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>



