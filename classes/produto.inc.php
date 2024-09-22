<?php

class Produto
{
    private $id;
    private $nome;
    private $data_fabricacao;
    private $preco;
    private $estoque;
    private $descricao;
    private $resumo;
    private $referencia;
    private $cod_fabricante;
    private $nome_fabricante;

    function __construct() {}

    function setProduto($referencia, $nome, $preco, $data_fabricacao, $cod_fabricante, $estoque, $descricao, $resumo, $nome_fabricante = '')
    {
        $this->referencia = $referencia;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->data_fabricacao = $data_fabricacao;
        $this->cod_fabricante = $cod_fabricante;
        $this->estoque = $estoque;
        $this->descricao = $descricao;
        $this->resumo = $resumo;
        $this->nome_fabricante = $nome_fabricante;
    }

    function __get($atributo)
    {
        return $this->$atributo;
    }

    function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }
}
