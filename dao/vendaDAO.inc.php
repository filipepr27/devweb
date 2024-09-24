<!-- Filipe Pádua Ribeiro - 2020204136 -->
<?php
require_once 'conexao.inc.php';
require_once '../utils/funcoesUteis.php';
require_once '../classes/item.inc.php';
require_once '../classes/venda.inc.php';
class VendaDao
{
    private $con;

    function __construct()
    {
        $c = new Conexao();
        $this->con = $c->getConexao();
    }

    function inserirVenda($venda, $carrinho)
    {
        $sql = $this->con->prepare("INSERT INTO vendas (cpf_cliente, dataVenda, valorTotal) VALUES (:cpf, :dataVenda, :valorTotal)");
        $sql->bindValue(':cpf', $venda->cpf);
        $sql->bindValue(':dataVenda', $venda->data);
        $sql->bindValue(':valorTotal', $venda->valorTotal);
        $sql->execute();

        $id = $this->obterUltimoIdVenda();
        $this->incluirItens($id, $carrinho);
    }

    private function incluirItens($idVenda, $carrinho)
    {
        foreach ($carrinho as $item) {
            $sql_item = $this->con->prepare("INSERT INTO itens (id_produto, quantidade, valorTotal, id_venda) VALUES (:idProduto, :quantidade, :valorTotal, :idVenda)");

            $sql_item->bindValue(':idProduto', $item->getProduto()->id);
            $sql_item->bindValue(':quantidade', $item->getQuantidade());
            $sql_item->bindValue(':valorTotal', $item->getValorItem());
            $sql_item->bindValue(':idVenda', $idVenda);
            $sql_item->execute();

            $sql_produto = $this->con->prepare("UPDATE produtos SET estoque = estoque - :quantidade WHERE produto_id = :id");
            $sql_produto->bindValue(':quantidade', $item->getQuantidade());

            if ($item->getQuantidade() > $item->getProduto()->estoque) {
                $sql_produto->bindValue(':quantidade', $item->getProduto()->estoque);
            }

            $sql_produto->bindValue(':id', $item->getProduto()->id);
            $sql_produto->execute();
        }
    }

    private function obterUltimoIdVenda()
    {
        $sql = $this->con->query("SELECT MAX(id_venda) AS maior FROM vendas");
        $sql->execute();

        $row = $sql->fetch(PDO::FETCH_OBJ);
        return $row->maior;
    }
}
