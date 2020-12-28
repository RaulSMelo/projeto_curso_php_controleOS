<?php

require_once '../../controller/UtilCTRL.php';
require_once '../../controller/ChamadoController.php';

UtilCTRL::ver_logado();
UtilCTRL::ver_tipo_logado(3);

    $ctrl_chamado = new ChamadoController();

    if(
            isset($_GET['id'])      && is_numeric($_GET['id']) &&
            isset($_GET['dt_ab'])   && $_GET['dt_ab'] != ''    &&
            isset($_GET['func'])    && $_GET['func'] != ''     &&
            isset($_GET['setor'])   && $_GET['setor'] != ''    &&
            isset($_GET['equip'])   && $_GET['equip'] != ''    &&
            isset($_GET['prob'])    && $_GET['prob'] != ''     &&
            isset($_GET['situacao'])&& $_GET['situacao'] != '' )
    {
       $id_ch    = $_GET['id'];
       $dt_ab    = $_GET['dt_ab'];
       $func     = $_GET['func'];
       $setor    = $_GET['setor'];
       $equip    = $_GET['equip'];
       $prob     = $_GET['prob'];
       $situacao = $_GET['situacao'];
        
    }else if(isset($_POST['btn_atender'])){

        $ctrl_chamado->atenderChamadoTec($_POST['id_chamado']);
        
        $detalhes_chamado_tecnico = $ctrl_chamado->detalhesChamadoTecnico($_POST['id_chamado']);
        
        $situacao = $detalhes_chamado_tecnico[0]['situacao_chamado'];
  
    }else if (isset ($_POST['btn_finalizar'])) {
        
        $ctrl_chamado->finalizarChamadoTec($_POST['laudo'], $_POST['id_chamado']);
        
        $detalhes_chamado_tecnico = $ctrl_chamado->detalhesChamadoTecnico($_POST['id_chamado']);
        
        $situacao = $detalhes_chamado_tecnico[0]['situacao_chamado'];
        
    }else{
        header('location: consultar_chamados.php');
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
                        <?php if($situacao == 3) { ?>
                            <div class="col-md-12">
                                <h2>Atendimento finalizado</h2>
                            </div>
                        <?php } else{?>
                            <div class="col-md-12">
                                <h2>Atender chamado</h2>
                                <h5>Faça os atendimentos aqui</h5>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /. ROW  -->

                    <hr />

                    <form action="atender_chamado.php" method="POST">
                        
                        <input type="hidden" name="id_chamado" value="<?= isset($id_ch) ? $id_ch : $detalhes_chamado_tecnico[0]['id_chamado'] ?>">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Data de abertura</label>
                                    <input class="form-control" disabled type="text" name="data" id="data" value="<?= isset($dt_ab) ? $dt_ab : UtilCTRL::retorna_data_formatada($detalhes_chamado_tecnico[0]['data_abertura']) ?>" />
                                </div>
                            </div>    

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Funcionário</label>
                                    <input class="form-control" disabled type="text" name="func" id="func" value="<?= isset($func) ? $func : $detalhes_chamado_tecnico[0]['func']  ?>" />
                                </div>
                            </div> 
                        </div>
                 

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Setor</label>
                                    <input class="form-control" disabled type="text" name="setor" id="setor" value="<?= isset($setor) ? $setor : $detalhes_chamado_tecnico[0]['nome_setor'] ?>" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Equipamento</label>
                                    <input class="form-control" disabled type="text" name="equip" id="equip" value="<?= isset($equip) ? $equip : $detalhes_chamado_tecnico[0]['identificacao_equipamento'] . ' ' . $detalhes_chamado_tecnico[0]['descricao_equipamento']  ?>" />
                                </div>
                            </div> 
                        </div>


                        <div class="form-group">
                            <label>Descrição do problema</label>
                            <textarea class="form-control" type="text" disabled name="descProblema" id="descProblema" ><?= isset($prob) ? $prob : $detalhes_chamado_tecnico[0]['desc_chamado'] ?></textarea>
                        </div>
                        
                        <?php if($situacao == 1){ ?>
                               <button name="btn_atender" class="btn btn-success">Atender</button> 
                        <?php }else if($situacao == 2){ ?> 
                               
                               
                            <div class="form-group" id="divLaudo-tec">
                                <label>Laudo</label>
                                <textarea onchange="return validarTela(12)" class="form-control" type="text" name="laudo" id="laudo" ></textarea>
                                <label id="val-laudo-tec" class="validar-campos"></label>
                            </div>
                            
                            <button name="btn_finalizar" onclick="return validarTela(12)" class="btn btn-success">Finalizar</button> 
                           
                        <?php } else if($situacao == 3){ ?>
                            
                            <div class="form-group">
                                <label>Laudo</label>
                                <textarea disabled class="form-control" type="text" ><?= isset($_GET['laudo']) ? $_GET['laudo'] : $detalhes_chamado_tecnico[0]['laudo_chamado'] ?></textarea>
                                <label id="val-laudo-tec" class="validar-campos"></label>
                            </div>
                            
                            <div class="alert alert-info"> 
                                <strong>Finalizado <?= (isset($_GET['dt_enc']) ? $_GET['dt_enc'] : UtilCTRL::retorna_data_formatada($detalhes_chamado_tecnico[0]['data_encerramento']))?> pelo técnico <?= (isset($_GET['tec']) ? $_GET['tec'] : $detalhes_chamado_tecnico[0]['tec'] . ' ' . $detalhes_chamado_tecnico[0]['sobrenome_tec'] ) ?> </strong>
                            </div>
                        <?php }  ?> 
                        
            </form>
                    


        </div>
        <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>






