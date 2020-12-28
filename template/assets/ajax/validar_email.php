<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/controleOS/controller/UsuarioController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controleOS/template/_msg.php';

if (isset($_POST['email'])) {

    $usuarioCTRL = new UsuarioController();
    
    $email = $_POST['email'];
    $idUser = $_POST['id_usuario'];
    

    if ($usuarioCTRL->verificarEmailDuplicado($email, $idUser) > 0) {
        echo 1;
    } else {
        echo 0;
    }
}