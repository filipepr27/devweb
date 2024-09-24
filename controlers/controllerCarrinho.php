<!-- Filipe Pádua Ribeiro - 2020204136 -->
<?php
require_once '../dao/produtoDAO.inc.php';
require_once '../classes/produto.inc.php';
require_once '../classes/item.inc.php';

$opcao = $_REQUEST['opcao'];

switch ($opcao) {
    case 1:
        // adicionar item no carrinho
        $produto_id = (int)$_REQUEST['id'];

        $produtoDao = new ProdutoDao();
        $produto = $produtoDao->obterProduto($produto_id);

        session_start();
        if (isset($_SESSION['carrinho'])) {
            $carrinho = $_SESSION['carrinho'];
        } else {
            $carrinho = array();
        }

        $indice = buscaProdutoIdCarrinho($produto, $carrinho);

        if ($indice != -1) {

            $carrinho[$indice]->setQuantidade();
            $carrinho[$indice]->setValorItem();
        } else {
            $item = new Item($produto);
            $carrinho[] = $item;
        }

        $_SESSION['carrinho'] = $carrinho;

        header("Location: ../views/exibirCarrinho.php");
        break;

    case 2:
        // remover item do carrinho
        $index = (int)$_REQUEST['index'];

        session_start();
        $carrinho = $_SESSION['carrinho'];

        unset($carrinho[$index]);
        sort($carrinho);

        $_SESSION['carrinho'] = $carrinho;

        header("Location: controllerCarrinho.php?opcao=4");
        break;

    case 3:
        // limpar carrinho
        session_start();
        unset($_SESSION['carrinho']);
        header("Location: controllerCarrinho.php?opcao=4");
        break;

    case 4:
        // exibir carrinho
        session_start();

        if ((!isset($_SESSION['carrinho'])) || (sizeof($_SESSION['carrinho']) == 0)) {
            // carrinho vazio
            header("Location: ../views/exibirCarrinho.php?status=1");
        } else {
            header("Location: ../views/exibirCarrinho.php");
        }
        break;

    case 5:
        // finalizar compra
        session_start();
        $tipo_cliente = $_SESSION['clienteLogado']->tipo_cliente;
        $total = (float)$_SESSION['total'];

        switch ($tipo_cliente) {
            case 'Standart':
                $desconto = 0.07;
                break;
            case 'Premium':
                $desconto = 0.25;
                break;
            case 'Master':
                $desconto = 0.2;
                break;
            default:
                $desconto = 0;
                break;
        }


        $_SESSION['totalComDesconto'] = $total - ($total * $desconto);
        $_SESSION['desconto'] = $desconto * 100;

        if (!isset($_SESSION['clienteLogado'])) {
            $_SESSION['finalizandoCompra'] = true;
            // direcionar para tela de login
            header("Location: ../views/autenticacaoCompra.php");
        } else {
            header("Location: ../views/dadosCompra.php");
        }
        break;
    case 6:
        // adicionar qtd item
        $idItemAdd = $_REQUEST['idItemAdd'];
        $produtoDao = new ProdutoDao();
        $produto = $produtoDao->obterProduto($idItemAdd);

        session_start();
        $carrinho = $_SESSION['carrinho'];

        $indice = buscaProdutoIdCarrinho($produto, $carrinho);

        $qtdItem = (int)$_REQUEST['qtdItem'];
        $carrinho[$indice]->adicionarQuantidade($qtdItem);
        $carrinho[$indice]->setValorItem();
        $_SESSION['carrinho'] = $carrinho;
        header("Location: controllerCarrinho.php?opcao=4");
        break;
}


function buscaProdutoIdCarrinho($chave, $vetor)
{
    $index = -1;
    for ($i = 0; $i < count(($vetor)); $i++) {
        if ($chave->id == $vetor[$i]->getProduto()->id) {
            $index = $i;
            break;
        }
    }
    return $index;
}
