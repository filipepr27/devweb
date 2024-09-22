<?php
require_once 'conexao.inc.php';
require_once '../classes/produto.inc.php';
require_once 'fabricanteDAO.inc.php';

class ProdutoDao
{

    private $con;

    function __construct()
    {
        $c = new Conexao();
        $this->con = $c->getConexao();
    }

    function inserirProduto(Produto $produto)
    {
        $sql = $this->con->prepare("INSERT INTO produtos (referencia, nome, preco, data_fabricacao, cod_fabricante, estoque, descricao, resumo) VALUES(:referencia, :nome, :preco, :data_fabricacao, :cod_fabricante, :estoque, :descricao, :resumo)");
        $sql->bindValue(':referencia', $produto->referencia);
        $sql->bindValue(':nome', $produto->nome);
        $sql->bindValue(':preco', $produto->preco);
        $sql->bindValue(':data_fabricacao', $produto->data_fabricacao);
        $sql->bindValue(':cod_fabricante', $produto->cod_fabricante);
        $sql->bindValue(':estoque', $produto->estoque);
        $sql->bindValue(':descricao', $produto->descricao);
        $sql->bindValue(':resumo', $produto->resumo);
        $sql->execute();
    }

    function obterTodosProdutos()
    {
        $sql = $this->con->query("SELECT *, (SELECT nome FROM fabricantes WHERE fabricantes.codigo = produtos.cod_fabricante) as nome_fabricante FROM produtos");

        $produtosResponse = $sql->fetchAll(PDO::FETCH_ASSOC);

        $produtos = [];

        foreach ($produtosResponse as $item) {
            $produto = new Produto();
            $produto->id = $item['produto_id'];
            $produto->referencia = $item['referencia'];
            $produto->nome = $item['nome'];
            $produto->preco = $item['preco'];
            $produto->data_fabricacao = $item['data_fabricacao'];
            $produto->cod_fabricante = $item['cod_fabricante'];
            $produto->estoque = $item['estoque'];
            $produto->descricao = $item['descricao'];
            $produto->resumo = $item['resumo'];
            $produto->nome_fabricante = $item['nome_fabricante'];

            $produtos[] = $produto;
        }

        return $produtos;
    }

    function excluirProduto($id)
    {
        $sql = $this->con->prepare("DELETE FROM produtos WHERE produto_id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    function obterProduto($id)
    {
        $sql = $this->con->prepare("SELECT * FROM produtos WHERE produto_id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        $produtoResponse = $sql->fetch(PDO::FETCH_ASSOC);

        $produto = null;
        if ($produtoResponse != null) {
            $produto = new Produto();
            $produto->id = $produtoResponse['produto_id'];
            $produto->referencia = $produtoResponse['referencia'];
            $produto->nome = $produtoResponse['nome'];
            $produto->preco = $produtoResponse['preco'];
            $produto->data_fabricacao = $produtoResponse['data_fabricacao'];
            $produto->cod_fabricante = $produtoResponse['cod_fabricante'];
            $produto->estoque = $produtoResponse['estoque'];
            $produto->descricao = $produtoResponse['descricao'];
            $produto->resumo = $produtoResponse['resumo'];
        }
        return $produto;
    }

    function atualizarProduto(int $id, Produto $produto)
    {
        $sql = $this->con->prepare("SELECT * FROM produtos WHERE produto_id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql_atualizar = $this->con->prepare("UPDATE produtos SET nome = :nome, preco = :preco, data_fabricacao = :dataFabricacao, cod_fabricante = :cod_fabricante, estoque = :estoque, descricao = :descricao, resumo = :resumo WHERE produto_id = :id");
            $sql_atualizar->bindValue(':id', $id);
            $sql_atualizar->bindValue(':nome', $produto->nome);
            $sql_atualizar->bindValue(':preco', $produto->preco);
            $sql_atualizar->bindValue(':dataFabricacao', $produto->dataFabricacao);
            $sql_atualizar->bindValue(':cod_fabricante', $produto->cod_fabricante);
            $sql_atualizar->bindValue(':estoque', $produto->estoque);
            $sql_atualizar->bindValue(':descricao', $produto->descricao);
            $sql_atualizar->bindValue(':resumo', $produto->resumo);

            $sql_atualizar->execute();

            return true;
        } else {
            return 'vasco';
        }
    }
}
