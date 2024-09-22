<?php

class Venda
{
    public $id_venda;
    public $cpf;
    public $valorTotal;
    public $data;

    function __construct($cpf, $valorTotal)
    {
        $this->cpf = $cpf;
        $this->valorTotal = $valorTotal;
        $this->data = new DateTime();
        $this->data = $this->data->format('Y-m-d');
    }
}
