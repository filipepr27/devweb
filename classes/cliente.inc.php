<?php

class Cliente
{
    public $nome;
    public $email;
    public $cpf;
    public $rg;
    public $data_nascimento;
    public $logradouro;
    public $cep;
    public $cidade;
    public $estado;
    public $telefone;
    public $senha;
    public $tipo;

    function __construct() {}

    public function cadastrarCliente($nome, $email, $cpf, $rg, $data_nascimento, $logradouro, $cep, $cidade, $estado, $telefone, $senha)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->data_nascimento = $data_nascimento;
        $this->logradouro = $logradouro;
        $this->cep = $cep;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->telefone = $telefone;
        $this->tipo = 'C';
        $this->senha = $senha;
    }

    public function alterarCliente($cpf, $nome, $rg, $data_nascimento, $logradouro, $cep, $cidade, $estado, $telefone)
    {
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->rg = $rg;
        $this->data_nascimento = $data_nascimento;
        $this->logradouro = $logradouro;
        $this->cep = $cep;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->telefone = $telefone;
    }

    public function setCliente($nome, $email, $cpf, $rg, $data_nascimento, $logradouro, $cep, $cidade, $estado, $telefone, $tipo)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->data_nascimento = $data_nascimento;
        $this->logradouro = $logradouro;
        $this->cep = $cep;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->telefone = $telefone;
        $this->tipo = $tipo;
    }
}
