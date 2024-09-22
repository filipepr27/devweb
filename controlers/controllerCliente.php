<?php

require_once '../dao/clienteDAO.inc.php';

$opcao = $_REQUEST['pOpcao'];

switch ($opcao) {
    case 1:
        // fazer login
        $email = $_REQUEST['pEmail'];
        $senha = $_REQUEST['pSenha'];

        $clienteDao = new ClienteDao();
        $cliente = $clienteDao->autenticar($email, $senha);

        session_start();
        if ($cliente != null) {
            $_SESSION['clienteLogado'] = $cliente;
            $_SESSION['erroLogin'] = false;
            if (isset($_SESSION['finalizandoCompra'])) {
                unset($_SESSION['finalizandoCompra']);
                header('Location: controllerCarrinho.php?opcao=5');
            } else {
                header('Location: controllerProduto.php?opcao=7');
            }
        } else {
            $_SESSION['erroLogin'] = true;
            header('Location: ../views/formLogin.php');
        }
        break;
    case 2:
        // sair do sistema
        session_start();
        unset($_SESSION['clienteLogado']);
        header('Location: ../views/index.php');
        break;

    case 3:
        // cadastrar usuario

        $nome = $_REQUEST['pNome'];
        $cpf = $_REQUEST['pCpf'];
        $logradouro = $_REQUEST['pLogradouro'];
        $cidade = $_REQUEST['pCidade'];
        $estado = $_REQUEST['pEstado'];
        $cep = $_REQUEST['pCEP'];
        $telefone = $_REQUEST['pTelefone'];
        $data_Nascimento = $_REQUEST['pDataNasc'];
        $rg = $_REQUEST['pRG'];
        $email = $_REQUEST['pEmail'];
        $senha = $_REQUEST['pSenha'];

        $cliente = new Cliente();
        $cliente->cadastrarCliente($nome, $email, $cpf, $rg, $data_Nascimento, $logradouro, $cep, $cidade, $estado, $telefone, $senha);

        $clienteDao = new ClienteDao();
        $resposostaCadastro = $clienteDao->cadastrar($cliente);
        echo $resposostaCadastro;

        if ($resposostaCadastro == 'Cadastrado com sucesso!') {
            header('Location: ../views/formLogin.php');
        } else {
            session_start();
            $_SESSION['erroCadastro'] = $resposostaCadastro;
            header('Location: ../views/formCadastro.php');
        }

        break;

    case 4:
        // alterar dados do usuario
        session_start();
        $cpf = $_SESSION['clienteLogado']->cpf;

        $nome = $_REQUEST['pNome'];
        $logradouro = $_REQUEST['pLogradouro'];
        $cidade = $_REQUEST['pCidade'];
        $estado = $_REQUEST['pEstado'];
        $cep = $_REQUEST['pCEP'];
        $telefone = $_REQUEST['pTelefone'];
        $data_Nascimento = $_REQUEST['pDataNasc'];
        $rg = $_REQUEST['pRG'];

        $cliente = new Cliente();
        $cliente->alterarCliente($cpf, $nome, $rg, $data_Nascimento, $logradouro, $cep, $cidade, $estado, $telefone);

        $clienteDao = new ClienteDao();
        $clienteAlterado = $clienteDao->alterar($cliente);

        $_SESSION['clienteLogado'] = $cliente;
        header('Location: ../views/formCadastroAtualizar.php');
        break;
}
