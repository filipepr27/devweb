<?php
require_once '../dao/produtoDAO.inc.php';
require_once '../classes/produto.inc.php';
require_once '../dao/fabricanteDAO.inc.php';

$opcao = $_REQUEST['opcao'];

switch ($opcao) {
    case 1:
        $referencia = $_REQUEST['pReferencia'];
        $nome = $_REQUEST['pNome'];
        $preco = $_REQUEST['pPreco'];
        $preco = str_replace(',', '.', $preco);
        $preco = (float)$preco;
        $dataFabricacao = $_REQUEST['pDataFabricacao'];
        $cod_fabricante = $_REQUEST['pFabricante'];
        $estoque = $_REQUEST['pEstoque'];
        $descricao = $_REQUEST['pDescricao'];
        $resumo = $_REQUEST['pResumo'];

        $produto = new Produto();
        $produto->setProduto($referencia, $nome, $preco, $dataFabricacao, $cod_fabricante, $estoque, $descricao, $resumo);

        $produtoDao = new ProdutoDao();
        $response = $produtoDao->inserirProduto($produto);

        if ($_FILES['imagem']['size'] > 0) {
            uploadFotos($referencia);
        }

        header("Location: controllerProduto.php?opcao=2");
        break;

    case 2:
    case 7:
        $produtoDao = new ProdutoDao();
        $produtos = $produtoDao->obterTodosProdutos();

        session_start();
        $_SESSION['produtos'] = $produtos;
        if ($opcao == 2) {
            header("Location: ../views/exibirProdutos.php");
        } else {
            header("Location: ../views/produtosVenda.php");
        }
        break;

    case 3:
        $id = $_REQUEST['id'];

        $produtoDao = new ProdutoDao();

        deletarFoto($produtoDao->obterProduto($id)->referencia);

        $produtoDao->excluirProduto($id);

        header("Location: controllerProduto.php?opcao=2");
        break;

    case 4:
        $id = $_REQUEST['id'];
        $fabricante_carregado = $_REQUEST['fab'];

        if ($fabricante_carregado == 'true') {
            // carregar o produto e encaminhar para a pagina de atualizar
            $produtoDao = new ProdutoDao();
            $produto = $produtoDao->obterProduto($id);
            session_start();
            $_SESSION['produto'] = serialize($produto);
            header("Location: ../views/formProdutoAtualizar.php?fabric=$fabricante_carregado");
        } else {
            // carregar o fabricante
            header("Location: controllerFabricante.php?opcao=3&produto=$id");
        }
        break;

    case 5:
        header("Location: controllerFabricante.php?opcao=2");
        break;

    case 6:
        $produtoDao = new ProdutoDao();

        $produto = new Produto();

        session_start();
        $_SESSION['response'] = 'foi';
        $id = $_REQUEST['pId'];
        $referencia = $_REQUEST['pReferencia'];
        $nome = $_REQUEST['pNome'];
        $preco = (float)$_REQUEST['pPreco'];
        $dataFabricacao = $_REQUEST['pDataFabricacao'];
        $cod_fabricante = $_REQUEST['pFabricante'];
        $estoque = $_REQUEST['pEstoque'];
        $descricao = $_REQUEST['pDescricao'];
        $resumo = $_REQUEST['pResumo'];

        $produto->setProduto($referencia, $nome, $preco, $dataFabricacao, $cod_fabricante, $estoque, $descricao, $resumo);

        $response = (bool)$produtoDao->atualizarProduto($id, $produto);

        if ($response) {
            header("Location: controllerProduto.php?opcao=2");
        } else {
            header("Location: controllerProduto.php?opcao=4&id=$id&fab=true");
        }
        break;

    default:
        break;
}

function uploadFotos($ref)
{
    $imagem = $_FILES['imagem'];
    $nome = $ref;

    if ($imagem != null) {
        $nome_temporario = $_FILES['imagem']['tmp_name'];
        copy($nome_temporario, "../views/imagens/produtos/$nome.jpg");
    } else {
        echo "Você não realizou o upload da imagem";
    }
}

function deletarFoto($ref)
{
    $arquivo = "../views/imagens/produtos/$ref.jpg";

    if (file_exists($arquivo)) {
        if (!unlink($arquivo)) {
            echo "Não foi possível deletar o arquivo!";
        }
    }
}
