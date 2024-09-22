<?php
require_once 'produto.inc.php';

class Item
{
    private Produto $produto;
    private $quantidade;
    private $valorItem;

    function __construct($produto)
    {
        $this->produto = $produto;
        $this->quantidade = 1;
        $this->valorItem = $produto->preco;
    }

    public function getValorItem()
    {
        return $this->valorItem;
    }

    public function setValorItem()
    {
        $this->valorItem = $this->quantidade * $this->produto->preco;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade()
    {
        $this->quantidade++;
    }

    public function getProduto()
    {
        return $this->produto;
    }

    public function adicionarQuantidade($qtd)
    {
        $this->quantidade += $qtd;
        $this->setValorItem();
    }
}
