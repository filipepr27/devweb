<!-- Filipe Pádua Ribeiro - 2020204136 -->
<?php

require_once '../dao/vendaDAO.inc.php';

$opcao = $_REQUEST['opcao'];
switch ($opcao) {
    case 1:
        // finalizar venda
        session_start();
        $venda = new Venda($_SESSION['clienteLogado']->cpf, $_SESSION['totalComDesconto']);

        $vendaDao = new VendaDao();
        $vendaDao->inserirVenda($venda, $_SESSION['carrinho']);

        $metodo_pag = $_REQUEST['pag'];

        if ($metodo_pag == 'boleto') {
            header("Location: ../views/boleto.php");
        } else {
            echo 'Validar compra com cartão!!';
        }
        unset($_SESSION['carrinho']);
        unset($_SESSION['total']);
        header("Location: ../views/index.php");
        break;
}
