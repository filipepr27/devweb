<?php

require_once '../classes/cliente.inc.php';
require_once 'conexao.inc.php';

class ClienteDao
{
    private $con;

    function __construct()
    {
        $c = new Conexao();
        $this->con = $c->getConexao();
    }

    function autenticar($email, $senha)
    {
        $sql = $this->con->prepare("SELECT * FROM clientes WHERE email =:email AND senha =:senha");
        $email = strtolower($email);
        $senha = strtolower($senha);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', $senha);
        $sql->execute();

        $clienteRetorno = null;

        if ($sql->rowCount() == 1) {
            $clienteRetorno = $sql->fetch(PDO::FETCH_OBJ);
        }

        return $clienteRetorno;
    }

    function cadastrar($cliente)
    {
        $sql_verifica = $this->con->prepare("SELECT * FROM clientes WHERE cpf =:cpf OR email =:email");
        $sql_verifica->bindValue(':cpf', $cliente->cpf);
        $sql_verifica->bindValue(':email', $cliente->email);
        $sql_verifica->execute();

        if ($sql_verifica->rowCount() > 0) {
            return 'Usuário já existe';
        } else {
            $sql = $this->con->prepare("INSERT INTO clientes (nome, cpf, data_nascimento, logradouro, cep, cidade, estado, telefone, rg, tipo, email, senha) VALUES (:nome, :cpf, :data_nascimento, :logradouro, :cep, :cidade, :estado, :telefone, :rg, :tipo, :email, :senha)");
            $sql->bindValue(':nome', $cliente->nome);
            $sql->bindValue(':cpf', $cliente->cpf);
            $sql->bindValue(':data_nascimento', $cliente->data_nascimento);
            $sql->bindValue(':logradouro', $cliente->logradouro);
            $sql->bindValue(':cep', $cliente->cep);
            $sql->bindValue(':cidade', $cliente->cidade);
            $sql->bindValue(':estado', $cliente->estado);
            $sql->bindValue(':telefone', $cliente->telefone);
            $sql->bindValue(':rg', $cliente->rg);
            $sql->bindValue(':tipo', $cliente->tipo);
            $sql->bindValue(':email', $cliente->email);
            $sql->bindValue(':senha', $cliente->senha);
            $sql->execute();

            return 'Cadastrado com sucesso!';
        }
    }

    function alterar($cliente)
    {
        $sql = $this->con->prepare("UPDATE clientes SET nome=:nome, data_nascimento=:data_nascimento, logradouro=:logradouro, cep=:cep, cidade=:cidade, estado=:estado, telefone=:telefone, rg=:rg WHERE cpf LIKE :cpf");
        $sql->bindValue(':nome', $cliente->nome);
        $sql->bindValue(':data_nascimento', $cliente->data_nascimento);
        $sql->bindValue(':logradouro', $cliente->logradouro);
        $sql->bindValue(':cep', $cliente->cep);
        $sql->bindValue(':cidade', $cliente->cidade);
        $sql->bindValue(':estado', $cliente->estado);
        $sql->bindValue(':telefone', $cliente->telefone);
        $sql->bindValue(':rg', $cliente->rg);
        $sql->bindValue(':cpf', $cliente->cpf);
        $sql->execute();

        $sql_cliente = $this->con->prepare("SELECT * FROM clientes WHERE cpf LIKE :cpf");
        $sql_cliente->bindValue(':cpf', $cliente->cpf);
        $sql_cliente->execute();

        $clienteRetorno = $sql_cliente->fetch(PDO::FETCH_ASSOC);

        $cliente = new Cliente();

        $cliente->setCliente(
            $clienteRetorno['nome'],
            $clienteRetorno['email'],
            $clienteRetorno['cpf'],
            $clienteRetorno['rg'],
            $clienteRetorno['data_nascimento'],
            $clienteRetorno['logradouro'],
            $clienteRetorno['cep'],
            $clienteRetorno['cidade'],
            $clienteRetorno['estado'],
            $clienteRetorno['telefone'],
            $clienteRetorno['tipo']
        );

        return $cliente;
    }
}
