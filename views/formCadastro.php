<?php require_once
    "includes/cabecalho.inc.php";
?>

<!-- CONTEUDO -->
<h1 class="text-center">Cadastro de Usuário</h1>

<div class="row">
    <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
            <div class="card-img-left d-none d-md-flex">
                <!-- Background image for card set in CSS! -->
            </div>
            <div class="card-body p-4 p-sm-5">
                <h5 class="card-title text-center mb-5 fw-light fs-5">Cadastre suas informações de Login</h5>
                <form action="../controlers/controllerCliente.php" method="get">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputNome" placeholder="João da Silva" name="pNome" required>
                        <label for="floatingInputNome">Nome</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputCpf" placeholder="123-456-789-00" name="pCpf" required>
                        <label for="floatingInputCpf">CPF</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputLogradouro" placeholder="Avenida" name="pLogradouro" required>
                        <label for="floatingInputLogradouro">Logradouro</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputCidade" placeholder="Alegre" name="pCidade" required>
                        <label for="floatingInputCidade">Cidade</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputEstado" placeholder="ES" name="pEstado" required>
                        <label for="floatingInputEstado">Estado</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputCEP" placeholder="00000-000" name="pCEP" required>
                        <label for="floatingInputCEP">CEP</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputTelefone" placeholder="27999999999" name="pTelefone" required>
                        <label for="floatingInputTelefone">Telefone</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="floatingInputDataNasc " name="pDataNasc" required>
                        <label for="floatingInputDataNasc">Data Nascimento</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputRG" placeholder="0000-000" name="pRG" required>
                        <label for="floatingInputEmail">RG</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInputEmail" placeholder="nome@exemplo.com" name="pEmail" required>
                        <label for="floatingInputEmail">Email</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Senha" name="pSenha" required>
                        <label for="floatingPassword">Senha</label>
                    </div>

                    <?php
                    if (isset($_SESSION['erroCadastro'])) {
                        echo $_SESSION['erroCadastro'];
                        unset($_SESSION['erroCadastro']);
                    }
                    ?>
                    <div class="d-grid mb-2">
                        <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Fazer cadastro</button>
                    </div>

                    <?php
                    if (isset($_SESSION['erroLogin']) && $_SESSION['erroLogin'] == true)
                        echo "Já existe um cadastro com esse email!";
                    unset($_SESSION['erroLogin']);
                    ?>

                    <a class="d-block text-center mt-2 small" href="formLogin.php">Já possui uma conta? Faça login aqui.</a>

                    <input type="hidden" value="3" name="pOpcao">
                </form>
            </div>
        </div>
    </div>

</div>

<!-- Rodape -->

<?php require_once "includes/rodape.inc.php" ?>