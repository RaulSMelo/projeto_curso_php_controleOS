<?php
    require_once '../../controller/UtilCTRL.php';
    require_once  '../../controller/ChamadoController.php';

    UtilCTRL::ver_logado();
    UtilCTRL::ver_tipo_logado(1);

    $ctrlChamados = new ChamadoController();

    $dados = $ctrlChamados->dadosGraficoChamadosCtrl();

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
    include_once '../../template/_head.php';
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Total", {role: "style"}],
                ["Aguardando", <?= $dados[0]['aguardando']?>, "orange"],
                ["Atendimento", <?= $dados[0]['atendimento']?>, "green"],
                ["Finalizado", <?= $dados[0]['finalizado']?>, "blue"],
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2]);

            var options = {
                title: "Situação atual dos chamados",
                width: 900,
                height: 500,
                bar: {groupWidth: "95%"},
                legend: {position: "none"},
            };

            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
            chart.draw(view, options);
        }
    </script>

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
                    <h2>Principal</h2>
                </div>
            </div>

            <hr />

            <center>
                <div id="columnchart_values"></div>
            </center>

        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>

</body>
</html>
