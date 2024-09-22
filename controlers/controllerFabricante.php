<?php

require_once '../dao/fabricanteDAO.inc.php';

$opcao = $_REQUEST['opcao'];

switch ($opcao) {
    case 1:
        // inserir fabricante
        break;

    case 2:
        $fabricanteDao = new FabricanteDao();
        $fabricantes = $fabricanteDao->obterTodosFabricantes();
        session_start();
        $_SESSION['fabricantes'] = $fabricantes;
        header("Location: ../views/formProduto.php");
        break;

    case 3:
        $fabricanteDao = new FabricanteDao();
        $fabricantes = $fabricanteDao->obterTodosFabricantes();
        session_start();
        $_SESSION['fabricantes'] = $fabricantes;
        header("Location: controllerProduto.php?opcao=4&id=" . $_REQUEST['produto'] . "&fab=true");
        // var_dump($fabricantes);
        break;
}
