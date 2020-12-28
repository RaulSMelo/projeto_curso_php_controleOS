<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/controleOS/controller/UtilCTRL.php';
    UtilCTRL::ver_logado();
    $tipo = UtilCTRL::tipo_logado();

    if(isset($_GET['close']) && is_numeric($_GET['close'])){
        UtilCTRL::deslogar_sessao();
    }

?>


<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">


            <?php
            if ($tipo == 1) {

                UtilCTRL::ver_tipo_logado($tipo);
                ?>

                <li>
                    <a href="../../acesso/adm/principal.php">Principal</a>
                </li>
                <li>
                    <a href="../../acesso/adm/gerenciar_setor.php">Setor</a>
                </li>

                <li>
                    <a href="../../acesso/adm/gerenciar_tipo_equipamento.php">Tipo de equipamento</a>
                </li>

                <li>
                    <a href="../../acesso/adm/gerenciar_modelo_equipamento.php">Modelo </a>
                </li>

                <li>
                    <a href="#">Equipamento<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a  href="../../acesso/adm/equipamento.php">Novo</a>
                        </li>
                        <li>
                            <a  href="../../acesso/adm/equipamento_consultar.php">Consultar / Alterar</a>
                        </li>
                        <li>
                            <a  href="../../acesso/adm/alocar_equipamento.php">Alocar</a>
                        </li>
                        <li>
                            <a  href="../../acesso/adm/remover_equipamento.php">Remover do setor</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="#">Usuário<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a  href="../../acesso/adm/novo_usuario.php">Novo</a>
                        </li>
                        <li>
                            <a  href="../../acesso/adm/consultar_usuario.php">Consultar / Alterar</a>
                        </li>
                    </ul>           
                </li>

                <?php
            } else if ($tipo == 2) {

                UtilCTRL::ver_tipo_logado($tipo);
                ?>
                <li>
                    <a href="../../acesso/funcionario/novo_chamado.php">Novo Chamado</a>
                </li> 

                <li>
                    <a href="../../acesso/funcionario/meus_chamados.php">Meus Chamados</a>
                </li>

                <li>
                    <a href="../../acesso/funcionario/meus_dados.php">Meus dados </a>
                </li>
                <li>
                    <a href="../../acesso/funcionario/mudar_senha.php">Alterar senha</a>
                </li>

                <?php
            }if ($tipo == 3) {

                UtilCTRL::ver_tipo_logado($tipo);
                ?>
                <li>
                    <a href="../../acesso/tecnico/consultar_chamados.php">Consultar chamados</a>
                </li>

                <li>
                    <a href="../../acesso/tecnico/meus_dados.php">Meus dados</a>
                </li>
                <li>
                    <a href="../../acesso/tecnico/mudar_senha.php">Alterar senha</a>
                </li>

            <?php } ?>

            <li>
                <a href="http://localhost/controleOS/template/_menu.php?close=1">Sair</a>
            </li>  
        </ul>

    </div>

</nav>
