<?php
require_once '../classes/cliente.inc.php';
require_once '../utils/funcoesUteis.php';
require_once 'includes/cabecalho.inc.php';

$usuario = $_SESSION['clienteLogado'];

?>

<!-- CONTEUDO -->
<h1 class="text-center">Editar informações</h1>

<div class="row">
    <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
            <div class="card-img-left d-none d-md-flex">
                <!-- Background image for card set in CSS! -->
            </div>
            <div class="card-body p-4 p-sm-5">
                <h5 class="card-title text-center mb-5 fw-light fs-5">Atualize suas informações de Login</h5>
                <form action="../controlers/controllerCliente.php" method="get">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputNome" placeholder="João da Silva" name="pNome" value="<?= $usuario->nome ?>" required>
                        <label for="floatingInputNome">Nome</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputLogradouro" placeholder="Avenida" name="pLogradouro" value="<?= $usuario->logradouro ?>" required>
                        <label for="floatingInputLogradouro">Logradouro</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputCidade" placeholder="Alegre" name="pCidade" value="<?= $usuario->cidade ?>" required>
                        <label for="floatingInputCidade">Cidade</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputEstado" placeholder="ES" name="pEstado" value="<?= $usuario->estado ?>" required>
                        <label for="floatingInputEstado">Estado</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputCEP" placeholder="00000-000" name="pCEP" value="<?= $usuario->cep ?>" required>
                        <label for="floatingInputCEP">CEP</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputTelefone" placeholder="27999999999" name="pTelefone" value="<?= $usuario->telefone ?>" required>
                        <label for="floatingInputTelefone">Telefone</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="floatingInputDataNasc " name="pDataNasc" value="<?= formatarDataPorAno($usuario->data_nascimento) ?>" required>
                        <label for="floatingInputDataNasc">Data Nascimento</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputRG" placeholder="0000-000" name="pRG" value="<?= $usuario->rg ?>" required>
                        <label for="floatingInputEmail">RG</label>
                    </div>

                    <hr>

                    <?php
                    if (isset($_SESSION['erroAtualizacao'])) {
                        echo $_SESSION['erroAtualizacao'];
                        unset($_SESSION['erroAtualizacao']);
                    }
                    ?>
                    <div>
                        <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Atualizar dados</button>
                    </div>

                    <input type="hidden" value="4" name="pOpcao">

                </form>
            </div>
        </div>
    </div>

</div>

<!-- Rodape -->

<?php require_once "includes/rodape.inc.php" ?>